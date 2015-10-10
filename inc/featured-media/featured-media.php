<?php

/*
 * Featured media (custom kicker) for Newsroom
 */

class Newsroom_Featured_Media {

  function __construct() {

    add_action('admin_init', array($this, 'setup_metabox'));
    add_action('save_post', array($this, 'save_post'));
    add_filter('the_content', array($this, 'the_content'), 20);

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
    <?php if(class_exists('Newsroom_Photoswipe')) : ?>
      <p>
        <input id="newsroom_featured_media_input_type_gallery" type="radio" name="newsroom_featured_media_type" value="gallery" <?php if($type == 'gallery') echo 'checked'; ?> />
        <label for="newsroom_featured_media_input_type_gallery"><?php _e('Post image gallery', 'newsroom'); ?></label>
      </p>
    <?php endif; ?>
    <p>
      <input id="newsroom_featured_media_input_type_map" type="radio" name="newsroom_featured_media_type" value="map" <?php if($type == 'map') echo 'checked'; ?> />
      <label for="newsroom_featured_media_input_type_map"><?php _e('Map', 'newsroom'); ?></label>
    </p>
    <p>
      <input id="newsroom_featured_media_input_type_post_media" type="radio" name="newsroom_featured_media_type" value="post_media" <?php if($type == 'post_media') echo 'checked'; ?> />
      <label for="newsroom_featured_media_input_type_post_media"><?php _e('Post media', 'newsroom'); ?> <small><?php printf(__('(First external media attached to post content. <a href="%s">See available media here</a>)', 'newsroom'), 'https://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F'); ?></small></label>
    </p>
    <?php
  }

  function save_post($post_id) {

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
  		return;

    if(isset($_REQUEST['newsroom_featured_media_type'])) {
      update_post_meta($post_id, 'newsroom_featured_media_type', $_REQUEST['newsroom_featured_media_type']);
    }

    // Update first media data
    $media = $this->get_post_content_media($post_id);
    if(count($media) >= 1) {
      update_post_meta($post_id, '_newsroom_first_media', $media[0]);
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
        echo '<div class="image-caption">' . apply_filters('the_content', get_post(get_post_thumbnail_id())->post_excerpt) . '</div>';
        break;
      case 'gallery':
        echo do_shortcode('[photoswipe]');
        break;
      case 'map':
        jeo_map();
        break;
      case 'post_media':
        echo get_post_meta($post_id, '_newsroom_first_media', true);
        break;
    }

  }

  function get_post_content_media($post_id = false) {
    global $post;
    $post_id = $post_id ? $post_id : $post->ID;
    $p = get_post($post_id);
    $content = do_shortcode(apply_filters('the_content', $p->post_content));
    return get_media_embedded_in_content($content);
  }

  function the_content($content) {
    global $post;
    if('post_media' == get_post_meta($post->ID, 'newsroom_featured_media_type', true)) {
      $content = str_replace(get_post_meta($post->ID, '_newsroom_first_media', true), '', $content);
    }
    return $content;
  }

}

$GLOBALS['newsroom_featured_media'] = new Newsroom_Featured_Media();

function newsroom_featured_media($post_id = false) {
  $GLOBALS['newsroom_featured_media']->featured_media($post_id);
}

function newsroom_get_media($post_id = false) {
  return $GLOBALS['newsroom_featured_media']->get_post_content_media($post_id);
}
