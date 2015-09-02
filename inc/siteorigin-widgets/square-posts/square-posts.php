<?php

/*
 * Newsroom Square Posts Widget
 */

class Newsroom_Square_Posts_Widget extends SiteOrigin_Widget {
  function __construct() {
    parent::__construct(
      'newsroom-square-posts-widget',
      __('Newsroom Square Posts', 'newsroom'),
      array(
        'description' => __('Display a list of posts in a small square format.', 'newsroom'),
        // 'default_style' => 'square-posts'
      ),
      // $control_options array (?)
      array(),
      // $form_options array
      array(
        'title' => array(
          'type' => 'text',
          'label' => __('Title for post list.', 'newsroom'),
          'default' => ''
        ),
        'posts' => array(
          'type' => 'posts',
          'label' => __('Build query for posts to be displayed', 'newsroom')
        ),
        'per_row' => array(
          'type' => 'select',
          'label' => __('Posts to display per row', 'newsroom'),
          'options' => array(
            '4' => '4',
            '3' => '3',
            '2' => '2'
          ),
          'default' => 4
        )
      ),
      plugin_dir_path(STYLESHEETPATH . '/inc/siteorigin-widgets/square-posts')
    );
  }
  function get_template_name($instance) {
    return 'square-posts-template';
  }
  function get_template_dir($instance) {
    return '';
  }
  function get_style_name($instance) {
    // return 'square-posts';
    return '';
  }
  function get_less_variables($instance) {
    // print_r($instance);
    return array();
  }
  function initialize() {
    $this->register_frontend_styles(
      array(
        array( 'newsroom-square-posts', get_stylesheet_directory_uri() . '/inc/siteorigin-widgets/square-posts/square-posts.css', array(), '0.0.1' )
      )
    );
  }
}

if(function_exists('siteorigin_widget_register')) {
  siteorigin_widget_register('newsroom-square-posts-widget', __FILE__, 'Newsroom_Square_Posts_Widget');
}
