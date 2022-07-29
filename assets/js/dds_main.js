jQuery(document).ready(function($){


    if($(".rel_splide").length !== 0){
      
      var rel_splide = new Splide( '.splide', {
        perPage: 4,
        perMove: 1,
        rewind : true,
      } );
      
      rel_splide.mount();

    }
   

});