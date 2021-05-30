(function($) {

    $(document).ready(function(){
        

        function DDS_data_call(vin,codes){
            console.log(vin+ " " + codes);
            var apikey = "1fe6395c-8831-4d16-864c-a4357a919953";

            var apiurl = "http://api.inmotiv.be/rest/lookup/1.6/" + apikey + "/" + vin  + "/" + codes; 


            $.post("https://" + document.domain + "/wp-content/plugins/carsync/php/ajax_data_extern_ophalen.php", {"data_tp": apiurl}, function(data) {
           console.log(data);
        });

        }

        //vin check

        if($("#carvin-input").val().length == 17){
            $(".checkvinwrap").css("opacity","1");
            $("#carvin-input").css("border-color","#30AEE3");
        }

        $("#carvin-input").on("keydown",function(){
            if($(this).val().length !== 17){
                $(".checkvinwrap").css("opacity","0");
                $("#carvin-input").css("border-color","#ccd0d4");
            }
            else{
                $(".checkvinwrap").css("opacity","1");
                $("#carvin-input").css("border-color","#30AEE3");
            }
        });



        //data calls


        $('button[id ^= "cardatacall"]').on("click",function(e){ 
            e.preventDefault();
            var codes = $(this).attr("data-codes");  
            if($("#carvin-input").val().length == 17){
                var vin = $("#carvin-input").val();
                
                DDS_data_call(vin, codes);
            }
            else{
                alert("Chassisnummer is incorrect");
            }
        });

    });

})(jQuery);