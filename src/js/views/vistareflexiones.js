document.getElementById('addButton').addEventListener('click', function () {
  const reflectionsContainer = document.getElementById('reflections-container')
  const reflectionTemplate = document.createElement('div')
  reflectionTemplate.classList.add('reflection')

  const lastReflection = reflectionsContainer.lastElementChild // Obtener el último figure // Obtener el anterior al último figure

  if (lastReflection != null) {
    const tituloInput = lastReflection.querySelector('#title')
    const reflexionInput = lastReflection.querySelector('#content')

    console.log(tituloInput, reflexionInput)

    if (tituloInput != null) {
      const tituloValue = tituloInput.value
      const reflexionValue = reflexionInput.value

      // Verificar si el último div no está vacío (tanto el titulo como el contenido)
      if ((!tituloValue || tituloValue === '') && (!reflexionValue || reflexionValue === '')) {
        const addImg = document.querySelector('#addButton > img')
        addImg.style.animation = 'shakeAnimation 0.3s ease-in-out'
        setTimeout(() => {
          addImg.style.animation = 'none'
        }, 300)
        lastReflection.style.animation = 'warningAnimationRef 0.8s linear'
        setTimeout(() => {
          lastReflection.style.animation = 'none'
        }, 800)
        return
      }
    }
  }

  reflectionTemplate.innerHTML = `
    <input id="title" style='height: 50px; width:30%; display:inline-block;font-size:1vw; font-family: "Poppins", sans-serif' type='text' name='titulos[]' placeholder='Título'>
    <input id="content" style='width: 60%; display:inline-block; height: 50px;margin-left:65px; font-family: "Poppins", sans-serif' type='text' name='contenidos[]' placeholder='Reflexión'>
    <button class='remove-reflection' type='button'>-</button>
`

  reflectionsContainer.appendChild(reflectionTemplate)

  reflectionTemplate.scrollIntoView({ behavior: 'smooth' })
})

document.getElementById('reflections-container').addEventListener('click', function (event) {
  if (event.target.classList.contains('remove-reflection')) {
    event.target.parentElement.style.animation = 'slideOut 0.3s forwards'
    setTimeout(() => {
      event.target.parentElement.remove()
    }, 250)
  }
})
