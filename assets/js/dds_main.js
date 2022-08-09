jQuery(document).ready(function($){

  

    if($(".rel_splide").length !== 0){
      
      var rel_splide = new Splide( '.rel_splide', {
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
   
    if($(".compare_splide").length !== 0){
      
      $(".add_comp_item").on("click",function(){
        window.location.href = "/autos/";
      });
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
            gap: 5
          },
          380: {
            perPage: 1,
          },
        }
      } );
      
      rel_splide.mount();

    }
});