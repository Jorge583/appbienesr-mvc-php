document.addEventListener('DOMContentLoaded', function() {
    EventListener();

    darkMode();
});
function darkMode() {
    const prefriereDarkMode = window.matchMedia('(prefers-color-sheme:dark)');
     //    console.log(prefriereDarkMode.matches); para leer las preferencia del usuario en el sistema cuando tiene configura modo oscurso
   
     if(prefriereDarkMode.matches) {
        document.body.classList.add('dark-mode');       
    } else {
        document.body.classList.remove('dark-mode');  
    }
    
    prefriereDarkMode.addEventListener('change', function() {
        if (prefriereDarkMode.matches) {
            document.body.classList.add('dark-mode');       
        } else {
            document.body.classList.remove('dark-mode');  
        }
    });

    const botonDarkMode = document.querySelector(".dark-mode-boton");

    botonDarkMode.addEventListener('click', function() {
      document.body.classList.toggle('dark-mode');

    });

}
function EventListener() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContactos))
    
}
function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
        navegacion.classList.toggle('mostrar');
          
}

function mostrarMetodosContactos(e) {
    const contactoDiv = document.querySelector('#contacto');  
    
    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
        <label for="telefono">usted eligio Telefono</label>
        <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">   
        <p>Si Eligio Telefono , elija la fecha y la hora</p>
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]">
        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
        } else {
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu email" id="email" name="contacto[email]">    
        ` ;
        }
}

