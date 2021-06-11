jQuery(document).ready(function(){

    jQuery(".sp_sticky_testrit,.sp_smv_testrit").on("click",function(){
        
        jQuery(".sp_testrit_pop_wrap").show();
        jQuery(".sp_testrit_pop_wrap").animate({
                        'opacity': '1',
                        'bottom': 0
        }, 300);

    });
    jQuery(".sp_testrit_pop_wrap,.testritsluiten").on('click', function (e) {
        jQuery(".sp_testrit_pop_wrap").animate({
            'opacity': '0',
            'bottom': '-100vh'
        }, 300);
        setTimeout(function () {
            jQuery(".sp_testrit_pop_wrap").hide();
        }, 300);
    }).on('click', 'div', function (e) {
        e.stopPropagation();
    });
    
    jQuery(".sp_testrit_form").submit(function(event) {

        event.preventDefault();

        var sp_testrit_name = jQuery("input[name=sp_testrit_name]").val().trim();
        var sp_testrit_mail = jQuery("input[name=sp_testrit_mail]").val().trim();
        var sp_testrit_tel = jQuery("input[name=sp_testrit_tel]").val().trim();
        var sp_testrit_bericht = jQuery("textarea[name=sp_testrit_bericht]").val().trim();
        var sp_testrit_wagen = jQuery(".sp_title > h5").html().trim();

        if(sp_testrit_name == "" || sp_testrit_mail == "" || sp_testrit_tel == "" || sp_testrit_bericht == ""){
            jQuery(".sp_testrit_pop .warning").html("");
            jQuery(".sp_testrit_pop .warning").show();
            if(sp_testrit_name == ""){
                jQuery(".sp_testrit_pop .warning").append("<li>Het veld: naam, is verplicht</li>");
            }
            if(sp_testrit_mail == ""){
                jQuery(".sp_testrit_pop .warning").append("<li>Het veld: e-mailadres, is verplicht</li>");
            }
            if(sp_testrit_tel == ""){
                jQuery(".sp_testrit_pop .warning").append("<li>Het veld: telefoonnummer, is verplicht</li>");
            }
            if(sp_testrit_bericht == ""){
                jQuery(".sp_testrit_pop .warning").append("<li>Het veld: bericht, is verplicht</li>");
            }

            
        }
        else{
            if(!jQuery(".sp_testrit_versturen").hasClass("sp_testrit_loading")){

                var sp_datum = jQuery("#testrit_datum").val();
                var sp_tijdstip = jQuery("#testrit_tijdstip").val();
                
                jQuery(".sp_testrit_versturen").addClass("sp_testrit_loading");
                jQuery(".sp_testrit_pop .warning").hide();
                var testritajax = $.post("https://" + document.domain + "/wp-content/plugins/carsync/php/ajax_contact.php", { sp_testrit: "sp_testrit",sp_datum:sp_datum,sp_tijdstip:sp_tijdstip,sp_testrit_wagen:sp_testrit_wagen,sp_testrit_name: sp_testrit_name, sp_testrit_mail: sp_testrit_mail,sp_testrit_tel:sp_testrit_tel,sp_testrit_bericht:sp_testrit_bericht}, function(data) {
                        
                    var res = JSON.parse(data);   
                    
                    if(res[0] == "verplichtevelden"){
                        console.log("verplichtevelden");
                    }
                    else{
                        console.log("succes");
                        jQuery(".sp_testrit_succes").show();
                        setTimeout(function(){
                            //window.location.replace("/bedankt");
                        },2000);
                    }
                    jQuery(".sp_testrit_versturen").removeClass("sp_testrit_loading");
        
                  })
                    .fail(function() {
                        jQuery(".sp_testrit_versturen").removeClass("sp_testrit_loading");
                        console.log( "error" );
                    });
            }
            

        }

       
        

    });

});