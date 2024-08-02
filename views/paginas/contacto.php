<main class="contenedor seccion contenido-centrado">
        <h1>contacto</h1>
        <?php if ($mensaje) { ?>
            <p class="alerta exito"><?php echo $mensaje; ?></p>;
        <?php } ?>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
           <source srcset="build/img/destacada3.jpg" type="image/jpeg">
           <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen contacto">
         </picture>
         <h2>Llene el siguiente formulario de contacto</h2>
         <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>
            <fieldset>
                <legend>Informacion Sobre La Propiedad</legend>
                <label for="opciones">vende o compra</label>
                <select id="opciones" name="contacto[tipo]" required>
                    <option value= "" disabled selected>-- selecione --</option>
                    <option value="compra">Compra</option>
                    <option value="Venta">Venta</option>
                </select>
                <label for="presupuesto">Precio o presupuesto</label>
                <input type="number" placeholder="Tu Precio o Precupuesto" id="presupuesto" name="contacto[precio]">
            </fieldset>
            <fieldset>
                <legend>Informacion sobre la propiedad</legend>
                <p>Como Desea Ser contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]">

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]">

                </div>
                <div id="contacto"></div>
               
            </fieldset>
            <input type="submit" value="enviar" class="boton-verde">
         </form>
    </main>