<?php

global $wpdb;

$sql  = $wpdb->prepare( "SELECT * FROM " . TABLE_NAME . " WHERE id = %d", $id );
$item = $wpdb->get_row( $sql );

if ( $item ):
	ob_start();
?>
    <h5 style="text-align: center;
    background-color: #FF9800;
    color: white;
    padding: 10px;
    width: 600px;
    margin: 0 auto;">Editar datos del distribuidor</h5>
    <form method="post" action="<?= admin_url( 'admin-post.php' ) ?>" id="frmAddLocation" name="frmAddLocation">
        <div>
            <label for="nombre">Nombre: <span style="color: red;">*</span></label>
            <input type="text" name="nombre" id="nombre" required value="<?= $item->nombre ?>">
        </div>
        <div>
            <label for="calle_numero">Calle y Numero: <span style="color: red;">*</span></label>
            <input type="text" name="calle_numero" id="calle_numero" required value="<?= $item->calle_numero ?>">
        </div>
        
        <div>
            <label for="colonia">Colonia: <span style="color: red;">*</span></label>
            <input type="text" name="colonia" id="colonia" required value="<?= $item->colonia ?>">
        </div>
        <div>
            <label for="ciudad">Ciudad: <span style="color: red;">*</span></label>
            <input type="text" name="ciudad" id="ciudad" required value="<?= $item->ciudad ?>">
        </div>
        <div>
            <label for="entidad">Estado: <span style="color: red;">*</span></label>
            <select name="entidad" id="entidad" required>
                <option value="">-- Selecciona un estado --</option>
                <option value="1" <?php echo ( $item->entidad == "1" ? 'selected': ''); ?> >Aguascalientes</option>
                <option value="2" <?php echo ( $item->entidad == "2" ? 'selected': ''); ?> >Baja California</option>
                <option value="3" <?php echo ( $item->entidad == "3" ? 'selected': ''); ?> >Baja California Sur</option>
                <option value="4" <?php echo ( $item->entidad == "4" ? 'selected': ''); ?> >Campeche</option>
                <option value="5" <?php echo ( $item->entidad == "5" ? 'selected': ''); ?> >Coahuila</option>
                <option value="6" <?php echo ( $item->entidad == "6" ? 'selected': ''); ?> >Colima</option>
                <option value="7" <?php echo ( $item->entidad == "7" ? 'selected': ''); ?> >Chiapas</option>
                <option value="8" <?php echo ( $item->entidad == "8" ? 'selected': ''); ?> >Chihuahua</option>
                <option value="9" <?php echo ( $item->entidad == "9" ? 'selected': ''); ?> >Ciudad de México</option>
                <option value="10" <?php echo ( $item->entidad == "10" ? 'selected': ''); ?> >Durango</option>
                <option value="11" <?php echo ( $item->entidad == "11" ? 'selected': ''); ?> >Guanajuato</option>
                <option value="12" <?php echo ( $item->entidad == "12" ? 'selected': ''); ?> >Guerrero</option>
                <option value="13" <?php echo ( $item->entidad == "13" ? 'selected': ''); ?> >Hidalgo</option>
                <option value="14" <?php echo ( $item->entidad == "14" ? 'selected': ''); ?> >Jalisco</option>
                <option value="15" <?php echo ( $item->entidad == "15" ? 'selected': ''); ?> >México</option>
                <option value="16" <?php echo ( $item->entidad == "16" ? 'selected': ''); ?> >Michoacán</option>
                <option value="17" <?php echo ( $item->entidad == "17" ? 'selected': ''); ?> >Morelos</option>
                <option value="18" <?php echo ( $item->entidad == "18" ? 'selected': ''); ?> >Nayarit</option>
                <option value="19" <?php echo ( $item->entidad == "19" ? 'selected': ''); ?> >Nuevo León</option>
                <option value="20" <?php echo ( $item->entidad == "20" ? 'selected': ''); ?> >Oaxaca</option>
                <option value="21" <?php echo ( $item->entidad == "21" ? 'selected': ''); ?> >Puebla</option>
                <option value="22" <?php echo ( $item->entidad == "22" ? 'selected': ''); ?> >Querétaro</option>
                <option value="23" <?php echo ( $item->entidad == "23" ? 'selected': ''); ?> >Quintana Roo</option>
                <option value="24" <?php echo ( $item->entidad == "24" ? 'selected': ''); ?> >San Luis Potosí</option>
                <option value="25" <?php echo ( $item->entidad == "25" ? 'selected': ''); ?> >Sinaloa</option>
                <option value="26" <?php echo ( $item->entidad == "26" ? 'selected': ''); ?> >Sonora</option>
                <option value="27" <?php echo ( $item->entidad == "27" ? 'selected': ''); ?> >Tabasco</option>
                <option value="28" <?php echo ( $item->entidad == "28" ? 'selected': ''); ?> >Tamaulipas</option>
                <option value="29" <?php echo ( $item->entidad == "29" ? 'selected': ''); ?> >Tlaxcala</option>
                <option value="30" <?php echo ( $item->entidad == "30" ? 'selected': ''); ?> >Veracruz</option>
                <option value="31" <?php echo ( $item->entidad == "31" ? 'selected': ''); ?> >Yucatán</option>
                <option value="32" <?php echo ( $item->entidad == "32" ? 'selected': ''); ?> >Zacatecas</option>
            </select>
        </div>
        <div>
            <label for="cp">CP: <span style="color: red;">*</span></label>
            <input
                type="number"
                name="cp"
                id="cp"
                title="Ingrese un código postal valido"
                value="<?= $item->cp; ?>"
                pattern="[0-9]{5}"
                style="text-align: left; padding-left: 20px;"
                required
            >
        </div>
        <div>
            <label for="telefono"> Teléfono: <span style="color: red;">*</span></label>
            <input
                type="number"
                name="telefono"
                id="telefono"
                title="Ingrese a 10 digitos."
                value="<?= $item->telefono; ?>"
                pattern="[0-9]{10}"
                style="text-align: left; padding-left: 20px;"
                required
            >
        </div>
        <div>
            <label for="website"> Website: <span style="color: red;">*</span></label>
            <input
                type="text"
                name="website"
                id="website"
                title="Ingrese el sitio web"
                value="<?= $item->sitio; ?>"
                style="text-align: left; padding-left: 20px;"
            >
        </div>
        <div>
            <label for="email"> Email" <span style="color: red;">*</span></label>
            <input
                type="email"
                name="email"
                id="email"
                title="Ingrese email correcto"
                value="<?= $item->email; ?>"
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
            <input type="hidden" id="id" name="id" value="<?= $item->id ?>">
            <?php wp_nonce_field( 'wplocations-nonce', 'nonce' ); ?>
            <input type="hidden" name="action" value="save_wp_location">
            <input type="submit" name="submit" value="Guardar" style="background-color: #509147; color: white; width: 100%; margin: 30px 0px; border-radius: 20px;">
        </div>
    </form>

	<?php
	$str_form = ob_get_contents();
            ob_end_clean();
            else:
	$str_form = "No existe ese elemento";
            endif;

            return $str_form;
            
