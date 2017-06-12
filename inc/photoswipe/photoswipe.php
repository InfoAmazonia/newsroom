<?php

/*
 * Photoswip post integration for Newsroom
 */

class Newsroom_Photoswipe {

  var $count = 0;

  function __construct() {
    add_action('wp_enqueue_scripts', array($this, 'scripts'));
    add_shortcode('photoswipe', array($this, 'post_gallery'));
  }

  function scripts() {

    wp_register_script('photoswipe', get_stylesheet_directory_uri() . '/lib/photoswipe/photoswipe.min.js');
    wp_register_script('photoswipe-ui', get_stylesheet_directory_uri() . '/lib/photoswipe/photoswipe-ui-default.min.js', array('photoswipe'));

    wp_register_style('photoswipe', get_stylesheet_directory_uri() . '/lib/photoswipe/photoswipe.css');
    wp_register_style('photoswipe-skin', get_stylesheet_directory_uri() . '/lib/photoswipe/default-skin/default-skin.css', array('photoswipe'));

    wp_enqueue_script('photoswipe-ui');
    wp_enqueue_style('photoswipe-skin');

  }

  function post_gallery() {
    global $post;
    $images = get_attached_media('image');
    $this->count++;
    $first = reset($images);
    $first_src = wp_get_attachment_image_src($first->ID, 'kicker');
    ob_start();
    // print_r($images);
    ?>
    <div class="nr-gallery toggle-gallery" data-galleryid="nr-gallery-<?php echo $this->count; ?>" style="width:<?php echo $first_src[1]; ?>px;height:<?php echo $first_src[2]; ?>px;">
      <img src="<?php echo $first_src[0]; ?>" />
      <span class="image-count">
        <span class="icon icon-magnifying-glass"></span>
        +<?php echo count($images)-1; ?> <?php _e('images', 'newsroom'); ?>
        </span>
      <?php
      include(STYLESHEETPATH . '/inc/photoswipe/template.php');
      ?>
    </div>
    <script type="text/javascript">
      (function() {

        $(document).ready(function() {
          $('.toggle-gallery').on('click', function() {
            var id = $(this).attr('data-galleryid');
            initGallery(id, 0);
          });
        });

        function initGallery(id, index) {

          var pwspElement = document.querySelectorAll('.' + id)[0];

          var items = [];

          <?php foreach($images as $image) :
            $src = wp_get_attachment_image_src($image->ID, 'full');
            $small_src = wp_get_attachment_image_src($image->ID, 'small');
            ?>
            items.push({
              src: '<?php echo $src[0]; ?>',
              msrc: '<?php echo $small_src[0]; ?>',
              w: <?php echo $src[1]; ?>,
              h: <?php echo $src[2]; ?>,
              title: '<?php echo $image->post_title . '. ' . $image->post_excerpt; ?>'
            });
          <?php endforeach; ?>

          var options = {
            index: index
          };

          var gallery = new PhotoSwipe(pwspElement, PhotoSwipeUI_Default, items, options);

          gallery.init();

        }

      })();
    </script>
    <?php
    $gallery = ob_get_clean();
    return $gallery;
  }

}

$GLOBALS['newsroom_photoswipe'] = new Newsroom_Photoswipe();
