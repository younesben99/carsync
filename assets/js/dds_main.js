jQuery(document).ready(function($){


    if($(".rel_splide").length !== 0){
      
      var rel_splide = new Splide( '.splide', {
        perPage: 4,
        perMove: 1,
        gap: 20,
        rewind : true,
        breakpoints: {
          1150:{
            perPage: 3,
          },
          770: {
            perPage: 2,
          },
          380: {
            perPage: 1,
          },
        }
      } );
      
      rel_splide.mount();

    }
   

});