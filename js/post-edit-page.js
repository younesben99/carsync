(function($) {

    $(document).ready(function(){
        
    $("#carmerk-input").select2(); 
    $.get("https://bnyautocenter.be/wp-json/mm/mmc/",function( data ){

        $( data ).each(function( index ) {
            var formattedmerk = data[index].name;
            formattedmerk = formattedmerk.replace(/[\. ,:-]+/g).toLowerCase();
            $("#carmerk-input").append("<option termid="+data[index].term_id+"  merktag="+formattedmerk+">"+ data[index].name + "</option>");
        });
      });
    
    
});
})(jQuery);    