<?php

global $wpdb;
global $wp_roles;

$role_names = $wp_roles->get_names();

$actual_user = wp_get_current_user();
$allowed_roles = array('administrator');

$btn_nuevo_distribuidor = $btn_lista_distribuidor = $template = '';

if ( count(array_intersect( $allowed_roles, $actual_user->roles )) >= 1 ) {
    $btn_nuevo_distribuidor = '<div class="btn btn-success"
    style="border: 1px solid #ffc107; background-color: darkgoldenrod;"
    onmouseover="this.style.backgroundColor=\'#794500\'"
    onmouseover="this.style.border=\'1px solid #ffa800\'"
    onmouseout="this.style.backgroundColor=\'darkgoldenrod\'"
    onmouseout="this.style.border=\'1px solid #ffc107\'"
    >
    <a href="?action=new" style="color: #ffffff; text-shadow: -2px 1px 5px #ffca00;">💰 Agregar distribuidor</a>
    </div>';
    
    $btn_lista_distribuidor = '<a href="?action=list&search_data=listAll"
    class="btn"
    style="color: rgb(255, 255, 255);
    text-shadow: #673AB7 -2px 1px 5px;
    border: 1px solid #9C27B0;
    background-color: #673AB7;
    margin-left: 10px;"
    onmouseover="this.style.backgroundColor=\'#2d086f\'"
    onmouseover="this.style.border=\'1px solid #bd0fdb\'"
    onmouseout="this.style.backgroundColor=\'#673AB7\'"
    onmouseout="this.style.border=\'1px solid #9C27B0\'"
    onmouseout="this.style.marginLeft=\'10px\'"
    >
        📝 Lista distribuidores
    </a>';
}

$template = $btn_nuevo_distribuidor . $btn_lista_distribuidor . '<div>
<h5 style="text-align: center;">Ingresa el Estado de la República de donde nos escribes o el código postal<br/> para encontrar un
distribuidor en el área</h5>
<div style="
    width: 600px;
    margin: 0px auto 50px;">
    <form type="POST" action="?adsfa23ddafasdfasdf988" name="form_search" style="display: flex;">
	   <input
            type="search"
            id="search_data"
            name="search_data"
            placeholder="Estado de la República o Codigo Postal"
            required="required"
            style="border: 2px solid #509147; border-right: 0px; color: #509147;" />
<input type="hidden" name="action" value="list" />
  	   <button
            type="submit"
            class="btn btn-primary"
            style="color: white; background-color: #509147;"
        >
            Buscar
  	   </button>
    </form>
    
    <div style="display: flex; padding: 0px 7px; max-width: 500px;">
        <h6 style="font-weight: 100; font-size: 12px; line-height: 20px; padding-bottom: 0px; margin-bottom: 0px; display:none;">
            Las ciudades más comunes son:
        </h6>
';
$items_city = $wpdb->get_results("SELECT COUNT(*) AS total, `entidad` FROM `" . TABLE_NAME . "` GROUP BY `entidad` ORDER BY total DESC LIMIT 7;");

$entidades_federativas = array(
    1 => 'Aguascalientes',
    2 => 'Baja California',
    3 => 'Baja California Sur',
    4 => 'Campeche',
    5 => 'Coahuila',
    6 => 'Colima',
    7 => 'Chiapas',
    8 => 'Chihuahua',
    9 => 'CDMX',
    10 => 'Durango',
    11 => 'Guanajuato',
    12 => 'Guerrero',
    13 => 'Hidalgo',
    14 => 'Jalisco',
    15 => 'Edo. México',
    16 => 'Michoacán',
    17 => 'Morelos',
    18 => 'Nayarit',
    19 => 'Nuevo León',
    20 => 'Oaxaca',
    21 => 'Puebla',
    22 => 'Querétaro',
    23 => 'Quintana Roo',
    24 => 'San Luis Potosí',
    25 => 'Sinaloa',
    26 => 'Sonora',
    27 => 'Tabasco',
    28 => 'Tamaulipas',
    29 => 'Tlaxcala',
    30 => 'Veracruz',
    31 => 'Yucatán',
    32 => 'Zacatecas'
);

/*foreach ($items_city as $item) {
    $template .= '<a
    style="
        color: #ffffff;
        font-size: 10px;
        text-transform: uppercase;
        line-height: normal;
        letter-spacing: 0px;
        background-color: #386931;
        padding: 1px 4px;
        margin: 5px 0px 0px 5px;
    "
    onmouseover="this.style.backgroundColor=\'#153d10\'"
    onmouseout="this.style.backgroundColor=\'#386931\'"
    href="?search_direct='. $item->entidad .'">' . substr($entidades_federativas[$item->entidad], 0,10) . "..." . '</a>';
}*/
$template .='
    </div>
	</div>
</div>';

return str_replace( '{data}', $html, $template );