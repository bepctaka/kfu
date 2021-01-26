let sliderShow = 2.336
if (window.innerWidth <= 1200) {
  sliderShow = 2
}
if (window.innerWidth <= 1000) {
  sliderShow = 1
}
$('.section-scoreboard').slick({
  slidesToShow: sliderShow,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
})

$('.slick-slider-images').slick({
  dots: false,
  arrows: false,
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
})

$('.table-soccer-slider').slick({
  dots: true,
  arrows: false,
})

$('.full-news__slider').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
  ],
})

$('.par_responsive').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [{
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
