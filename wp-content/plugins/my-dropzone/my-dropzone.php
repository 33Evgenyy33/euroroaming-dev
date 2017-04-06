<?php
/*
Plugin Name: DropzoneJS & WordPress
Version: 0.0.1
Description: Demos DropzoneJS in WordPress
Author: Per Soderlind
Author URI: https://soderlind.no
Plugin URI: https://gist.github.com/soderlind/f9e8b06cc205fb8c493d
License: GPL
*/

define( 'DROPZONEJS_PLUGIN_URL',   plugin_dir_url( __FILE__ ) );
define( 'DROPZONEJS_PLUGIN_VERSION', '0.0.1' );

add_action( 'plugins_loaded', 'dropzonejs_init' );

function dropzonejs_init() {
    add_action( 'wp_enqueue_scripts', 'dropzonejs_enqueue_scripts' );
    add_shortcode( 'dropzonejs', 'dropzonejs_shortcode' );
}

function dropzonejs_enqueue_scripts() {

    wp_enqueue_script(
        'dropzonejs',
        'https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js',
        array(),
        DROPZONEJS_PLUGIN_VERSION
    );

    // Load custom dropzone javascript
    wp_enqueue_script(
        'customdropzonejs',
        DROPZONEJS_PLUGIN_URL. '/js/customize_dropzonejs.js',
        array( 'dropzonejs' ),
        DROPZONEJS_PLUGIN_VERSION
    );

    wp_enqueue_style(
        'dropzonecss',
        'https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css',
        array(),
        DROPZONEJS_PLUGIN_VERSION
    );
}


// Add Shortcode
function dropzonejs_shortcode( $atts ) {

    $url         = admin_url( 'admin-ajax.php' );
    $nonce_files = wp_nonce_field( 'protect_content', 'my_nonce_field' );

    return <<<ENDFORM
<div id="dropzone-wordpress"><form action="$url" class="dropzone needsclick dz-clickable" id="dropzone-wordpress-form">
	$nonce_files
	<div class="dz-message needsclick">
		Drop files here or click to upload.<br>
		<span class="note needsclick">(Files are uploaded to uploads/yyyy/mm)</span>
  	</div>
	<input type='hidden' name='action' value='submit_dropzonejs'>
</form></div>
ENDFORM;
}


add_action( 'wp_ajax_nopriv_submit_dropzonejs', 'dropzonejs_upload' ); //allow on front-end
add_action( 'wp_ajax_submit_dropzonejs', 'dropzonejs_upload' );

/**
 * dropzonejs_upload() handles the AJAX request, learn more about AJAX in Plugins at https://codex.wordpress.org/AJAX_in_Plugins
 * @return [type] [description]
 */
function dropzonejs_upload() {

    if ( !empty( $_FILES ) && wp_verify_nonce( $_REQUEST['my_nonce_field'], 'protect_content' ) ) {

        $uploaded_bits = wp_upload_bits(
            $_FILES['file']['name'],
            null, //deprecated
            file_get_contents( $_FILES['file']['tmp_name'] )
        );

        if ( false !== $uploaded_bits['error'] ) {
            $error = $uploaded_bits['error'];
            return add_action( 'admin_notices', function() use ( $error ) {
                $msg[] = '<div class="error"><p>';
                $msg[] = '<strong>DropzoneJS & WordPress</strong>: ';
                $msg[] = sprintf( __( 'wp_upload_bits failed,  error: "<strong>%s</strong>' ), $error );
                $msg[] = '</p></div>';
                echo implode( PHP_EOL, $msg );
            } );
        }
        $uploaded_file     = $uploaded_bits['file'];
        $uploaded_url      = $uploaded_bits['url'];
        $uploaded_filetype = wp_check_filetype( basename( $uploaded_bits['file'] ), null );

        /*
        etc ...
        */
    }
    die();
}