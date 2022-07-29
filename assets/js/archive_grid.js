jQuery(document).ready(function ($) {

    

    $(".facet_title").on("click",function(){
    
        $(this).next(".facet_inner").toggle();
        $(this).find("svg").toggleClass('rotate180');
    });
    $(".sort_select").select2(); 
    $(".prijs_min").select2(); 
    $(".prijs_max").select2(); 

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

        if(typeof FB !== "undefined"){
            FB.CustomerChat.hide();
        }
        
        $(".filter_btn_mobile,.bodh_btn_mobile").on("click",function(e){
            $("#fb-root").toggleClass("hideimportant");
            
        });

        if($(window).width() <=770){
           
            
            
            $(".filterwrap").show();
            
            
            $(".filterwrap").animate({
                            'bottom': 0,
                            'opacity':1
            }, 300);
            
            $(".filter_mobile_close").toggleClass("displayflex");
        }
        else{
          $(".dds_pop_close").trigger("click");
        }
       
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
       
        $(".filterwrap").animate({
            'opacity': '0',
            'bottom': '-100vh'
        }, 300);

        setTimeout(function () {
            $(".filterwrap").hide();
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
          

            //real filter

            filters[group].push($(this).attr('data-filter').replace(/[^a-zA-Z0-9\.]/g, ''));

            //chosen display

            var current_facet = $(this).attr('data-filter').substring(1);

            var index = chosenfilters.indexOf(current_facet);

            if (index === -1) {
                //console.warn("push: "+current_facet);
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
       
        var comboFilter = getComboFilter( filters );

    
        $(chosenfilters).each(function( index ) {
            if(chosenfilters[index].slice(0, 4) !== "<div"){
                chosenfilters[index] = "<div class='ch_facet_item' data-facet-item='"+chosenfilters[index].toLowerCase()+"'>" + chosenfilters[index] + "</div>";
            }
        });

       // console.log(chosenfilters);

       
        $("#dds_bodh input[name=bodhlist]").val(JSON.stringify(filters));
        
        $(".chosen_facets").html(chosenfilters.join(""));
        $(".pop_chosenfacets").html(chosenfilters.join(""));
        
        $grid.isotope({ filter: comboFilter});
        //console.log(comboFilter);
    })

    
    $(".chosen_facets,.pop_chosenfacets").on("click",".ch_facet_item",function(e){
        
        var clickedFacet = $(this).attr("data-facet-item");

        console.log(clickedFacet);

        if(clickedFacet == "minprijs"){
            $(".prijs_min").val("disabled");
            $(".prijs_min").trigger("change");
        }
        if(clickedFacet == "maxprijs"){
            $(".prijs_max").val("disabled");
            $(".prijs_max").trigger("change");
        }


        $(".facet_wrap input:checkbox").each(function() {
            
            if($(this).val() == clickedFacet){
                //console.log($(this));
                $(this).trigger("click");
            }
        });
    });

    
    
   
    $grid.on( 'layoutComplete', function( event, laidOutItems ) {
        $(".gevonden_count").html(laidOutItems.length);
    
    });
    
    var grid_price_range = [];
        $(".grid_item").each(function(index,element){
            
            
            var dataprice = parseInt($(this).attr("data-price"));

            if (typeof dataprice === 'number' && !Number.isNaN(dataprice)) {
                grid_price_range.push(parseInt(dataprice));
              }
            


        });
        //console.log(grid_price_range);


    var min_price_default = 0;
    $(".prijs_min").on("change",function(event) { 
        filters["prijs"] = [];

        var prijs_ranges = [2500,5000,7500,10000,12500,15000,17500,20000,22500,25000,27500,30000];
        
        var chosen_range = $(this).val();
        min_price_default = $(this).val();


        // select prijzen aanpassen
        // $(".prijs_max option").each(function(index,element){
        //     console.log($(element).val() );
            
        //     if($(element).val() <= chosen_range ){
        //         $(element).prop("disabled",true); 
        //     }
            
        // });

        
        var min_max = [];
        
        $(grid_price_range).each(function(index,element){

            if(element >= chosen_range){
                min_max.push(element);
            }
          
            

        });        
        $(min_max).each(function(index,element){

            min_max[index] = ".pr_"+element;

        });
        $(min_max).each(function(index,element){
            filters["prijs"].push(element);
        });
        console.log(filters);
        var comboFilter = getComboFilter( filters );
        $grid.isotope({ filter: comboFilter});
       
        $grid.isotope({ sortBy : 'price',sortAscending: true });
        $('.sort_select').val('prijs_o'); 
        $('.sort_select').trigger('change'); 


        //chosen display
        $(".chosen_wrap").show();

        //verwijder chosen

        
        $(chosenfilters).each(function(index,element){
            if(element.slice(0, 34) == "<div class='ch_facet_item minprijs"){
              
               chosenfilters.splice(index,1);
            }
        });



        //voeg chosen toe
        var current_facet = chosen_range;

        var index = chosenfilters.indexOf(current_facet);

        if (index === -1  && current_facet !== "disabled") {
           
            chosenfilters.push(current_facet);
        }

       
        $(chosenfilters).each(function( index ) {
            if(chosenfilters[index].slice(0, 4) !== "<div" && chosenfilters[index] !== "disabled"){
                //console.log(chosenfilters[index]);
                chosenfilters[index] = "<div class='ch_facet_item minprijs' data-facet-item='minprijs'>Minimum: € " + chosenfilters[index] + ",-</div>";
            }
        }); 
        
        //console.log(chosenfilters);

        if(chosenfilters == 0){
            $(".chosen_wrap").hide();
           
        }
       
       
        $("#dds_bodh input[name=bodhlist]").val(JSON.stringify(filters));
        
        $(".chosen_facets").html(chosenfilters.join(""));
        $(".pop_chosenfacets").html(chosenfilters.join(""));


        console.log(min_price_default);

    });


    $(".prijs_max").on("change",function(event) { 
        filters["prijs"] = [];

        var prijs_ranges = [2500,5000,7500,10000,12500,15000,17500,20000,22500,25000,27500,30000];

        var chosen_range = $(this).val();

        var min_max = [];

        

        $(grid_price_range).each(function(index,element){

            if(element <= chosen_range && element >= min_price_default){
                min_max.push(element);
            }
          
            

        });        
        $(min_max).each(function(index,element){

            min_max[index] = ".pr_"+element;

        });
        $(min_max).each(function(index,element){
            filters["prijs"].push(element);
        });

        console.log(filters);
        var comboFilter = getComboFilter( filters );

        $grid.isotope({ filter: comboFilter});
        
        $grid.isotope({ sortBy : 'price',sortAscending: true });


        //max chosen

        $(chosenfilters).each(function(index,element){
            if(element.slice(0, 34) == "<div class='ch_facet_item maxprijs"){
              
               chosenfilters.splice(index,1);
            }
        });


        $(".chosen_wrap").show();


        //voeg chosen toe
        var current_facet = chosen_range;

        var index = chosenfilters.indexOf(current_facet);

        if (index === -1  && current_facet !== "disabled") {
            
            chosenfilters.push(current_facet);
        }

       
        $(chosenfilters).each(function( index ) {
            if(chosenfilters[index].slice(0, 4) !== "<div" && chosenfilters[index] !== "disabled"){
                //console.log(chosenfilters[index]);
                chosenfilters[index] = "<div class='ch_facet_item maxprijs' data-facet-item='maxprijs'>Maximum: € " + chosenfilters[index] + ",-</div>";
            }
        }); 
        
        

        if(chosenfilters == 0){
            $(".chosen_wrap").hide();
        }
       
        $("#dds_bodh input[name=bodhlist]").val(JSON.stringify(filters));
        
        $(".chosen_facets").html(chosenfilters.join(""));
        $(".pop_chosenfacets").html(chosenfilters.join(""));
        console.log(min_price_default);

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



    

    

    $(".reset_btn").on("click",function(e){
        e.preventDefault();
         
        $(".prijs_min").val("disabled");
        $(".prijs_min").trigger("change");
        $(".prijs_max").val("disabled");
        $(".prijs_max").trigger("change");
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
    //console.log(link);
    window.location.href = link;


    });


    //css fix badge
    $(".grid_badge").css("opacity",1);



 
    //loading toon result fake animation
    $(".facet_item input,.select_list option").on("click",function(){

        $(".toonresult").toggleClass("showloading");
        setTimeout(function () {
            $(".toonresult").toggleClass("showloading");
        }, 500);
     



    });
});
