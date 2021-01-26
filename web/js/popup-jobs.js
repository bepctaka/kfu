$(document).ready(function() {
  $('.btn-popup').click(function() {
    $('.popup-jobs').css('visibility', 'visible')
    $('.popup-jobs__content').addClass('is-active__jobs__content')
  })

  $('.close').click(function() {
    $('.popup-jobs__content').removeClass('is-active__jobs__content')
    $('.popup-jobs').css('visibility', 'hidden')
  })
})
