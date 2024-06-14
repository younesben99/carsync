<?php



function fb_feed_aanmaken() {
    $allposts = get_posts(array('post_type' => 'autos', 'numberposts' => -1));
    $fb_xml_pt1 = '';
    $fb_xml_loop = '';
    if (!empty($allposts)) {
        $pturl = get_site_url() . "/autos/";
        $fb_xml_pt1 = '"vehicle_id","title","description","url","make","model","year","mileage.value","mileage.unit","image[0].url","image[1].url","image[2].url","image[3].url","image[4].url","image[5].url","image[6].url","image[7].url","image[8].url","image[9].url","image[10].url","image[11].url","image[12].url","image[13].url","image[14].url","transmission","body_style","vin","price","exterior_color","state_of_vehicle","fuel_type","fb_page_id","address"';
        
        foreach ($allposts as $car) {
            $isverkocht = get_post_meta($car->ID, '_car_status_key', true);
            $isarchief = get_post_meta($car->ID, '_car_post_status_key', true);
            if ($isverkocht !== 'verkocht' && $isarchief !== "archief") {
                $fb_xml_loop .= "\n";
                $fb_xml_loop .= '"' . $car->ID . '",';
                $title = get_post_meta($car->ID, '_car_wagentitel_key', true);
                $description = strip_tags(get_post_meta($car->ID, '_car_wagentitel_key', true));
                $fb_xml_loop .= '"' . ($title ?: $pturl . $car->post_name) . '",';
                $fb_xml_loop .= '"' . ($description ?: $pturl . $car->post_name) . '",';
                $fb_xml_loop .= '"' . $pturl . $car->post_name . '",';
                $fb_xml_loop .= '"' . (get_post_meta($car->ID, '_car_merkcf_key', true) ?: '') . '",';
                $fb_xml_loop .= '"' . (get_post_meta($car->ID, '_car_modelcf_key', true) ?: 'Andere') . '",';
                $fb_xml_loop .= '"' . substr(get_post_meta($car->ID, '_car_bouwjaar_key', true), 0, 4) . '",';
                $fb_xml_loop .= '"' . (get_post_meta($car->ID, '_car_kilometerstand_key', true) ?: '') . '",';
                $fb_xml_loop .= '"KM",';

                // Handle images
                $img = get_post_meta($car->ID, '_car_syncimages_key', true);
                if (empty($img)) {
                    $img = get_post_meta($car->ID, 'vdw_gallery_id', true);
                    if ($img) {
                        $img = array_map('wp_get_attachment_url', $img);
                    }
                }
                for ($i = 0; $i <= 14; $i++) {
                    $fb_xml_loop .= '"' . ($img[$i] ?? '') . '",';
                }

                $transmission = get_post_meta($car->ID, '_car_transmissie_key', true) == "Manueel" ? "Manual" : "Automatic";
                $fb_xml_loop .= '"' . $transmission . '",';

                $carbody = get_post_meta($car->ID, '_car_carrosserievorm_key', true);
                $carbody_map = [
                    'Cabriolet' => 'CONVERTIBLE',
                    'Coupé' => 'COUPE',
                    'Break' => 'HATCHBACK',
                    'Bestelwagen' => 'MINIVAN',
                    'Stadswagen' => 'SMALL_CAR',
                    'SUV/4x4/Pick-up' => 'SUV',
                    'Berline' => 'SEDAN',
                    'Monovolume' => 'VAN'
                ];
                $fb_xml_loop .= '"' . ($carbody_map[$carbody] ?? 'OTHER') . '",';

                $vin = get_post_meta($car->ID, '_car_vin_key', true);
                $fb_xml_loop .= '"' . ($vin ?: $car->ID) . '",';
                $price = get_post_meta($car->ID, '_car_prijs_key', true);
                $fb_xml_loop .= '"' . ($price ? $price . ' EUR' : '') . '",';
                $exterior_color = get_post_meta($car->ID, '_car_kleurexterieur_key', true);
                $fb_xml_loop .= '"' . ($exterior_color ?: '') . '",';

                $state = get_post_meta($car->ID, '_car_staat_key', true) == "Tweedehands" ? "Used" : "New";
                $fb_xml_loop .= '"' . $state . '",';

                $fuel_type = get_post_meta($car->ID, '_car_brandstof_key', true);
                $fuel_type_map = [
                    'Diesel' => 'DIESEL',
                    'Elektrisch' => 'ELECTRIC',
                    'Ethanol' => 'FLEX',
                    'Benzine' => 'GASOLINE',
                    'Hybride' => 'HYBRID'
                ];
                $fb_xml_loop .= '"' . ($fuel_type_map[$fuel_type] ?? 'OTHER') . '",';

                $fb_xml_loop .= '"2265639753511090",';
                $fb_xml_loop .= '"{""addr1"":""Diestersteenweg 355"",""city"":""Hasselt"",""region"":""Limburg"",""postal_code"":""3510"",""country"":""Belgium""}"';
            }
        }
    }

    $uploadfolder = ABSPATH . "/wp-content/uploads/dds_uploads/feed/";

    if (!file_exists($uploadfolder)) {
        mkdir($uploadfolder, 0777, true);
    }

    $fb_xml = $fb_xml_pt1 . $fb_xml_loop;
    $fileLocation_csv = ABSPATH . "/wp-content/uploads/dds_uploads/feed/fb_carfeed.csv";
    file_put_contents($fileLocation_csv, $fb_xml);

    $fileLocation_json = ABSPATH . "/wp-content/uploads/dds_uploads/feed/fb_carfeed.json";
    $json_array = array_map("str_getcsv", explode("\n", $fb_xml));
    $json_data = json_encode($json_array);
    file_put_contents($fileLocation_json, $json_data);
}
fb_feed_aanmaken();
?>
