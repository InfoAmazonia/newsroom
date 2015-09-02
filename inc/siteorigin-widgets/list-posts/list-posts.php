<?php

/*
 * Newsroom List Posts Widget
 */

class Newsroom_List_Posts_Widget extends SiteOrigin_Widget {
  function __construct() {
    parent::__construct(
      'newsroom-list-posts-widget',
      __('Newsroom List Posts', 'newsroom'),
      array(
        'description' => __('Display a list of posts in a regular list format.', 'newsroom')
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
        'url' => array(
          'type' => 'link',
          'label' => __('Link for the title', 'newsroom'),
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
      plugin_dir_path(STYLESHEETPATH . '/inc/siteorigin-widgets/list-posts')
    );
  }
  function get_template_name($instance) {
    return 'list-posts-template';
  }
  function get_template_dir($instance) {
    return '';
  }
  function get_style_name($instance) {
    return '';
  }
  function initialize() {
    $this->register_frontend_styles(
      array(
        array( 'newsroom-list-posts', get_stylesheet_directory_uri() . '/inc/siteorigin-widgets/list-posts/list-posts.css', array(), '0.0.1' )
      )
    );
  }
}

if(function_exists('siteorigin_widget_register')) {
  siteorigin_widget_register('newsroom-list-posts-widget', __FILE__, 'Newsroom_List_Posts_Widget');
}
