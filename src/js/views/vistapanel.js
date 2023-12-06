const dot = document.getElementById('dot')
const redirect = document.getElementById('verificar')
redirect.onclick = redireccionar
const mostrarHora = () => {
  const hora = document.getElementById('hora')
  const fecha = new Date()
  let horas = fecha.getHours()
  let minutos = fecha.getMinutes()

  // Asegúrate de que los números siempre tengan dos dígitos
  if (horas < 10) horas = '0' + horas
  if (minutos < 10) minutos = '0' + minutos

  const horaActual = horas + ':' + minutos

  // Actualiza el contenido del elemento HTML con la hora actual
  hora.innerHTML = horaActual
}

setInterval(mostrarHora, 1000)
mostrarHora()
function redireccionar () {
  // Reemplaza el enlace con tu URL deseada
  window.location.href = 'index.php?controller=administracion&action=verificarWeb'
}
const adminParagraph = document.getElementById('admin')
const infoParagraph = document.getElementById('informacion')
const reflexionesParagraph = document.getElementById('text-reflexiones')
const estadoP = document.getElementById('text-estado')

// Verificar si el elemento 'text-reflexiones' existe
if (reflexionesParagraph) {
  // Ocultar los párrafos 'admin' e 'informacion' si existe 'text-reflexiones'
  adminParagraph.style.display = 'none'
  infoParagraph.style.display = 'none'
}

if (estadoP) {
  dot.style.visibility = 'visible'
}
