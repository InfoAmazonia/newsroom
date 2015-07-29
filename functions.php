<?php

function blank_jeo_scripts() {

	// deregister jeo styles
	wp_deregister_style('jeo-main');

  // deregister jeo site frontend scripts
  wp_deregister_script('jeo-site');

}
add_action('wp_enqueue_scripts', 'blank_jeo_scripts', 10);
