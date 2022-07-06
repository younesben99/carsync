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
</style>

<script>
    jQuery(document).ready(function ($) {
        function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
        }

        var $grid = $('.grid').isotope({
            itemSelector: '.element-item',
            percentPosition: true,
            layoutMode: 'fitRows',
            fitRows: {
                gutter: 15
            }
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

       

            //console.log("modified code: " + chosenfilters);
            $(".chosen_facets").html(chosenfilters.join(""));
            $grid.isotope({ filter: comboFilter});
        })

        
        $(".chosen_facets").on("click",".ch_facet_item",function(e){

            
           
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

    });
</script>

<div class="filtergrid_wrap">

    <?php
    include(__DIR__."/templates/archive/template_archive_filter.php");
    include(__DIR__."/templates/archive/template_archive_grid.php");
    ?>

</div>

<?php


 ?>

<?php

 //get_footer();

?>