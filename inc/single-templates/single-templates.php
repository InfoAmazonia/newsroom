<?php

/*
 * Single post templates for Newsroom
 */

class Newsroom_Single_Templates {

  function get_template_dir() {
    return STYLESHEETPATH . '/inc/single-templates/templates';
  }

  function get_templates() {
    return apply_filters('newsroom_single_templates', array(
      'story' => __('Story', 'newsroom'),
      // 'sequence' => __('Sequence', 'newsroom')
    ));
  }

  function __construct() {
    add_action('template_redirect', array($this, 'template_redirect'));
    if(count($this->get_templates()) > 1) {
      add_action('admin_init', array($this, 'setup_metabox'));
    }
    add_action('save_post', array($this, 'save_post'));
  }

  function template_redirect() {
    if(is_singular('post')) {
      global $post;
      $template = get_post_meta($post->ID, 'newsroom_template', true);
      if(!$template)
        $template = array_keys($this->get_templates())[0];

      include($this->get_template_dir() . '/' . $template . '.php');
      exit();
    }
  }

  function setup_metabox() {

    add_meta_box(
      'newsroom_single_template',
      __('Template', 'newsroom'),
      array($this, 'metabox'),
      'post',
      'side',
      'high'
    );

  }

  function metabox($post) {
    $current_template = get_post_meta($post->ID, 'newsroom_template', true);
    if(!$current_template)
      $current_template = array_keys($this->get_templates())[0];
    ?>
    <p><?php _e('Select the template to display this post', 'newsroom'); ?></p>
    <?php
    foreach($this->get_templates() as $template_key => $template_label) :
      ?>
      <p>
        <input id="newsroom_single_template_input_<?php echo $template_key; ?>" name="newsroom_template" type="radio" value="<?php echo $template_key; ?>" <?php if($current_template == $template_key) echo 'checked'; ?> /> <label for="newsroom_single_template_input_<?php echo $template_key; ?>"><?php echo $template_label; ?></label>
      </p>
      <?php
    endforeach;
    ?>
    <?php
  }

  function save_post($post_id) {

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
  		return;

    if(isset($_REQUEST['newsroom_template'])) {
      update_post_meta($post_id, 'newsroom_template', $_REQUEST['newsroom_template']);
    }

  }

}

new Newsroom_Single_Templates();
