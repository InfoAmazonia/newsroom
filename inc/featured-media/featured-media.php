<?php

/*
 * Featured media (custom kicker) for Newsroom
 */

class Newsroom_Featured_Media {

  function __construct() {

    add_action('admin_init', array($this, 'setup_metabox'));
    add_action('save_post', array($this, 'save_post'));

  }

  function setup_metabox() {
    add_meta_box(
      'newsroom_featured_media',
      __('Featured media', 'newsroom'),
      array($this, 'metabox'),
      'post',
      'side',
      'core'
    );
  }

  function metabox($post) {
    $type = get_post_meta($post->ID, 'newsroom_featured_media_type', true);
    if(!$type)
      $type = 'image';
    ?>
    <p><?php _e('Select the type of media you\'d like to feature for this post', 'newsroom'); ?></p>
    <p>
      <input id="newsroom_featured_media_input_type_image" type="radio" name="newsroom_featured_media_type" value="image" <?php if($type == 'image') echo 'checked'; ?> />
      <label for="newsroom_featured_media_input_type_image"><?php _e('Post featured image', 'newsroom'); ?></label>
    </p>
    <p>
      <input id="newsroom_featured_media_input_type_gallery" type="radio" name="newsroom_featured_media_type" value="gallery" <?php if($type == 'gallery') echo 'checked'; ?> />
      <label for="newsroom_featured_media_input_type_gallery"><?php _e('Post image gallery', 'newsroom'); ?></label>
    </p>
    <p>
      <input id="newsroom_featured_media_input_type_video" type="radio" name="newsroom_featured_media_type" value="video" <?php if($type == 'video') echo 'checked'; ?> />
      <label for="newsroom_featured_media_input_type_video"><?php _e('Video', 'newsroom'); ?></label>
    </p>
    <?php
  }

  function save_post($post_id) {

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
  		return;

    if(isset($_REQUEST['newsroom_featured_media_type'])) {
      update_post_meta($post_id, 'newsroom_featured_media_type', $_REQUEST['newsroom_featured_media_type']);
    }

  }

  function featured_media($post_id) {

    global $post;
    $post_id = $post_id ? $post_id : $post->ID;

    $type = get_post_meta($post_id, 'newsroom_featured_media_type', true);
    $type = $type ? $type : 'image';

    switch($type) {
      case 'image':
        the_post_thumbnail('kicker');
        break;
      case 'gallery':
        echo 'Gallery goes here';
        break;
      case 'video':
        echo 'Video goes here';
        break;
    }

  }

}

$GLOBALS['newsroom_featured_media'] = new Newsroom_Featured_Media();

function newsroom_featured_media($post_id = false) {
  $GLOBALS['newsroom_featured_media']->featured_media($post_id);
}
