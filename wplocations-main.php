<?php
const SLUG_PAGE  = 'distribuidores'; //slug de la página en donde se mostrará la tabla
const TABLE_NAME = 'wp_custom_locations'; // nombre de la tabla

// Show list or forms
add_filter( 'the_content', 'wplocations_data' );

function wplocations_data( $content ) {
    $custom = '';

    if ( is_page( SLUG_PAGE ) ) {
        $id     = $_GET['id'] ?? 0;
        $action = $_GET['action'] ?? '';
        $search_direct = $_GET['search_direct'] ?? null;

        if ($search_direct !== null) {
            $result = $_GET['result'] ?? false;
            $custom = require('list.php');
        }
        elseif ( $action == 'new' ) {
            $custom = require( 'new.php' );
        } elseif ( $id && $action == 'edit' ) {
            $custom = require( 'edit.php' );
        } elseif ( $id && $action == 'delete' ) {
            $custom = require( 'delete.php' );
        } elseif( $action == 'list') {
            $result = $_GET['result'] ?? false;
            $custom = require('list.php');
        } else {
            $custom = require( 'search.php' );
        }
    }

	return $content . $custom;
}

// Process Save
add_action( 'admin_post_nopriv_save_wp_location', 'process_save_wp_location' );
add_action( 'admin_post_save_wp_location', 'process_save_wp_location' );

function process_save_wp_location() {
    global $wpdb;

    verify_nonce();
    verify_user();

    $id              = intval( $_POST['id'] );
    $data            = [];
    $data['nombre']    = sanitize_text_field( $_POST['nombre'] );
    $data['calle_numero'] = sanitize_text_field( $_POST['calle_numero'] );
    $data['colonia']    = sanitize_text_field( $_POST['colonia'] );
    $data['ciudad']    = sanitize_text_field( $_POST['ciudad'] );
    $data['entidad'] = intval( $_POST['entidad'] );
    $data['cp']    = intval( $_POST['cp'] );
    $data['telefono']    = intval( $_POST['telefono'] );
    $data['email']    = sanitize_text_field( $_POST['email'] );
    $data['sitio']    = sanitize_text_field( $_POST['sitio'] );

    $result = false;
    
    if ( $id > 0 ) {
        $result = $wpdb->update( TABLE_NAME, $data, [ 'id' => $id ] );
    } elseif ( $id === 0 ) {
        $result = $wpdb->insert( TABLE_NAME, $data );
    }

	wp_redirect( home_url( SLUG_PAGE ) . '?action=list&search_data=listAll' );
    exit;
}


// Process Save
add_action( 'admin_post_nopriv_delete_wp_location', 'process_delete_wp_location' );
add_action( 'admin_post_delete_wp_location', 'process_delete_wp_location' );

function process_delete_wp_location() {
    global $wpdb;

    verify_nonce();
    verify_user();

    $id = intval( $_POST['id'] );

    $result = false;
    if ( $id > 0 ) {
        $wpdb->delete( TABLE_NAME, [ 'id' => $id ] );
    }

	wp_redirect( home_url( SLUG_PAGE ) . '?action=list' );
    exit;
}


function verify_nonce() {
    if ( ! wp_verify_nonce( $_POST['nonce'] ?? '', 'wplocations-nonce' ) ) {
        wp_redirect( home_url( SLUG_PAGE ) . '?result=-1' );
        exit;
    }
}

function verify_user(){
    $user = wp_get_current_user();
    $allowed_roles = array('administrator');
    if ( count(array_intersect( $allowed_roles, $user->roles )) === 0  ) {
        wp_redirect( home_url( SLUG_PAGE ) . '?result=-1' );
        exit;
    }
}
