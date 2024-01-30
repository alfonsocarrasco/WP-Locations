<?php
	ob_start();
?>
    <h3 style="text-align: center">Complete el formulario para registrar un distribuidor</h3>
    <form method="post"
    action="<?= admin_url( 'admin-post.php' ) ?>"
    class="frm-detail-locations"
    style="padding: 20px 50px; background-color: #fbfbfb;"
    name="frmAddLocation"
    id="frmAddLocation"
    >
        <div>
            <label for="name">Nombre: <span style="color: red;">*</span></label>
            <input type="text" name="nombre" id="nombre" required value="">
        </div>
        <div>
            <label for="calle_numero">Calle y numero: <span style="color: red;">*</span></label>
            <input type="text" name="calle_numero" id="calle_numero" required value="">
        </div>
        <div>
            <label for="colonia">Colonia <span style="color: red;">*</span></label>
            <input type="text" name="colonia" id="colonia" required value="">
        </div>
        <div>
            <label for="ciudad">Ciudad <span style="color: red;">*</span></label>
            <input type="text" name="ciudad" id="ciudad" required value="">
        </div>
        <div>
            <label for="entidad">Estado<span style="color: red;">*</span></label>
            <select name="entidad" id="entidad" required>
                <option value="">-- Selecciona un estado --</option>
                <option value="1">Aguascalientes</option>
                <option value="2">Baja California</option>
                <option value="3">Baja California Sur</option>
                <option value="4">Campeche</option>
                <option value="5">Coahuila</option>
                <option value="6">Colima</option>
                <option value="7">Chiapas</option>
                <option value="8">Chihuahua</option>
                <option value="9">Ciudad de México</option>
                <option value="10">Durango</option>
                <option value="11">Guanajuato</option>
                <option value="12">Guerrero</option>
                <option value="13">Hidalgo</option>
                <option value="14">Jalisco</option>
                <option value="15">México</option>
                <option value="16">Michoacán</option>
                <option value="17">Morelos</option>
                <option value="18">Nayarit</option>
                <option value="19">Nuevo León</option>
                <option value="20">Oaxaca</option>
                <option value="21">Puebla</option>
                <option value="22">Querétaro</option>
                <option value="23">Quintana Roo</option>
                <option value="24">San Luis Potosí</option>
                <option value="25">Sinaloa</option>
                <option value="26">Sonora</option>
                <option value="27">Tabasco</option>
                <option value="28">Tamaulipas</option>
                <option value="29">Tlaxcala</option>
                <option value="30">Veracruz</option>
                <option value="31">Yucatán</option>
                <option value="32">Zacatecas</option>
            </select>
        </div>
        <div>
            <label for="cp">Código postal <span style="color: red;">*</span></label>
            <input
                type="number"
                name="cp"
                id="cp"
                title="Ingrese un código postal valido"
                value=""
                pattern="[0-9]{5}"
                style="text-align: left; padding-left: 20px;"
                required
            >
        </div>
        <div id="notificacionAddLocation" style="
        color: #7d0000;
        text-align: right;
        font-size: 10px;
        text-transform: uppercase;
    ">* Todos los campos son requeridos.</div>
        <div>
            
	        <?php wp_nonce_field( 'wplocations-nonce', 'nonce' ); ?>
            <input type="hidden" name="action" value="save_wp_location">
            <input type="submit" name="submit" value="📢 Guardar" class="btn" style="background-color: #509147; color: white; width: 100%; margin: 30px 0px; border-radius: 20px;">
        </div>
    </form>

	<?php
	$str_form = ob_get_contents();
            ob_end_clean();

            return $str_form;