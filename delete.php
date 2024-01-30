<?php

global $wpdb;

$sql  = $wpdb->prepare( "SELECT nombre FROM " . TABLE_NAME . " WHERE id = %d", $id );
$nombre = $wpdb->get_var( $sql );

ob_start();
?>

<div style="text-align: center; width: 800px; margin: 0px auto;">
    <h3 style="background-color: #FFC107;
        padding: 20px;
        color: #FF5722;
        text-shadow: -3px 3px 6px white;">
               ¿Estas seguro de eliminar la sucursal: <span style="color: black; "><?= $nombre ?></span>?
    </h3>
    <form method="post" action="<?= admin_url( 'admin-post.php' ) ?>" class="frm-detail-locations">
        <input type="hidden" name="id" value="<?= $id ?>">
    	<?php wp_nonce_field( 'wplocations-nonce', 'nonce' ); ?>
        <input type="hidden" name="action" value="delete_wp_location">
        <input type="submit" name="submit" value="🗑️ Eliminar" style="background-color: green; color: white;">
        <a
            style="background-color: red; padding: 10px 30px 14px; color: white"
            href="<?= home_url( SLUG_PAGE ) ?>"
        >
            Cancelar
        </a>
    </form>
</div>

<?php
$str_form = ob_get_contents();
    ob_end_clean();

    return $str_form;