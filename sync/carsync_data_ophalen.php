<?php



function carsync_data_ophalen(){
//FILES
$debugfile = "/carsync/sync/data/input_query_log_debug.txt";
$errorfilepath = "/carsync/sync/data/input_query_log_error.txt";
$httperrorfilepath = "/carsync/sync/data/input_query_log_http_error.txt" ;
$httperrorfilepathformail = "/wp-content/plugins/carsync/sync/data/input_query_log_http_error.txt" ;
$inputqueryfilepath = "/carsync/sync/data/input_query.json";
$inputquerylog = "/carsync/sync/data/input_query_log.txt";
//ENDFILES
$endpoint = "https://listing-search.api.autoscout24.com/graphql";
$authToken = "Basic YmUtMjE0MjAxMDg5MDp1OFhudWhGZEwxNTNobjFsU3dIYk1FN2d1ZUMxN04=";

$qry = '{"query":"query ListingsSummaryQuery { search { listings(metadata: {page: 1}) { metadata { totalCount: totalItems pageSize } listings { id details(locale: nl_BE) { publication { state changedTimestamp changedTimestampWithOffset createdTimestamp createdTimestampWithOffset } description vehicle { classification { make { raw formatted } model { raw formatted } modelVersionInput } environment { environmentLabels { norm label } } engine { power { kw { raw formatted } hp { raw formatted } } numberOfGears numberOfCylinders engineDisplacementInCCM { raw formatted } transmissionType { raw formatted } driveTrain { raw formatted } } fuels { primary { type { raw formatted } consumption { combined { raw } urban { raw } extraUrban { raw } } co2emissionInGramPerKm { raw formatted } } additional { type { raw formatted } consumption { combined { raw } urban { raw } extraUrban { raw } } co2emissionInGramPerKm { raw formatted } } allFuelTypes { raw formatted } fuelCategory { raw formatted } } numberOfDoors emptyWeight { raw formatted } bodyColorOriginal maintenance { nextVehicleSafetyInspection { raw formatted } lastBeltServiceDate { raw formatted } hasFullServiceHistory { raw formatted } lastTechnicalServiceDate { raw formatted } } condition { firstRegistrationDate { raw formatted } mileageInKm { raw formatted } carpassMileageUrl numberOfPreviousOwnersExtended { raw formatted } nonSmoking newInspection damage { accidentFree } } interior { numberOfSeats upholstery { raw formatted } upholsteryColor { raw formatted } } equipment { as24 { id { raw formatted } } dat { oem { id text type as24TaxonomyId } generic { id text type as24TaxonomyId } } eurotax { oem { id text type as24TaxonomyId } generic { id text type as24TaxonomyId } } userInput } identifier { vin licensePlate } manufacturerEquipment { raw formatted } usageState originalMarket { raw formatted } bodyColor { raw formatted } bodyType { raw formatted } paintType { raw formatted } legalCategories { raw formatted } } prices { pricepublic: public { amountInEUR { raw formatted } negotiable taxDeductible taxDeductibleNote category } } availability { fromDate { raw formatted } inDays } financing { rate { raw formatted } finalInstallment { raw formatted } debitInterestKind interest { raw formatted } netCreditAmount { raw formatted } serviceFee { raw formatted } duration { raw formatted } grossCreditAmount { raw formatted } debitInterest { raw formatted } bankId rateInsurance { raw formatted } bank deposit { raw formatted } } warranty { generic { durationInMonth { raw formatted } } warrantyExists } adProduct { title subTitle has360Image tier } media { basicUrl youtubeLink images { ... on StandardImage { formats { png { size60x45 size640x480 } jpg { size1280x960 } } } } } seals { id name culture thumbnail image info } location { countryCode zip city street } seller { id companyName contactName companyNameAddOn email sellId phones { phoneType formattedNumber callTo } addressTypeId addressId links { cars { href method } motorbikes { href method } imprint { href method } email { href method } infoPage { href method } } logo { big { href method } small { href method } } type } ratings { customerCulture urlName ratingsCount ratingsAverage ratingsEnabled } webPage identifier { offerReference } } } } } }"}';

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: '.$authToken;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $qry);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


//DEBUG
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_STDERR, fopen(WP_PLUGIN_DIR . $debugfile, "w+"));





$result = curl_exec($ch);

$tijd = "LAST RUN: ". date("d-m-Y H:i:s");



if (curl_errno($ch)) {
    // this would be your first hint that something went wrong
    $fhlog_error = fopen(WP_PLUGIN_DIR . $errorfilepath, "w+");
    fwrite($fhlog_error, $tijd . "\n" . "Couldn\'t send request: " . curl_error($ch)  . "\nRESULT:$result");
    fclose($fhlog_error);
    $to = "younesbenkheil@gmail.com";
    $subject = "Carsync failed: " . get_site_url();
    $message .= "Couldn\'t send request: " . curl_error($ch) ."\n" . $tijd . "\nURL: ". get_site_url() . $httperrorfilepathformail . "\nURL: ". get_site_url() . $debugfile . "\nRESULT:$result";
    wp_mail( $to, $subject, $message );

    die('Couldn\'t send request: ' . curl_error($ch));
    
    
    
} else {
    // check the HTTP status code of the request
    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($resultStatus == 200) {
        
        $fh_200_log = fopen(WP_PLUGIN_DIR . $inputquerylog, "w+");
        fwrite($fh_200_log, $tijd . "\nHTTP CODE: " . $resultStatus);
        fclose($fh_200_log);

        $file =  WP_PLUGIN_DIR . $inputqueryfilepath;
        $fh = fopen($file, "w+");
        fwrite($fh, $result);
        fclose($fh);

    } else {

        $fhlog_error2 = fopen(WP_PLUGIN_DIR . $httperrorfilepath, "w+");
        fwrite($fhlog_error2, $tijd . "\n" . "Request failed: HTTP status code: " . $resultStatus . "\nRESULT:$result");
        fclose($fhlog_error2);

        $to = "younesbenkheil@gmail.com";
        $subject = "Carsync HTTP problem: " . get_site_url();
        $message .= "Request failed: HTTP status code: " . $resultStatus ."\n" . $tijd . "\nURL: ". get_site_url() . $httperrorfilepathformail . "\nURL: ". get_site_url() . "/wp-content/plugins" . $debugfile . "\nRESULT:$result";
        wp_mail( $to, $subject, $message );

        die('Request failed: HTTP status code: ' . $resultStatus);
    
    
    }
}

curl_close($ch);
}

/*

CRON JOB CONFIGUREREN

*/
function my_cron_schedules($schedules){
    if(!isset($schedules["15min"])){
        $schedules["15min"] = array(
            'interval' => 15*60,
            'display' => __('Once every 15 minuten'));
    }
    return $schedules;
}
add_filter('cron_schedules','my_cron_schedules');


if ( ! wp_next_scheduled( 'carsync_data_ophalen' ) ) {
    wp_schedule_event( time(), '15min', 'carsync_data_ophalen' );
}
add_action( 'carsync_data_ophalen', 'carsync_data_ophalen' );
?>