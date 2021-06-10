jQuery(document).ready(function(){

    jQuery(".contactpop,.sp_smv_mail").on("click",function(){
        
        jQuery(".sp_contact_pop_wrap").show();
        jQuery(".sp_contact_pop_wrap").animate({
                        'opacity': '1',
                        'bottom': 0
        }, 300);

    });
    jQuery(".sp_contact_pop_wrap,.contactsluiten").on('click', function (e) {
        jQuery(".sp_contact_pop_wrap").animate({
            'opacity': '0',
            'bottom': '-100vh'
        }, 300);
        setTimeout(function () {
            jQuery(".sp_contact_pop_wrap").hide();
        }, 300);
    }).on('click', 'div', function (e) {
        e.stopPropagation();
    });

    jQuery(".sp_contact_form").submit(function(event) {

        event.preventDefault();

        var sp_contact_name = jQuery("input[name=sp_contact_name]").val().trim();
        var sp_contact_mail = jQuery("input[name=sp_contact_mail]").val().trim();
        var sp_contact_tel = jQuery("input[name=sp_contact_tel]").val().trim();
        var sp_contact_wagen = jQuery(".sp_title > h5").html().trim();
        var sp_contact_bericht = jQuery("textarea[name=sp_contact_bericht]").val().trim();

        if(sp_contact_name == "" || sp_contact_mail == "" || sp_contact_tel == "" || sp_contact_bericht == ""){
            jQuery(".sp_contact_pop .warning").html("");
            jQuery(".sp_contact_pop .warning").show();
            if(sp_contact_name == ""){
                jQuery(".sp_contact_pop .warning").append("<li>Het veld: naam, is verplicht</li>");
            }
            if(sp_contact_mail == ""){
                jQuery(".sp_contact_pop .warning").append("<li>Het veld: e-mailadres, is verplicht</li>");
            }
            if(sp_contact_tel == ""){
                jQuery(".sp_contact_pop .warning").append("<li>Het veld: telefoonnummer, is verplicht</li>");
            }
            if(sp_contact_bericht == ""){
                jQuery(".sp_contact_pop .warning").append("<li>Het veld: bericht, is verplicht</li>");
            }

            
        }
        else{
            if(!jQuery(".sp_contact_versturen").hasClass("sp_contact_loading")){
                console.log("hit");
                jQuery(".sp_contact_versturen").addClass("sp_contact_loading");
                jQuery(".sp_contact_pop .warning").hide();
                var contactajax = $.post("https://" + document.domain + "/wp-content/plugins/carsync/php/ajax_contact.php", { sp_contact: "sp_contact",sp_contact_wagen:sp_contact_wagen,sp_contact_name: sp_contact_name, sp_contact_mail: sp_contact_mail,sp_contact_tel:sp_contact_tel,sp_contact_bericht:sp_contact_bericht}, function(data) {
                        
                    var res = JSON.parse(data);   
                    
                    if(res[0] == "verplichtevelden"){
                        console.log("verplichtevelden");
                    }
                    else{
                        console.log("succes");
                        jQuery(".sp_contact_succes").show();
                        setTimeout(function(){
                            //window.location.replace("/bedankt");
                        },2000);
                    }
                    jQuery(".sp_contact_versturen").removeClass("sp_contact_loading");
        
                  })
                    .fail(function() {
                        jQuery(".sp_contact_versturen").removeClass("sp_contact_loading");
                        console.log( "error" );
                    });
            }
            

        }

       
        

    });

});