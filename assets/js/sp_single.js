feather.replace();

jQuery(document).ready(function(){
       
    var splidex = new Splide( '.sp_grid_wrap',{
            type   : 'slide',
            width : '100%',
            start: 0,
            perPage: 4,
            perMove: 2,
            gap:"2rem",
            pagination:false,
            breakpoints: {
                '1100': {
                    perPage: 3,
                    gap    : '1rem',
                    perMove: 1
                },
                '800': {
                    perPage: 2,
                    gap    : '1rem',
                    perMove: 1
                },
                '500': {
                    perPage: 1,
                    gap    : '1rem',
                    perMove: 1

                },
            }
           
        } ).mount();

    jQuery(".toonmeer").on("click",function(){
        jQuery(this).prev(".hiddenoption").slideToggle();
        if(jQuery(this).text() == 'Toon meer'){
		jQuery(this).text('Toon minder');
        }
        else{
            jQuery(this).text('Toon meer');
        }
    });

    jQuery(".toondesc").on("click",function(){
        jQuery(".sp_desc_wrap").toggleClass("fulldesc");
        if(jQuery(this).text() == 'Toon meer'){
		jQuery(this).text('Toon minder');
        }
        else{
            jQuery(this).text('Toon meer');
        }
    });
    jQuery(window).on('scroll', function() { 
        if (jQuery(window).scrollTop() >= 400) { 
            if(jQuery(".sp_bottom_sticky_nav").is(":hidden")){
            jQuery(".sp_bottom_sticky_nav").show();
            }
        } 
        else{
            if(jQuery(".sp_bottom_sticky_nav").is(":visible")){
                jQuery(".sp_bottom_sticky_nav").hide();
            }
            
        }
    }); 

    jQuery(".sp_delen").on("click",function(){
        jQuery(".deellijst_wrap").toggleClass("popin");
        var offsetx = jQuery(this).offset();
        console.log(offsetx.left);
        console.log(offsetx.left - 180);
        jQuery(".popin").css({left: offsetx.left - 180, position:'absolute'});
    });
    jQuery("html").on("click",function(){
        if(jQuery(".deellijst_wrap").is(":visible")){
            jQuery(".deellijst_wrap").toggleClass("popin");
        }
        
    }).on('click', '.deellijst_wrap,.sp_delen', function(e) {
        e.stopPropagation();
    });


});