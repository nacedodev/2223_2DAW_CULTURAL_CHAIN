window.addEventListener('scroll', function () {
  const navbar = document.getElementById('navbar')
  const scrolled = window.scrollY > 40 // Cambiar el valor según la posición del scroll

  if (scrolled) {
    navbar.classList.add('translucent')
  } else {
    navbar.classList.remove('translucent')
  }
})
