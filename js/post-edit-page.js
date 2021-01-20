(function($) {

    $(document).ready(function(){
    
    $("#cardescription-input").trumbowyg();

    $("#publish").on("click",function(){
        if($("#carsync-input").val() == "NO" && $("#gallery-metabox-list").children().length === 0 ){
            
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
 
    var idvoormodel;
    $.get("https://bnyautocenter.be/wp-json/mm/mmc/",function( data ){
        $( data ).each(function( index ) {
            var formattedmerk = data[index].name.replace(/[\. ,:-]+/g).toLowerCase();
            idvoormodel = data[index].term_id;
            $("#carmerk-input").append("<option termid="+idvoormodel+"  merktag="+formattedmerk+" >"+ data[index].name + "</option>");
        });
        $("#carmerk-input").removeAttr("disabled");
      });
      $("#carmerk-input").on("change",function(){
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
      
      $("#archief_switch").on("click",function(){
        if($("#archief_switch").prop('checked')){
            $("#car_post_status_id").val("Actief");
        }
        else{
            $("#car_post_status_id").val("Archief");
            $("#sync_switch").trigger("click");
        }
      });
      
      $("#sync_switch").on("click",function(){
        if($("#sync_switch").prop('checked')){
            $("#carsync-input").val("NO");
        }
        else{
            $("#carsync-input").val("YES");
        }
      });

      $("#verkocht_switch").on("click",function(){
        if($("#verkocht_switch").prop('checked')){
            $("#carstatus-input").val("VERKOCHT");
            if($("#sync_switch").prop('checked') == false){
                $("#sync_switch").trigger("click");
            }
            
           
        }
        else{
            $("#carstatus-input").val("ACTIEF");
        }
      });
    
});

})(jQuery);    