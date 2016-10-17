<?php

/*
 * Newsroom List Images Widget
 */

class Newsroom_List_Images_Widget extends SiteOrigin_Widget {
  function __construct() {
    parent::__construct(
      'newsroom-list-images-widget',
      __('Newsroom List Images', 'newsroom'),
      array(
        'description' => __('Display a list of images in a regular list format.', 'newsroom')
      ),
      // $control_options array (?)
      array(),
      // $form_options array
      array(
        'title' => array(
          'type' => 'text',
          'label' => __('Title for image list.', 'newsroom'),
          'default' => ''
        ),
        'url' => array(
          'type' => 'link',
          'label' => __('Link for the title (optional)', 'newsroom'),
          'default' => ''
        ),
        'images' => array(
          'type' => 'repeater',
          'label' => __('Images', 'newsroom'),
          'item_name' => __('Image', 'newsroom'),
          'fields' => array(
            'image' => array(
              'type' => 'media',
              'label' => __('Image', 'newsroom')
            ),
            'url' => array(
              'type' => 'link',
              'label' => __('Link for the image (optional)', 'newsroom'),
              'default' => ''
            )
          )
        )
      ),
      plugin_dir_path(STYLESHEETPATH . '/inc/siteorigin-widgets/list-images')
    );
  }
  function get_template_name($instance) {
    return 'list-images-template';
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
        array( 'newsroom-list-images', get_stylesheet_directory_uri() . '/inc/siteorigin-widgets/list-images/list-images.css', array(), '0.0.1' )
      )
    );
  }
}

if(function_exists('siteorigin_widget_register')) {
  siteorigin_widget_register('newsroom-list-images-widget', __FILE__, 'Newsroom_List_Images_Widget');
}
