(function($) {

    $(document).ready(function(){
    
    $("#fbpush").on("click",function(){
        var postid = jQuery(this).attr("postid");
        var fbclicked = jQuery(this).attr("didpush");
        if(fbclicked == "0"){
            $.post( "/wp-content/plugins/carsync/socialpush/facebook_push.php", { postidname: postid } ,function( data ) {
                jQuery("#fbpush").addClass("disabled");
                jQuery("#fbpush").attr("didpush","1");
              });
        }
        
          
    });

    $("#igpush").on("click",function(){
        var postid = jQuery(this).attr("postid");
        var fbclicked = jQuery(this).attr("didpush");
        if(fbclicked == "0"){
            $.post( "/wp-content/plugins/carsync/socialpush/instagram_push.php", { postidname: postid } ,function( data ) {
                console.log(data);
                jQuery("#igpush").addClass("disabled");
                jQuery("#igpush").attr("didpush","1");
                
              });
        }
        
          
    });
    $(".pushdisable").on("click",function(){
    
        Swal.fire({
            icon: 'info',
            title: 'Deze optie is uitgeschakeld',
            text: 'Neem contact op voor dit te activeren',
            footer: '<a href="mailto:info@digiflow.be">Mail ons</a>'
          })

    });
    
});

})(jQuery);    