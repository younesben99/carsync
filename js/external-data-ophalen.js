(function($) {

    $(document).ready(function(){
        $(".ddsloadingwrap").fadeOut("fast");
        

        function DDS_data_call(vin,codes){
          
            console.log(vin+ " " + codes);
            var apikey = "46e5e34b-62aa-4b05-a9c7-35d256ab8c41";

            var apiurl = "http://api.inmotiv.be/rest/lookup/1.6/" + apikey + "/" + vin  + "/" + codes; 

            var newpost = $(".typeofpage").html();
   
            var postid = $(".currentPID").val();

            $.post("https://" + document.domain + "/wp-content/plugins/carsync/php/ajax_data_extern_ophalen.php", {"data_tp": apiurl,"typeofpost":newpost,"vin":vin,"post_id":postid}, function(data) {
          
            var cardata = JSON.parse(data);
            
            
            
            if(cardata[0] == "new" || cardata[0] == "notnew"){
                var newid = cardata[1];
               
                window.location.replace("https://" + document.domain + "/wp-admin/post.php?post="+newid+"&action=edit");
               

            }
            else{
                $(".ddsloadingwrap").hide();
               Swal.fire({
                icon: 'error',
                text: cardata[1]
              });
               
            }
        });
        
        }

        //vin check

        if($("#carvin-input").val().length == 17){
            $(".checkvinwrap").css("opacity","1");
            $("#carvin-input").css("border-color","#30AEE3");
        }

        $("#carvin-input").on("keyup",function(){
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

        

        
        $('button[id ^= "cardatacall"],#cardatacall').on("click",function(e){ 
            e.preventDefault();

            $(".ddsloadingwrap").show();
            
            $(this).prop("disabled","true");

            var codes = $(this).attr("data-codes");  

            if($("#carvin-input").val().length == 17){
                var vin = $("#carvin-input").val();
                
                DDS_data_call(vin, codes);

                $(this).removeAttr('disabled');

                
               
            }
            else{
                $(this).removeAttr('disabled');
                $(".ddsloadingwrap").hide();
                
                console.log("Chassisnummer is incorrect");
                Swal.fire({
                    icon: 'error',
                    text: 'Chassisnummer is incorrect'
                  });
            }

            
        });


        $("#cardatashow").on("click",function(e){
            e.preventDefault();
            $(".ddsloadingwrap").show();
            var postid = $(".currentPID").val();
           
            var url = "https://" + document.domain + "/wp-content/plugins/carsync/php/pdf_gen/cardata.php?pid="+postid;
            window.open(url, '_blank').focus();
          
            $(".ddsloadingwrap").hide();
         
        });

        $("#cardatacsv").on("click",function(e){
            e.preventDefault();
            $(".ddsloadingwrap").show();
            var postid = $(".currentPID").val();
           
            var url = "https://" + document.domain + "/wp-content/plugins/carsync/php/pdf_gen/cardata_csv.php?pid="+postid;
            window.open(url, '_blank').focus();
            $(".ddsloadingwrap").hide();
            
        });

        $("#caraankoopovereenkomst").on("click",function(e){
            e.preventDefault();
            
            $(".aankoopborderel_popup_wrap").css("display","flex");
  
        });

        $("#carbestelbon").on("click",function(e){
            e.preventDefault();
            
            $(".bestelbon_popup_wrap").css("display","flex");
  
        });


        $("#ab_aanmaken").on("click",function(e){
            e.preventDefault();     

            

            var postid = $(".currentPID").val();

            var fields = {};

            $(".aankoopborderel_popup input").each(function(x,s){
                var name = $(s).attr("name");
                fields[name] = $(s).val();

            });

            $(".aankoopborderel_popup input[type=checkbox]").each(function(x,s){
                var name = $(s).attr("name");
                
                if($(this).is(":checked")){
                    fields[name] = "yes";
                }
                else{
                    fields[name] = "no";
                }

            });
            fields["pid"] = postid;

            var url = "https://" + document.domain + "/wp-content/plugins/carsync/php/pdf_gen/mPDF_aankoop.php?"+ $.param(fields);
            window.open(url, '_blank').focus();

            $(this).closest(".aankoopborderel_popup_wrap").fadeOut();

        });

        $("#bb_aanmaken").on("click",function(e){
            e.preventDefault();     

            

            var postid = $(".currentPID").val();

            var fields = {};

            $(".bestelbon_popup input").each(function(x,s){
                var name = $(s).attr("name");
                fields[name] = $(s).val();

            });

            $(".bestelbon_popup input[type=checkbox]").each(function(x,s){
                var name = $(s).attr("name");
                
                if($(this).is(":checked")){
                    fields[name] = "yes";
                }
                else{
                    fields[name] = "no";
                }

            });
            fields["pid"] = postid;

            var url = "https://" + document.domain + "/wp-content/plugins/carsync/php/pdf_gen/bestelbon.php?"+ $.param(fields);
            window.open(url, '_blank').focus();

            $(this).closest(".aankoopborderel_popup_wrap").fadeOut();

        });
        

      

        $(".toonhiddenfields").on("click",function(){

            $(this).next(".hidefields").slideToggle();
            if($(this).html() == "Toon meer"){
                $(this).html("Toon minder");
            }
            else{
                $(this).html("Toon meer");
            }
            

        });

        

    });

})(jQuery);