        <p id="hora"></p>
      <p id="admin">BIENVENIDO AL PANEL DE ADMINISTRACIÓN</p> 
      <p id="informacion">SELECCIONA UNA CATEGORÍA PARA GESTIONARLA</p>
      <p data-shadow = 'CULTURAL CHAIN' id="nombreapp">CULTURAL CHAIN</p>
      <script>
  const mostrarHora = () => {
    const hora = document.getElementById('hora');
    const fecha = new Date();
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();

    // Asegúrate de que los números siempre tengan dos dígitos
    if (horas < 10) horas = '0' + horas;
    if (minutos < 10) minutos = '0' + minutos;

    const horaActual = horas + ':' + minutos;

    // Actualiza el contenido del elemento HTML con la hora actual
    hora.innerHTML = horaActual;
  };

  setInterval(mostrarHora, 1000);
  mostrarHora();
</script>

