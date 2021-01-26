var inputPhone = document.querySelectorAll('#inputPhone')

Inputmask({
  mask: '+\\9\\96(999)999-999',
  showMaskOnHover: false,
}).mask(inputPhone)
