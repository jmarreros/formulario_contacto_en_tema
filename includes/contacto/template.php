<form action="" method="post" id="we-contacto">

    <input type="text" name="name" id="name" placeholder="Persona de contacto" required>
    <input type="email" name="email" id="email" placeholder="Email" required>
    <input type="tel" name="tel" id="tel" placeholder="Teléfono de contacto">

    <section class="relacionada-group">
        <label>
            <input type="radio" name="relacionada" value="Diseño Web" checked="checked">
            <span>Diseño Web</span>
        </label>

        <label>
            <input type="radio" name="relacionada" value="Tienda Online">
            <span>Tienda Online</span>
        </label>

        <label>
            <input type="radio" name="relacionada" value="SEO   ">
            <span>SEO</span>
        </label>

        <label>
            <input type="radio" name="relacionada" value="Alojamiento Web">
            <span>Alojamiento Web</span>
        </label>

        <label>
            <input type="radio" name="relacionada" value="APP">
            <span>APP</span>
        </label>
    </section>

    <input type="url" name="url" id="url" placeholder="¿Tienes página web?, ¿Nos indicas la URL?">

    <textarea name="msg" id="msg" cols="30" rows="10" placeholder="Escribe aquí tu mensaje" required></textarea>

    <section class="terms-conditions">
        <label>
            <input type="checkbox" name="conditions" id="conditions" required>
            He leido y acepto la <a href="/politica-de-privacidad/" target="_blank" rel="follow">política de privacidad</a>
        </label>
    </section>

    <section class="msg"></section>

    <input type="submit" value="Enviar Formulario">


</form>
