<?php

/*
 * Clears JEO default front-end styles and scripts
 */
function jeo_blank_scripts() {

	// deregister jeo styles
	wp_deregister_style('jeo-main');

  // deregister jeo site frontend scripts
  wp_deregister_script('jeo-site');

}
add_action('wp_enqueue_scripts', 'jeo_blank_scripts', 10);

/*
 * JEO Hooks examples
 * Most common hooks
 */

// Action right after JEO functionality inits
function jeo_blank_init() {
  // Action goes here
}
add_action('jeo_init', 'jeo_blank_init');

// Hook scripts after JEO scripts has been initialized
function jeo_blank_jeo_scripts() {

  // Register and enqueue scripts here

  // Enqueue child theme JEO related scripts
  wp_enqueue_script('jeo-blank-jeo-scripts', get_stylesheet_directory_uri() . '/js/jeo-scripts.js', array('jquery') , '0.0.1');

  // Enqueue child theme main CSS
  wp_enqueue_style('jeo-blank-styles', get_stylesheet_directory_uri() . '/css/main.css');

}
add_action('jeo_enqueue_scripts', 'jeo_blank_jeo_scripts', 20);

// Hook scripts after JEO Marker scripts has been initialized
function jeo_blank_markers_scripts() {

  // Register and enqueue scripts here
  wp_enqueue_script('jeo-blank-jeo-markers-scripts', get_stylesheet_directory_uri() . '/js/jeo-markers-scripts.js', array('jquery') , '0.0.1');

}
add_action('jeo_markers_enqueue_scripts', 'jeo_blank_markers_scripts', 20);

// Filter to change posts GeoJSON data (also changes the GeoJSON API output)
function jeo_blank_marker_data($data, $post) {

  // Change $data here

  return $data;
}
add_filter('jeo_marker_data', 'jeo_blank_marker_data', 10, 2);

// Filter to change GeoJSON response
function jeo_blank_markers_data($data, $query) {

  // Change $data here

  return $data;
}
add_filter('jeo_markers_data', 'jeo_blank_markers_data', 10, 2);

// Filter to programatically change map data
function jeo_blank_map_data($data, $map) {

  // Change $data here

  return $data;
}
add_filter('jeo_map_data', 'jeo_blank_map_data', 10, 2);
