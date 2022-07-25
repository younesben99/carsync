<?php
    get_header();
    ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"
    integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php

    include(__DIR__."/templates/archive/template_banner.php");

   
   

    ?>

<style>
    .filtergrid_wrap {
        display: flex;
    }
    .sort_btn_group{
        display:none;
        position: absolute;
        top: 79px;
        background: white;
        padding: 20px 30px;
        border-radius: 5px;
        box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 0px;
         border: 1px solid whitesmoke;
         width: 90%;
    }
    .sort_btn_group ul{
        margin: 0;
        padding:0;
    list-style-type: none;
    }
    
    .sort_btn_group li {
    padding-bottom: 15px;
    padding-top: 15px;
    border-top: 1px solid #e2e2e2;
    cursor:pointer;
}
.sort_btn_group li:hover {
font-weight:500;

}
.sort_btn_group li:first-child {
    border-top: 0px solid #e2e2e2;
}
.sort_btn_mobile{
    cursor:pointer;
}
.sort_btn_group .active{
    font-weight:bold;
    color: var( --e-global-color-primary );
}
</style>

<script>
    jQuery(document).ready(function ($) {

        


        $(".sort_select").select2(); 

        function sort_grid(chosen){
            switch (chosen) {
                case "prijs_o":
                    $grid.isotope({ sortBy : 'price',sortAscending: true });
                    break;
                case "prijs_a":
                    $grid.isotope({ sortBy : 'price',sortAscending: false });
                    break;
                case "nieuwste":
                    $grid.isotope({ sortBy : 'bouwjaar',sortAscending: false });
                    break;
                case "km_o":
                    $grid.isotope({ sortBy : 'km',sortAscending: true });
                    break;   
                case "km_a":
                    $grid.isotope({ sortBy : 'km',sortAscending: false });
                    break;           
                default:

                $grid.isotope({ sortBy : 'original-order' });
                    break;
            }
        }


        $(".filter_btn_mobile,.selecteer_filter").on("click",function(e){
            e.preventDefault();
    jQuery(".filterwrap").show();

    jQuery(".filterwrap").animate({
                    'bottom': 0,
                    'opacity':1
    }, 300);

  


            
            $(".filter_mobile_close").toggleClass("displayflex");
        });

        $(".sort_btn_mobile").on("click",function(){

            $(".sort_btn_group").slideToggle();

        });
        $(".sort_btn_group li").on("click",function(){

        $(".sort_btn_group li").each(function(){
            $(this).removeClass("active");
        });

        $(this).addClass("active");

        var sortval = $(this).attr("data-sort");

        sort_grid(sortval);
        $(".sort_btn_group").slideToggle();

        });


        $(".filter_btn_close").on("click",function(e){
            jQuery(".filterwrap").animate({
                'opacity': '0',
                'bottom': '-100vh'
            }, 300);

            setTimeout(function () {
                jQuery(".filterwrap").hide();
            }, 300);
            $(".filter_mobile_close").toggleClass("displayflex");

        }).on('click', 'div', function (e) {
            e.stopPropagation();
        });
            
       

        function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
        }

        var $grid = $('.grid').isotope({
            itemSelector: '.element-item',
            percentPosition: true,
            layoutMode: 'fitRows',
            fitRows: {
                gutter: 25
            },
            getSortData: {
                km: function( itemElem ) {
                var km = $( itemElem ).find('.sort_km').text();
                
                return parseFloat( km.replace( /[\(\)]/g, '') );

                },
                bouwjaar: function( itemElem ) {
                var bouwjaar = $( itemElem ).find('.sort_bouwjaar').text();
               
                return parseFloat( bouwjaar.replace( /[\(\)]/g, '') );

                },
                price: function( itemElem ) {
                var price = $( itemElem ).find('.sort_prijs').text();
               
                return parseFloat( price.replace( /[\(\)]/g, '') );

                }
            }
        });


        $(".sort_select").on("change",function(e){
          
          

            var chosen = $(this).val();

            sort_grid(chosen);
        });



        var filters = {}; // should be outside the scope of the filtering function
        var chosenfilters = [];
        //filtering function
        $(".checkbox_list").on("change","input",function(event) {    
            $(".chosen_wrap").show();
            var checkbox = event.target;

            var group = $(this).parents(".checkbox_list").attr('data-filter-group');
            var filterGroup = filters[group];
            if (!filterGroup) {
                filterGroup = filters[group] = [];
            }

           
            if ( checkbox.checked ) {
                //console.log($(this).attr('data-filter').replace(/[^a-zA-Z0-9\.]/g, ''));
                filters[group].push($(this).attr('data-filter').replace(/[^a-zA-Z0-9\.]/g, ''));

                //chosen

                var current_facet = $(this).attr('data-filter').substring(1);

                var index = chosenfilters.indexOf(current_facet);

                if (index === -1) {
                    console.warn("push: "+current_facet);
                    chosenfilters.push(current_facet);
                }
               
                
            } else {
                
                var index = filters[group].indexOf( $(this).attr('data-filter').replace(/[^a-zA-Z0-9\.]/g, '') );
                filters[group].splice( index, 1 );
                
                //verwijder chosen

                var current_facet = $(this).attr('data-filter').substring(1);

                var index = chosenfilters.indexOf( "<div class='ch_facet_item' data-facet-item='"+current_facet.toLowerCase()+"'>" + current_facet + "</div>" );

                //console.warn("remove: "+index);
                chosenfilters.splice( index, 1 );
                if(chosenfilters.length == 0){
                    $(".chosen_wrap").hide();
                }


            }
            //console.log("full code: " +chosenfilters);
            var comboFilter = getComboFilter( filters );

        
            $(chosenfilters).each(function( index ) {
                if(chosenfilters[index].slice(0, 4) !== "<div"){
                    chosenfilters[index] = "<div class='ch_facet_item' data-facet-item='"+chosenfilters[index].toLowerCase()+"'>" + chosenfilters[index] + "</div>";
                }
            });

           
            $("#dds_bodh input[name=bodhlist]").val(JSON.stringify(filters));
            //console.log("modified code: " + chosenfilters);
            $(".chosen_facets").html(chosenfilters.join(""));
            $(".pop_chosenfacets").html(chosenfilters.join(""));
            
            $grid.isotope({ filter: comboFilter});
        })

        
        $(".chosen_facets,.pop_chosenfacets").on("click",".ch_facet_item",function(e){
            
            var clickedFacet = $(this).attr("data-facet-item");

            $(".facet_wrap input:checkbox").each(function() {
                
                if($(this).val() == clickedFacet){
                    console.log($(this));
                    $(this).trigger("click");
                }
            });
        });

        //onderdeel van isotope ref:https://stackoverflow.com/questions/17553076/isotope-combination-filtering-multiple-selection

        function getComboFilter( filters ) {
        var i = 0;
        var comboFilters = [];
        var message = [];
        
        for ( var prop in filters ) {
            message.push( filters[ prop ].join(' ') );
            var filterGroup = filters[ prop ];
            // skip to next filter group if it doesn't have any values
            if ( !filterGroup.length ) {
            continue;
            }
            if ( i === 0 ) {
            // copy to new array
            comboFilters = filterGroup.slice(0);
            } else {
            var filterSelectors = [];
            // copy to fresh array
            var groupCombo = comboFilters.slice(0); // [ A, B ]
            // merge filter Groups
            for (var k=0, len3 = filterGroup.length; k < len3; k++) {
                for (var j=0, len2 = groupCombo.length; j < len2; j++) {
                filterSelectors.push( groupCombo[j] + filterGroup[k] ); // [ 1, 2 ]
                }
        
            }
            // apply filter selectors to combo filters for next group
            comboFilters = filterSelectors;
            }
            i++;
        }
        
        var comboFilter = comboFilters.join(', ');
        return comboFilter;
        }



        

        $(".reset_btn").on("click",function(){
            $(".facet_wrap input:checkbox").each(function() {
                
                if($(this)[0].checked){
                    $(this).trigger("click");
                    
                }
            });
            $grid.isotope({ filter: "*"});
            $(".chosen_wrap").hide();
        });
        $(".car-item").on("click",function(){

        var link = $(this).attr("data-link");
        console.log(link);
        window.location.href = link;

        });
    });
    
</script>

<!-- filter voor mobile -->

<div class="filter_mobile_wrap">
    <button class="filter_btn_mobile">
        
    <img src="https://digiflowroot.be/static/images/icons/filter_5.svg" />
    <span>
    Filter</span>

   
</button>
<button class="sort_btn_mobile">
    Sorteren
</button>
<div class="sort_btn_group">
<ul>
    <li data-sort="original-order" class="active">Standaard</li>
    <li data-sort="prijs_o">Prijs oplopend</li>
    <li data-sort="prijs_a">Prijs aflopend</li>
    <li data-sort="nieuwste">Nieuwste eerst</li>
    <li data-sort="km_o">Kilometerstand oplopend</li>
    <li data-sort="km_a">Kilometerstand aflopend</li>
</ul>
</div>
<button class="bodh_btn_mobile pop_open" data-popup="bodh_pop">
    Blijf op de hoogte
</button>

</div>


<div class="filtergrid_wrap">

    <?php
    //include(__DIR__."/templates/archive/template_archive_filter_mobile.php");
    include(__DIR__."/templates/archive/template_archive_filter.php");
    include(__DIR__."/templates/archive/template_archive_grid.php");
    include(__DIR__."/templates/archive/template_archive_pop.php");
    ?>

</div>

<?php


 ?>

<?php

 get_footer();

?>