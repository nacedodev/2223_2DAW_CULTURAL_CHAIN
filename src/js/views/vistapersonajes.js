const fileInputs = document.querySelectorAll('.file-input')
const imageContainers = document.querySelectorAll('.figure-container')
const sendBtn = document.getElementById('sendButton')
const addBtn = document.getElementById('addButton')
const deleteBtn = document.getElementById('deleteFigures')
const revertBtn = document.getElementById('revertFigures')

document.getElementById('figures-container').addEventListener('click', function (event) {
  if (event.target.classList.contains('delete-button')) {
    const figureContainer = event.target.closest('figure')
    figureContainer.classList.add('marked-for-deletion') // Marcar para borrar
    figureContainer.style.animation = 'deleteIndicator 0.8s forwards'
    sendBtn.style.display = 'none'
    addBtn.style.display = 'none'
    deleteBtn.style.display = 'block'
    revertBtn.style.display = 'flex'
  }
})

document.getElementById('deleteFigures').addEventListener('click', function () {
  const figuresToDelete = document.querySelectorAll('.marked-for-deletion')

  const idsParaBorrar = []

  figuresToDelete.forEach(figure => {
    const id = figure.querySelector('input[type="hidden"]').value
    idsParaBorrar.push(id)
  })

  // Construir la URL con los IDs como parámetros
  const url = `index.php?controller=personajes&action=borrarPersonajes&ids=${idsParaBorrar}`

  // Redirigir a la página de borrado con los IDs en la URL
  window.location.href = url
})

fileInputs.forEach((input, index) => {
  input.addEventListener('change', function (e) {
    const file = e.target.files[0]
    const imageContainer = imageContainers[index]

    if (file) {
      const reader = new FileReader()

      reader.onload = function (event) {
        const imageURL = event.target.result
        const img = imageContainer.querySelector('.personaje')

        img.src = imageURL
        imageContainer.setAttribute('data-image', imageURL)
      }

      reader.readAsDataURL(file)
    }
  })
})

document.getElementById('addButton').addEventListener('click', function (event) {
  event.preventDefault() // Evita que el formulario se envíe

  const figuresContainer = document.getElementById('figures-container')
  const lastFigure = figuresContainer.lastElementChild // Obtener el último figure
  const previousFigure = lastFigure.previousElementSibling // Obtener el anterior al último figure

  const imageInput = previousFigure.querySelector('.file-input')
  const nameInput = previousFigure.querySelector('.personaje-input')

  if (imageInput != null) {
    const imageValue = imageInput.value
    const nameValue = nameInput.value

    // Verificar si el último figure no está vacío (tanto la imagen como el nombre)
    if ((!imageValue || imageValue === '') && (!nameValue || nameValue === '')) {
      const addImg = document.querySelector('#addButton > img')
      addImg.style.animation = 'shakeAnimation 0.3s ease-in-out'
      setTimeout(() => {
        addImg.style.animation = 'none'
      }, 300)
      previousFigure.style.animation = 'warningAnimation 0.8s linear'
      setTimeout(() => {
        previousFigure.style.animation = 'none'
      }, 800)
      return
    }
  }

  const figureTemplate = document.createElement('figure')
  figureTemplate.classList.add('figure-container')

  figureTemplate.innerHTML = `
    <div id="dropzone">
      <p>Arrastra o haz click</p>
    </div>
        <img  class="personaje" src="" class="personaje" style="display: none;">
    <input type="file" class="file-input" name="imagenPersonajes[]">
    <input id='newname' type="text" value="" class="personaje-input" name="nombres[]" style="border: 1px dashed var(--terciary); filter: drop-shadow(0 0 5px var(--terciary))">
    <button class="remove-button" type="button">-</button>
  `

  // Encuentra el botón '+' en el contenedor y añade el nuevo figure justo antes de él
  const addButton = figuresContainer.querySelector('#add-btn')
  figuresContainer.insertBefore(figureTemplate, addButton)

  const newNameInputs = document.querySelectorAll('.personaje-input')

  newNameInputs.forEach(newName => {
    newName.addEventListener('blur', function () {
      newName.style.border = '1px dashed #2e2e4b9c'
      newName.style.filter = 'none'
    })
  })

  figureTemplate.scrollIntoView({ behavior: 'smooth' })

  const newFileInput = figureTemplate.querySelector('.file-input')
  const newImageContainer = figureTemplate

  newFileInput.addEventListener('change', function (e) {
    const file = e.target.files[0]
    const dropdivs = document.querySelectorAll('#dropzone') // Selecciona todos los dropzone

    if (file) {
      const reader = new FileReader()

      reader.onload = function (event) {
        const imageURL = event.target.result
        const img = newImageContainer.querySelector('.personaje')

        if (!file.type.startsWith('image/')) {
        // Ruta de la imagen por defecto
          const defaultImageURL = '../img/iconos/doc.png'
          img.style.objectFit = 'contain'
          img.src = defaultImageURL
          newImageContainer.setAttribute('data-image', defaultImageURL)
        } else {
          img.src = imageURL
          newImageContainer.setAttribute('data-image', imageURL)
        }

        // Oculta todos los dropzone encontrados
        dropdivs.forEach(dropdiv => {
          dropdiv.style.display = 'none'
        })

        img.style.display = 'block'
        img.style.pointerEvents = 'none'
      }

      reader.readAsDataURL(file)
    }
  })
})

document.getElementById('figures-container').addEventListener('click', function (event) {
  if (event.target.classList.contains('remove-button')) {
    const figureContainer = event.target.closest('figure')
    figureContainer.style.animation = 'slideOutAndRotate 0.3s forwards'
    setTimeout(() => {
      figureContainer.remove()
    }, 300)
  }
})

document.getElementById('figures-container').addEventListener('click', function (event) {
  if (event.target.classList.contains('edit-button')) {
    const figureContainer = event.target.closest('figure')
    figureContainer.style.animation = 'editAnimation 0.3s forwards'
  }
})
