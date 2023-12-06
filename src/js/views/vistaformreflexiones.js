function inicio () {
  const div = document.getElementById('vistaForm')
  const btnaniadir = document.getElementById('aniadir')
  const formulario = document.getElementById('form-end')

  btnaniadir.onclick = function () {
    // Clonar el formulario
    const clonedFormulario = formulario.cloneNode(true)

    // Recorrer los elementos del formulario clonado
    clonedFormulario.querySelectorAll('input, textarea').forEach(function (input) {
      // Establecer el valor del campo clonado según el valor del campo original
      input.value = ''
    })

    // Eliminar el atributo "id" para evitar duplicados en los clones
    clonedFormulario.removeAttribute('id')

    const btnBorrar = clonedFormulario.querySelector('.borrar')
    btnBorrar.onclick = function () {
      div.removeChild(clonedFormulario)
    }

    clonedFormulario.appendChild(btnBorrar)
    div.appendChild(clonedFormulario)
  }
}

window.onload = inicio
