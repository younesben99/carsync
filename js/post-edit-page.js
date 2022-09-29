(function($) {

    $(document).ready(function(){


        
      
        $( "#dash-status" ).on( "change", function( event ) {
            event.preventDefault();
            console.log( $( this ).val() );
            var opt = $( this ).val();
            if(opt == "archief"){
              $(this).prev(".dash-status-dot").find("span").removeClass();
              $(this).prev(".dash-status-dot").find("span").addClass("archief");  
              $("#carsync-input").val("NO");
              $("#car_post_status_id").val("archief");
              
              $.post("/wp-content/plugins/dds-dashboard/templates/dash-ajax.php",
              {
                dashstatus: "archief",
                postid: $(this).find("option").attr("data-post-id")
              },
              function(data,status){
                console.log(data + status);
              });
    
    
            }
            if(opt == "nglive"){
              $(this).prev(".dash-status-dot").find("span").removeClass();
              $(this).prev(".dash-status-dot").find("span").addClass("nglive");
              $("#carsync-input").val("NO");
              $("#car_post_status_id").val("actief");

              $.post("/wp-content/plugins/dds-dashboard/templates/dash-ajax.php",
              {
                dashstatus: "nglive",
                postid: $(this).find("option").attr("data-post-id")
              },
              function(data,status){
                console.log(data + status);
              });
            }
            if(opt == "live"){
              $(this).prev(".dash-status-dot").find("span").removeClass();
              $(this).prev(".dash-status-dot").find("span").addClass("live");
              $("#carsync-input").val("YES");
              $("#car_post_status_id").val("actief");

              $.post("/wp-content/plugins/dds-dashboard/templates/dash-ajax.php",
              {
                dashstatus: "live",
                postid: $(this).find("option").attr("data-post-id")
              },
              function(data,status){
                console.log(data + status);
              });
            }
            if(opt == "concept"){
              $(this).prev(".dash-status-dot").find("span").removeClass();
              $(this).prev(".dash-status-dot").find("span").addClass("concept");
              $("#carsync-input").val("YES");
              $("#car_post_status_id").val("concept");

              $.post("/wp-content/plugins/dds-dashboard/templates/dash-ajax.php",
              {
                dashstatus: "concept",
                postid: $(this).find("option").attr("data-post-id")
              },
              function(data,status){
                console.log(data + status);
              });
            }
        });
    
    
        $( "#dash-post-status" ).on( "change", function( event ) {
          event.preventDefault();
          console.log( $( this ).val() );
          var opt = $( this ).val();
          if(opt == "tekoop"){
            $(this).prev(".dash-post-status-dot").find("span").removeClass();
            $(this).prev(".dash-post-status-dot").find("span").addClass("tekoop");  
            $("#carstatus-input").val("tekoop");

            $.post("/wp-content/plugins/dds-dashboard/templates/dash-ajax.php",
            {
              dashpoststatus: "tekoop",
              postid: $(this).find("option").attr("data-post-id")
            },
            function(data,status){
              console.log(data + status);
            });
    
    
          }
          if(opt == "gereserveerd"){
            $(this).prev(".dash-post-status-dot").find("span").removeClass();
            $(this).prev(".dash-post-status-dot").find("span").addClass("gereserveerd");
            $("#carstatus-input").val("gereserveerd");

            $.post("/wp-content/plugins/dds-dashboard/templates/dash-ajax.php",
            {
              dashpoststatus: "gereserveerd",
              postid: $(this).find("option").attr("data-post-id")
            },
            function(data,status){
              console.log(data + status);
            });
          }
          if(opt == "verkocht"){
            $(this).prev(".dash-post-status-dot").find("span").removeClass();
            $(this).prev(".dash-post-status-dot").find("span").addClass("verkocht");
            $("#carstatus-input").val("verkocht");

            $.post("/wp-content/plugins/dds-dashboard/templates/dash-ajax.php",
            {
              dashpoststatus: "verkocht",
              postid: $(this).find("option").attr("data-post-id")
            },
            function(data,status){
              console.log(data + status);
            });
          }
      });

    
    $("#cardescription-input").trumbowyg();

    $("#publish").on("click",function(){
        if($("#syncimages-input").val() == "YES" && $("#carsync-input").val() == "NO" && $("#gallery-metabox-list").children().length === 0){
            
              Swal.fire({
                type: 'succes',
                title: 'De foto\'s worden gedownload naar uw website',
                text: 'Een ogenblik geduld...',
                showConfirmButton: false,
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
              })
        }
       
    });


    $("#carmerk-input").select2({placeholder: "Selecteer Merk",disabled: true});
    $("#carmodel-input").select2({placeholder: "Selecteer Model",disabled: true}); 

    //nieuw
    $(".car-merk").select2({placeholder: "Selecteer Model",disabled: false}); 
    $(".car-model").select2({placeholder: "Selecteer Model",disabled: false});
    
    //selecteer merk en model

    currentmerk = $("#merkcfid").text();
    currentmodel = $("#modelcfid").text();

    $(".car-merk").val(currentmerk);
    $('.car-merk').trigger('change');

    $(".car-model").val(currentmodel);
    $('.car-model').trigger('change');

    $(".car-merk").on("change",function(){

     


      //hide alles
      $(".modeloption").prop("disabled",true);


      $(".currentmodel").prop("disabled",true);
      $(".currentmodel").prop("selected",false);


      

      merkid = $(this).find('option:selected').attr("data-merkid");
      console.log(merkid);
      $( ".car-model > option" ).each(function( index ) {
        
            if($( this ).attr("data-merkid") == merkid){
            
              $( this ).prop("disabled",false);
            }
      });

      
      $(".selecteermodel").prop("disabled",true);
      $(".selecteermodel").prop('selected', true);
      $(".car-model").val("select");
      $('.car-model').trigger('change');

 });
  


 /*
    var idvoormodel;
    console.log("succes");
    
    $.ajax({
      url: "https://bnyautocenter.be/wp-json/mm/mmc/",
      headers: { "Access-Control-Allow-Origin": "*"}
      , success: function(data){
        
        $( data ).each(function( index ) {
          var formattedmerk = data[index].name.replace(/[\. ,:-]+/g).toLowerCase();
          idvoormodel = data[index].term_id;
          $("#carmerk-input").append("<option termid="+idvoormodel+"  merktag="+formattedmerk+" >"+ data[index].name + "</option>");
      });
      $("#carmerk-input").removeAttr("disabled");
    }});

*/
    
     /* $("#carmerk-input").on("change",function(){
        $("#carmodel-input").html("");
        
        
            var termidforpush = $("#carmerk-input option:selected").attr("termid");
        $.get("https://bnyautocenter.be/wp-json/mm/mmx/" + termidforpush,function( data ){
            
            $("#carmodel-input").append("<option></option>");
            $( data.name ).each(function( index ) {
                var formattedmodel = data.name[index].replace(/[\. ,:-]+/g).toLowerCase();
                $("#carmodel-input").append("<option termid="+ data.name[index]+"  modeltag="+formattedmodel+">"+ data.name[index] + "</option>");
            });
            $("#carmodel-input").removeAttr("disabled");
          });
          

      });
      */
      

      $(".showmoreselectief").on("click",function(){
        $(".showmoreselectief .dashicons-arrow-down-alt2").toggleClass("dashicons-arrow-up-alt2");
        $(".secondary_ophaal_options").slideToggle();
  
  });
  $("#offerteopenen").on("click",function(e){
    e.preventDefault();

    var postid = $(this).attr("data-post-id");
    var siteurl = $(this).attr("data-site-url") + "/wp-content/plugins/carsync/php/zapier/zapier_delay.php" + "?postid="+postid;
    window.open(siteurl, '_blank');

  });

  $("#offerteaanmaken").on("click",function(e){
    e.preventDefault();


    //error reporting fallback moet hier NOG inkomen

    $("#vraag_offerte_aanmaken").val("MAKEN");
    $("#publish").trigger("click");

    // Swal.fire({
    //   type: 'succes',
    //   title: 'De offerte wordt aangemaakt',
    //   text: 'Een ogenblik geduld...',
    //   showConfirmButton: false,
    //   allowOutsideClick: true,
    //   onBeforeOpen: () => {
    //       Swal.showLoading()
    //   },
    // })

     
    // $.post("/wp-content/plugins/dds-dashboard/templates/dash-ajax.php",
    // {
    //   actie: "offerte_aanmaken",
    //   postid: $(this).attr("data-post-id")
    // },
    // function(data,status){
    //   console.log("data: "+data);
    //   Swal.close();

    //   if(data == "succes"){
    //     Swal.fire({
    //       icon: 'succes',
    //       title: 'De Offerte is aangemaakt',
    //       text: 'link: '+data,
    //       showConfirmButton: true,
    //       allowOutsideClick: true
    //     });
    //   }
    //   else{
    //     Swal.fire({
    //       icon: 'error',
    //       title: 'Er is een fout opgetreden',
    //       text: '',
    //       showConfirmButton: true,
    //       allowOutsideClick: true
    //     });
    //   }
      
    // });


  });

  
});




})(jQuery);    