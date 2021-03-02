jQuery(document).ready(function(){

    jQuery("#sp_contact_versturen").on("click",function(){
        var sp_contact_name = jQuery("input[name=sp_contact_name]").val();
        var sp_contact_mail = jQuery("input[name=sp_contact_mail]").val();
        var sp_contact_tel = jQuery("input[name=sp_contact_tel]").val();
        var sp_contact_bericht = jQuery("textarea[name=sp_contact_bericht]").val();

        var contactajax = $.post("https://" + document.domain + "/wp-content/plugins/carsync/php/ajax_contact.php", { sp_contact_name: sp_contact_name, sp_contact_mail: sp_contact_mail,sp_contact_tel:sp_contact_tel,sp_contact_bericht:sp_contact_bericht}, function(data) {
            console.log(data);    
            // var res = JSON.parse(data);   
            
            // if(res[0] == "verplichtevelden"){
            //     console.log("verplichtevelden");
            // }
            // else{
            //     console.log("goedzo");
            // }

          })
            .fail(function() {
                console.log( "error" );
            });
           

    });

});