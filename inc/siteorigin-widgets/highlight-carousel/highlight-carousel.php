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
          'label' => 'Build query for highlighted posts'
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
}

if(function_exists('siteorigin_widget_register')) {
  siteorigin_widget_register('newsroom-highlight-carousel-widget', __FILE__, 'Newsroom_Highlight_Carousel_Widget');
}
