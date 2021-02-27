<div class="galerij_wrap">
    <?php

$sync_images = pak_veld("_car_syncimages_key");

?>

    <style>
        img.galerij_item {
            width: 50%;
            padding: 5px;
            height: 50%;
            object-fit: cover;
        }

        .galerij_eerste_wrap {
            width: 50%;
            padding: 5px;
            display: flex;
        }

        .galerij_item_wrap {
            width: 50%;
            display: flex;
            flex-wrap: wrap;
        }


        .galerij_preview {
            display: flex;
        }

        img.sp_eerste {
            border-radius: 10px 0 0 10px;
            height: 100%;
            width: 100%;
            padding: 0;
        }

        img.galerij_item.sp_derde {
            border-radius: 0px 15px 0px 0px;
        }

        img.galerij_item.sp_vijf {
            border-radius: 0px 0px 15px 0px;
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

        .bekijkfotoswrap {
            display: flex;
            justify-content: flex-end;
            margin-right: 30px;
            margin-top: -60px;
            margin-bottom: 50px;
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

        img.galerij_item {
            cursor: pointer;
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
    </style>

    <div class="galerij_preview">
        <div class="galerij_eerste_wrap">
            <img class='galerij_item sp_eerste' data-foto-id="1" src='<?php echo $sync_images[0];?>' />
        </div>
        <div class="galerij_item_wrap">

            <img class='galerij_item sp_tweede' data-foto-id="2" src='<?php echo $sync_images[1];?>' />

            <img class='galerij_item sp_derde' data-foto-id="3" src='<?php echo $sync_images[2];?>' />

            <img class='galerij_item sp_vierde' data-foto-id="4" src='<?php echo $sync_images[3];?>' />

            <img class='galerij_item sp_vijf' data-foto-id="5" src='<?php echo $sync_images[4];?>' />

        </div>

    </div>
    <div class="bekijkfotoswrap">
        <div class="bekijkfotos" id="bekijkfotos"><i data-feather="grid"></i><span>Bekijk alle foto's</span></div>
    </div>

    <div class="splide_wrap">
        <div class="sluitwrap">
            <div class="fotosluiten" id="fotosluiten"><i data-feather="x"></i><span>Sluiten</span></div>
        </div>

        <div class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php
                for ($i = 0; $i < count($sync_images); $i++) {
                    ?>
                    <li class="splide__slide"><img src='<?php echo $sync_images[$i];?>' /></li>
                    <?php
                  }
            ?>
                </ul>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var splidecount = 0;
                var splide;
                jQuery(".galerij_item").on('click', function () {

                    jQuery(".splide_wrap").show();
                    jQuery(".splide_wrap").animate({
                        'opacity': '1',
                        'bottom': 0
                    }, 300);
                    var selectedid = jQuery(this).attr("data-foto-id");

                    splidecount += 1;

                    if (splidecount == 1) {
                        splide = new Splide('.splide', {
                            type: 'slide',
                            cover: true,
                            width: '800px',
                            height: '500px',
                            start: selectedid - 1
                        }).mount();
                    } else {
                        splide.go(selectedid - 1);
                    }

                });
                jQuery("#bekijkfotos").on('click', function () {
                    if (splide !== undefined) {
                        splide.destroy();
                    }
                    jQuery(".splide_wrap").show();
                    jQuery(".splide_wrap").animate({
                        'opacity': '1',
                        'bottom': 0
                    }, 300);

                    splide = new Splide('.splide', {
                        type: 'slide',
                        cover: true,
                        width: '800px',
                        height: '500px',
                        start: 0
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

    <?php

?>
</div>