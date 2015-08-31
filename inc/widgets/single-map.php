<?php
/*
 * Newsroom widgets
 */

class Newsroom_Map_Widget extends WP_Widget {

  public function __construct() {
    add_action('admin_print_scripts-widgets.php', array($this, 'enqueue_scripts'));
    add_action('siteorigin_panel_enqueue_admin_scripts', array($this, 'enqueue_scripts'));

    parent::__construct(
      'newsroom_map_widget',
      __('JEO Map Widget', 'newsroom'),
      array('description' => __('Display a map', 'newsroom'))
    );
  }

  public function widget($args, $instance) {
    $conf = jeo_get_map_conf($instance['map']);
    $json = json_encode($conf);
    ?>
    <div class="map-container" style="height:<?php echo $instance['height']; ?>px;">
    	<div id="map_<?php echo $conf['postID']; ?>_<?php echo $conf['count']; ?>" class="map"></div>
    </div>
    <script type="text/javascript">jeo(<?php echo $json ?>);</script>
    <?php
  }

  public function form($instance) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $height = ! empty( $instance['height'] ) ? $instance['height'] : 400;
    $display_posts = ! empty( $instance['display_posts'] ) ? $instance['display_posts'] : false;
    $map = ! empty( $instance['map'] ) ? $instance['map'] : false;
    $maps = get_posts(array('post_type' => array('map','map-group'), 'posts_per_page' => -1));
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'newsroom'); ?></label>
      <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('map'); ?>"><?php _e('Map', 'newsroom'); ?></label>
      <select id="<?php echo $this->get_field_id('map'); ?>" name="<?php echo $this->get_field_name('map'); ?>">
        <?php foreach($maps as $m) : ?>
          <option value="<?php echo $m->ID; ?>" <?php if($map == $m->ID) echo 'selected'; ?>><?php echo apply_filters('the_title', $m->post_title); ?></option>
        <?php endforeach; ?>
      </select>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Map height', 'newsroom'); ?></label>
      <input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr($height); ?>" size="3" /> px
    </p>
    <?php
  }

  public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['height'] = ( ! empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : 400;
    $instance['display_posts'] = ( ! empty( $new_instance['display_posts'] ) ) ? strip_tags( $new_instance['display_posts'] ) : false;
    $instance['map'] = ( ! empty( $new_instance['map'] ) ) ? strip_tags( $new_instance['map'] ) : false;
    return $instance;
  }

  public function enqueue_scripts() {

  }

}

function newsroom_register_map_widget() {
  register_widget('Newsroom_Map_Widget');
}
add_action('widgets_init', 'newsroom_register_map_widget');

?>
