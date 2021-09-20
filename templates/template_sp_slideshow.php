<style>
    .sp_slideshow {
        margin: 0 0 40px 0;
    }

    div#primary-slider {
        margin-bottom: 15px;
    }

    #secondary-slider li {
        cursor: pointer;
    }

    #secondary-slider img,
    #secondary-slider li {
        border-radius: 5px !important;
    }

    .splide--nav>.splide__track>.splide__list>.splide__slide {
        border: 0px solid transparent;
    }

    #primary-slider li {
        cursor: pointer;
    }

    #bekijkfotos,
    #fotosluiten {
        padding: 10px 0px;
        border-radius: 5px;
        color: #151515;
        border: 1px solid transparent;
        background: white;
        width: 160px;
        display: flex;
        align-items: center;
        height: 35px;
        justify-content: center;
    }

    #bekijkfotos:focus,
    #bekijkfotos:hover,
    #fotosluiten:focus,
    #fotosluiten:hover {
        outline: 0;
    }

    #bekijkfotos:hover,
    #fotosluiten:hover {
        outline: 0;
        cursor: pointer;
        border: 1px solid grey;
    }

    .splide_wrap {
        position: fixed;
        opacity: 0;
        bottom: -100vh;
        width: 100%;
        left: 0;
        background: #ffffffe3;
        z-index: 10000;
        height: 100vh;
        padding-top: 8vh;


        display: none;
    }

    div#fotosluiten {
        background: white;
        color: dimgrey;
        font-size: 13px;
        border: 1px solid #adadad;
        width: 115px;
    }

    .sluitwrap {
        max-width: 800px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-bottom: 20px;
        text-align: right;
    }


    svg.feather.feather-grid,
    svg.feather.feather-x {
        width: 18px;
        height: 18px;
        margin-right: 10px;
    }

    .splide {
        margin: auto;
    }

    #primary-slider li {
        border-radius: 5px;
    }
</style>
<div class="sp_slideshow">
    <?php





    $carsync_fotos = pak_veld( '_car_syncimages_key');
    $manual_fotos = pak_veld( 'vdw_gallery_id');
    $value_sync = pak_veld('_car_sync_key');
    $sync_status = pak_veld('_car_status_key');
   
    if(is_array($manual_fotos)){
        $manual_fotos = array_unique($manual_fotos);
    }

    $img_links = array();


    if (!empty($carsync_fotos) && empty($manual_fotos) || $manual_fotos[0] == null) {
        
            foreach ($carsync_fotos as $img) {
                
                array_push($img_links,$img);
                
            }


    } else {

        if (!empty($manual_fotos) || $manual_fotos[0] == null) {

             foreach ($manual_fotos as $img) {
                
                if($img !== 1){
                    array_push($img_links,wp_get_attachment_url($img));
                }
                else{
                    array_push($img_links,"https://digiflowroot.be/static/images/camera_image.jpg");
                    
                }
                
                
            }

        } else {
            foreach ($carsync_fotos as $img) {
                
                array_push($img_links,$img);
                
            }
            

        }

    }






?>
    <div class="splide" id="primary-slider">
        <div class="splide__track">
            <ul class="splide__list">
                <?php
                for ($i = 0; $i < count($img_links); $i++) {
                    ?>
                <li class="splide__slide" data-foto-id="<?php echo $i; ?>"><img src='<?php echo $img_links[$i]; ?>' />
                </li>
                <?php
                }
            ?>
            </ul>
        </div>
    </div>
    <div class="splide" id="secondary-slider">
        <div class="splide__track">
            <ul class="splide__list">
                <?php
                for ($i = 0; $i < count($img_links); $i++) {
                    ?>
                <li class="splide__slide"><img src='<?php echo $img_links[$i]; ?>' /></li>
                <?php
                }
            ?>
            </ul>
        </div>
    </div>
    <div class="splide_wrap">
        <div class="sluitwrap">
            <div class="fotosluiten" id="fotosluiten"><i data-feather="x"></i><span>Sluiten</span></div>
        </div>

        <div class="splide" id="fullscreensplide">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php
                for ($i = 0; $i < count($img_links); $i++) {
                    ?>
                    <li class="splide__slide"><img src='<?php echo $img_links[$i]; ?>' /></li>
                    <?php
                }
            ?>
                </ul>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var slideindex = 0;
            var secondarySlider = new Splide('#secondary-slider', {
                rewind: true,
                fixedWidth: 100,
                fixedHeight: 64,
                isNavigation: true,
                gap: 10,
                focus: 'center',
                pagination: false,
                cover: true,
                breakpoints: {
                    '600': {
                        fixedWidth: 66,
                        fixedHeight: 40,
                    }
                }
            }).mount();

            var primarySlider = new Splide('#primary-slider', {
                type: 'fade',
                height: 400,
                pagination: false,
                arrows: false,
                cover: true,
                breakpoints: {
                    '800': {
                        height: 400
                    },
                    '600': {
                        height: 250
                    }
                }
            });


            var fullscreenslide = new Splide('#fullscreensplide', {
                type: 'slide',
                height: 400,
                pagination: true,
                arrows: true,
                cover: true,
                breakpoints: {
                    '500': {
                        height: 300
                    }
                }
            }).mount();

            primarySlider.sync(secondarySlider).mount();

            jQuery("#primary-slider li").on("click", function () {

                selectedid = jQuery(this).attr("data-foto-id");

                if (fullscreenslide !== undefined) {
                    fullscreenslide.destroy();
                }
                jQuery(".splide_wrap").show();
                jQuery(".splide_wrap").animate({
                    'opacity': '1',
                    'bottom': 0
                }, 300);

                fullscreenslide = new Splide('#fullscreensplide', {
                    type: 'slide',
                    cover: true,
                    width: '800px',
                    height: '500px',
                    start: selectedid,
                    breakpoints: {
                        '500': {
                            height: 300
                        }
                    }
                }).mount();
            });
            jQuery(".splide_wrap,#fotosluiten").on('click', function (e) {
                jQuery(".splide_wrap").animate({
                    'opacity': '0',
                    'bottom': '-100vh'
                }, 300);
                setTimeout(function () {
                    jQuery(".splide_wrap").hide();
                }, 300);
            }).on('click', 'div', function (e) {
                e.stopPropagation();
            });

        });
    </script>

</div>