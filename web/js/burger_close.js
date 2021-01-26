;(function() {
  // Кнопка меню
  const btnMenu = document.getElementById('btnMenu')

  // Закрытие меню когда нажимаем на другой участок кода
  document.getElementById('header').addEventListener('click', function() {
    btnMenu.classList.remove('is-open')
    document.getElementById('navbarTogglerDemo02').classList.remove('show')
  })
  document.getElementById('main').addEventListener('click', function() {
    btnMenu.classList.remove('is-open')
    document.getElementById('navbarTogglerDemo02').classList.remove('show')
  })
  document.getElementById('footer').addEventListener('click', function() {
    btnMenu.classList.remove('is-open')
    document.getElementById('navbarTogglerDemo02').classList.remove('show')
  })

  // Закрываем меню при скроле
  $(window).scroll(function() {
    var height = $(window).scrollTop()
    /*Если сделали скролл на 100px задаём новый класс для header*/
    if (height > 70) {
      btnMenu.classList.remove('is-open')
      document.getElementById('navbarTogglerDemo02').classList.remove('show')
    }
  })
})()
