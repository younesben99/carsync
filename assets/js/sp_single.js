feather.replace();

Array.prototype.inArray = function(comparer) { 
    for(var i=0; i < this.length; i++) { 
        if(comparer(this[i])) return true; 
    }
    return false; 
}; 

Array.prototype.pushIfNotExist = function(element, comparer) { 
    if (!this.inArray(comparer)) {
        this.push(element);
    }
}; 

jQuery(document).ready(function($){

    $(".sp_sticky_telefoneren,.sp_smv_call").on("click",function(e){
            e.preventDefault();

            var nr = $(this).attr("href");
            window.location.href = nr;

    })
    

    if (jQuery('input[name=merk_hidden]').length) {
        var hiddenmerk = jQuery("#sp_merk_hidden").val();
        
        if(hiddenmerk !== ''){
            jQuery('input[name=merk_hidden]').val(hiddenmerk);
        }
        
    }
    if (jQuery('input[name=model_hidden]').length) {
        var hiddenmodel = jQuery("#sp_model_hidden").val();
        
        if(hiddenmodel !== ''){
            jQuery('input[name=model_hidden]').val(hiddenmodel);
        }
        
    }

    // var splidex = new Splide( '.sp_grid_wrap',{
    //         type   : 'slide',
    //         width : '100%',
    //         start: 0,
    //         perPage: 4,
    //         perMove: 2,
    //         gap:"2rem",
    //         pagination:false,
    //         breakpoints: {
    //             '1100': {
    //                 perPage: 3,
    //                 gap    : '1rem',
    //                 perMove: 1
    //             },
    //             '800': {
    //                 perPage: 2,
    //                 gap    : '1rem',
    //                 perMove: 1
    //             },
    //             '500': {
    //                 perPage: 1,
    //                 gap    : '1rem',
    //                 perMove: 1

    //             },
    //         }
           
    //     } ).mount();

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



    jQuery(".fbshare").on("click",function(e){
        var url = window.location.href;
        window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(url)+ '', 'left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0',"_self");

    });
    jQuery(".twittershare").on("click",function(e){
        var url = window.location.href;
        var text = jQuery(".wagentitel_h1").html().trim();
        window.open('http://twitter.com/share?url='+encodeURIComponent(url)+'&text='+encodeURIComponent(text), '', 'left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
    });
    jQuery(".whatsappshare").on("click",function(e){
        var url = window.location.href;
        var tel = jQuery(".sp_sticky_telefoneren").html().trim();
        var text = jQuery(".wagentitel_h1").html().trim();
        window.open('https://api.whatsapp.com/send?phone='+tel+'&text='+url+"\n"+text,'_blank');
    });
    jQuery(".mailshare").on("click",function(e){
        var email = "persoon@mail.com";
        var subject = window.location.href;
        var emailBody = jQuery(".wagentitel_h1").html().trim();
        document.location = "mailto:"+email+"?subject="+subject+"&body="+emailBody;

    });

    
    jQuery(".sp_sticky_vergelijken").on("click",function(){

        var postid = jQuery(this).attr("data-post-id");
        var huidigecookies = [];

        if(Cookies.get('vergelijk_ids')){
            
            huidigecookies = JSON.parse(Cookies.get('vergelijk_ids'));
            if(huidigecookies.length < 4){
            if(huidigecookies.indexOf(postid) == -1){
               
                    huidigecookies.push(postid);
                
            }
        }
            else{
                alert("Je kan maximaal 4 wagens vegelijken.");
            }

        }
        else{

            huidigecookies.push(postid);

        }


        Cookies.set('vergelijk_ids', JSON.stringify(huidigecookies), { expires: 7 });

        window.location.href = "/vergelijken/";

    });
    
});