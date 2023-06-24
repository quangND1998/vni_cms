$('.slider_cat').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 2500,
    infinite: true,
    dots: false,
    responsive: [
         {
           breakpoint: 1025,
           settings: {
             arrows: false,
           }
         },
         {
           breakpoint: 801,
           settings: {
             slidesToShow: 3,
             arrows: false,
           }
         },
         {
           breakpoint: 600,
           settings: {
             slidesToShow: 2,
             arrows: false,
           }
         },
         {
           breakpoint: 481,
           settings: {
             slidesToShow: 2,
             arrows: false,
           }
         }
       ]
  });

 $('.slider_business').slick({
    slidesPerRow: 3,
    rows: 2,
    slidesToScroll: 1,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 2500,
    infinite: true,
    dots: false,
    responsive: [
         {
           breakpoint: 1025,
           settings: {
             arrows: false,
           }
         },
         {
           breakpoint: 801,
           settings: {
             slidesPerRow: 3,
             arrows: false,
           }
         },
         {
           breakpoint: 600,
           settings: {
             slidesPerRow: 1,
             rows: 2,
             arrows: false,
           }
         },
         {
           breakpoint: 481,
           settings: {
             slidesPerRow: 1,
             rows: 2,
             arrows: false,
           }
         }
       ]
  });

 $('.slider_news').slick({
    slidesToShow: 2,
    slidesToScroll: 2,
    arrows: true,
    autoplay: true,
   //  rows:2,
    autoplaySpeed: 3500,
    infinite: true,
    dots: false,
    responsive: [
         {
           breakpoint: 1025,
           settings: {
             arrows: false,
           }
         },
         {
           breakpoint: 801,
           settings: {
             slidesToShow: 2,
             arrows: false,
           }
         },
         {
           breakpoint: 600,
           settings: {
             slidesToShow: 1,
             arrows: false,
           }
         },
         {
           breakpoint: 481,
           settings: {
             slidesToShow: 1,
             arrows: false,
           }
         }
       ]
  });

  $('.slider_app ').slick({
   slidesToShow: 3,
   slidesToScroll: 1,
   arrows: true,
   autoplay: true,
   autoplaySpeed: 2500,
   infinite: true,
   dots: false,
   responsive: [
        {
          breakpoint: 1025,
          settings: {
            arrows: false,
          }
        },
        {
          breakpoint: 801,
          settings: {
            slidesToShow: 2,
            arrows: false,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            arrows: false,
          }
        },
        {
          breakpoint: 481,
          settings: {
            slidesToShow: 1,
            arrows: false,
          }
        }
      ]
 });

 $('.slider_product').slick({
   slidesToShow: 3,
   slidesToScroll: 1,
   arrows: true,
   autoplay: false,
   rows:2,
   margin:10,
   autoplaySpeed: 2500,
   infinite: true,
   dots: false,
   responsive: [
        {
          breakpoint: 1025,
          settings: {
            arrows: false,
          }
        },
        {
          breakpoint: 801,
          settings: {
            slidesToShow: 2,
            arrows: false,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            arrows: false,
          }
        },
        {
          breakpoint: 481,
          settings: {
            slidesToShow: 1,
            arrows: false,
          }
        }
      ]
 });

 $('.page_item_3drenders ').slick({
   slidesToShow: 3,
   slidesToScroll: 1,
   arrows: true,
   autoplay: true,
   autoplaySpeed: 2500,
   infinite: false,
   dots: false,
   responsive: [
        {
          breakpoint: 1025,
          settings: {
            arrows: false,
          }
        },
        {
          breakpoint: 801,
          settings: {
            slidesToShow: 2,
            arrows: false,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            arrows: false,
          }
        },
        {
          breakpoint: 481,
          settings: {
            slidesToShow: 1,
            arrows: false,
          }
        }
      ]
 });
 $('.slider_doitac').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2500,
    infinite: true,
    dots: false,
    responsive: [
         {
           breakpoint: 1025,
           settings: {
             arrows: false,
           }
         },
         {
           breakpoint: 801,
           settings: {
             slidesToShow: 4,
             arrows: false,
           }
         },
         {
           breakpoint: 600,
           settings: {
             slidesToShow: 3,
             arrows: false,
           }
         },
         {
           breakpoint: 481,
           settings: {
             slidesToShow: 2,
             arrows: false,
           }
         }
       ]
  });


 $(document).ready( function(){
   $('.slider-gallery').slick({
     slidesToShow: 1,
     slidesToScroll: 1,
     arrows: false,
     fade: true,
     autoplay: true,
     autoplaySpeed: 2500,
     asNavFor: '.slider-icon'
   });

   setTimeout(function () {
       $('.box_gallery').show();
   }, 100);

     $('.slider-icon').slick({
     slidesToShow: 4,
     asNavFor: '.slider-gallery',
     arrows: true,
     focusOnSelect: true,
     responsive: [
           {
             breakpoint: 1025,
             settings: {
               arrows: false,
             }
           },
           {
             breakpoint: 801,
             settings: {
               slidesToShow: 3,
               arrows: false,
             }
           },
           {
             breakpoint: 600,
             settings: {
               slidesToShow: 2,
               arrows: false,
             }
           },
           {
             breakpoint: 481,
             settings: {
               slidesToShow: 2,
               arrows: false,
             }
           }
         ]
   });
 });

 $('.slider_brand').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 1500,
    infinite: true,
    dots: false
 });

 $('.slider-for').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   arrows: false,
   fade: true,
   autoplay:true,
   asNavFor: '.slider-nav'
 });
 $('.slider-nav').slick({
   slidesToShow: 3,
   slidesToScroll: 1,
   asNavFor: '.slider-for',
   dots: false,
   centerMode: true,
   focusOnSelect: true,
   autoplay:true
 });
