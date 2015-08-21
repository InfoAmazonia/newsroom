<?php

/*
 * Plugin dependencies
*/

require_once(STYLESHEETPATH . '/inc/class-tgm-plugin-activation.php');

function newsroom_register_required_plugins() {
	$plugins = array(
		array(
			'name' => 'Page Builder by SiteOrigin',
			'slug' => 'siteorigin-panels',
			'required' => true,
			'force_activation' => true
		)
	);
	$options = array(
		'default_path' => '',
		'menu' => 'newsroom-install-plugins',
		'has_notices' => true,
		'dismissable' => true,
		'dismiss_msg' => '',
		'is_automatic' => false,
		'message' => ''
	);
	tgmpa($plugins, $options);
}
add_action('tgmpa_register', 'newsroom_register_required_plugins');

/*
 * Clears JEO default front-end styles and scripts
 */
function newsroom_scripts() {

	// deregister jeo styles
	wp_deregister_style('jeo-main');

  // deregister jeo site frontend scripts
  wp_deregister_script('jeo-site');

}
add_action('wp_enqueue_scripts', 'newsroom_scripts', 10);

/*
 * JEO Hooks examples
 * Most common hooks
 */

// Action right after JEO functionality inits
function newsroom_init() {
  // Action goes here
}
add_action('jeo_init', 'newsroom_init');

// Hook scripts after JEO scripts has been initialized
function newsroom_jeo_scripts() {

  // Register and enqueue scripts here

  // Enqueue child theme JEO related scripts
  wp_enqueue_script('newsroom-jeo-scripts', get_stylesheet_directory_uri() . '/js/jeo-scripts.js', array('jquery') , '0.0.1');

  // Enqueue child theme main CSS
	wp_register_style('newsroom-normalize', get_stylesheet_directory_uri() . '/css/normalize.css');
  wp_enqueue_style('newsroom-styles', get_stylesheet_directory_uri() . '/css/main.css', array('newsroom-normalize'));

}
add_action('jeo_enqueue_scripts', 'newsroom_jeo_scripts', 20);

// Hook scripts after JEO Marker scripts has been initialized
function newsroom_markers_scripts() {

  // Register and enqueue scripts here
  wp_enqueue_script('newsroom-jeo-markers-scripts', get_stylesheet_directory_uri() . '/js/jeo-markers-scripts.js', array('jquery') , '0.0.1');

}
add_action('jeo_markers_enqueue_scripts', 'newsroom_markers_scripts', 20);

// Filter to change posts GeoJSON data (also changes the GeoJSON API output)
function newsroom_marker_data($data, $post) {

  // Change $data here

  return $data;
}
add_filter('jeo_marker_data', 'newsroom_marker_data', 10, 2);

// Filter to change GeoJSON response
function newsroom_markers_data($data, $query) {

  // Change $data here

  return $data;
}
add_filter('jeo_markers_data', 'newsroom_markers_data', 10, 2);

// Filter to programatically change map data
function newsroom_map_data($data, $map) {

  // Change $data here

  return $data;
}
add_filter('jeo_map_data', 'newsroom_map_data', 10, 2);
