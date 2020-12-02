(function($) {

    $(document).ready(function(){
        
    $("#carmerk-input").select2();
    $("#carmodel-input").select2(); 
    $.get("https://bnyautocenter.be/wp-json/mm/mmc/",function( data ){

        $( data ).each(function( index ) {
            var formattedmerk = data[index].name;
            formattedmerk = formattedmerk.replace(/[\. ,:-]+/g).toLowerCase();
            var idvoormodel = data[index].term_id;
            $("#carmerk-input").append("<option termid="+data[index].term_id+"  merktag="+formattedmerk+">"+ data[index].name + "</option>");
        });
        
      });
      $.get("https://bnyautocenter.be/wp-json/mm/mmx/" + idvoormodel,function( data ){

        $( data ).each(function( index ) {
            var formattedmodel = data[index].name;
            formattedmodel = formattedmodel.replace(/[\. ,:-]+/g).toLowerCase();
            $("#carmodel-input").append("<option termid="+data[index].id+"  modeltag="+formattedmodel+">"+ data[index].name + "</option>");
        });
        
      });
    
});
})(jQuery);    