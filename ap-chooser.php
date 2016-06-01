<?php

  /**
  * Plugin Name: Apartment Chooser
  * Plugin URI: http://hydrogene.hu/
  * Description: Apartment administration tool with visual chooser for DelataLiget .
  * Version: 1.0
  * Author: Gabor Szabo
  * Author URI: http://hydrogene.hu/
  **/

  define( 'APC_PATH', plugin_dir_path( __FILE__ ) );

  // 1. customize ACF path
  add_filter('acf/settings/path', 'delta_acf_settings_path');
   function delta_acf_settings_path( $path ) {
      $path = APC_PATH  . '/includes/acf/';
      return $path;
  }
  // 2. customize ACF dir
  add_filter('acf/settings/dir', 'delta_acf_settings_dir');
  function delta_acf_settings_dir( $dir ) {
    $dir = APC_PATH  . '/includes/acf/';
    return $dir;
  }
  // 3. Hide ACF field group menu item
  //add_filter('acf/settings/show_admin', '__return_false');

  // 4. Include ACF
  include_once( APC_PATH  . '/includes/acf/acf.php' );

  //Custom Post Types an Taxonomies
  include_once( APC_PATH . '/includes/object-defs.php');

  //ACF Metaboxes
  //include_once( APC_PATH  . '/includes/acf-fields.php' );



// # Template for displaying a single lakas
add_filter( 'single_template', 'lakas_single_template');
function lakas_single_template($single_template) {
    global $post;
    if ($post->post_type == 'lakas') {
      $single_template = APC_PATH . '/templates/single-lakas.php';
    }
    return $single_template;
}

# Template for displaying the lakas archive
// add_filter( 'archive_template', 'lakas_archive_template') ) ;
// function lakas_archive_template($archive_template) {
//     if ( is_post_type_archive('lakas') )
//         $archive_template = APC_PATH . '/templates/archive-lakas.php';
//     return $archive_template;
// }



// Register styles & scripts sheet.
function delta_register_apc_stuff() {
  wp_enqueue_style( 'apc-styles', plugins_url('ap-chooser/dist/styles/ap-chooser.css') );
  // wp_enqueue_script( 'raphaeljs', plugins_url('ap-chooser/dist/scripts/vendor/raphael.min.js'), array() );
  wp_enqueue_script( 'apc-scripts', plugins_url('ap-chooser/dist/scripts/ap-chooser.js'), array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'delta_register_apc_stuff' );


