<?php

/*
 * Newsroom Highliht Carousel Widget
 */

class Newsroom_Highlight_Carousel_Widget extends SiteOrigin_Widget {
  function __construct() {
    parent::__construct(
      'newsroom-highlight-carousel-widget',
      __('Newsroom Highlight Carousel', 'newsroom'),
      array(
        'description' => __('Display featured posts with featured image as a interactive carousel', 'newsroom')
      ),
      // $control_options array (?)
      array(),
      // $form_options array
      array(
        'title' => array(
          'type' => 'text',
          'label' => __('Title for the carousel.', 'newsroom'),
          'default' => ''
        ),
        'posts' => array(
          'type' => 'posts',
          'label' => __('Build query for highlighted posts', 'newsroom')
        ),
        'rotate' => array(
          'type' => 'checkbox',
          'label' => __('Auto rotate carousel', 'newsroom'),
          'default' => true
        ),
        'rotate_delay' => array(
          'type' => 'number',
          'label' => __('Milisseconds to rotate the carousel', 'newsroom'),
          'default' => 8000
        )
      ),
      plugin_dir_path(STYLESHEETPATH . '/inc/siteorigin-widgets/highlight-carousel')
    );
  }
  function get_template_name($instance) {
    return 'highlight-carousel-template';
  }
  function get_template_dir($instance) {
    return '';
  }
  function get_style_name($instance) {
    return '';
  }
  function initialize() {

    static $enqueued = false;

    if(!$enqueued) {
      $this->register_frontend_scripts(
        array(
          array( 'newsroom-highlight-carousel', get_stylesheet_directory_uri() . '/inc/siteorigin-widgets/highlight-carousel/highlight-carousel.js', array( 'jquery', 'hammer.js' ), '0.0.1' )
        )
      );
      $enqueued = true;
    }


    $this->register_frontend_styles(
      array(
        array( 'newsroom-highlight-carousel', get_stylesheet_directory_uri() . '/inc/siteorigin-widgets/highlight-carousel/highlight-carousel.css', array(), '0.0.1' )
      )
    );
  }
}

if(function_exists('siteorigin_widget_register')) {
  siteorigin_widget_register('newsroom-highlight-carousel-widget', __FILE__, 'Newsroom_Highlight_Carousel_Widget');
}
