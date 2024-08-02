<form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu email" id="email" name="contacto[email]" required>

                <label for="telefono">Telefono</label>
                <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="contactp[mensaje]" required></textarea>
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
                    <input name="contacto"type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto"type="radio" value="email" id="contactar-email" name="contacto[contacto]">

                </div>
                <p>Si Eligio Telefono , elija la fecha y la hora</p>

                <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="contacto[fecha]">

                    <label for="hora">Hora</label>
                    <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
            </fieldset>
            <input type="submit" value="enviar" class="boton-verde">
         </form>