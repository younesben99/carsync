jQuery( document ).ready(function() {

    var popup = "";
    jQuery(".pop_open").on("click",function(e){
    e.preventDefault();
    popup = "." + jQuery(this).attr("data-popup");
 
    
    jQuery(popup).show();
    jQuery(popup).animate({
                    'opacity': '1',
                    'bottom': 0
    }, 300);

});

jQuery(".dds_pop_close,.pop_close").on('click', function (e) {
    e.preventDefault();
    jQuery(popup).animate({
        'opacity': '0',
        'bottom': '-100vh'
    }, 300);
    setTimeout(function () {
        jQuery(popup).hide();
    }, 300);
}).on('click', 'div', function (e) {
    e.stopPropagation();
});


});