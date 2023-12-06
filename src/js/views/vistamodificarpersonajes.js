const fileInputs = document.querySelectorAll('.file-input')
const imageContainers = document.querySelectorAll('.figure-container')

fileInputs.forEach((input, index) => {
  input.addEventListener('change', function (e) {
    const file = e.target.files[0]
    const imageContainer = imageContainers[index]
    const img = imageContainer.querySelector('.personaje')

    if (file) {
      const reader = new FileReader()

      reader.onload = function (event) {
        const imageURL = event.target.result

        // Verificar si el archivo no es una imagen
        if (!file.type.startsWith('image/')) {
          // Ruta de la imagen por defecto
          const defaultImageURL = '../img/iconos/doc.png'
          img.style.objectFit = 'contain'
          img.src = defaultImageURL
          imageContainer.setAttribute('data-image', defaultImageURL)
        } else {
          img.src = imageURL
          imageContainer.setAttribute('data-image', imageURL)
        }
      }

      reader.readAsDataURL(file)
    }
  })
})
