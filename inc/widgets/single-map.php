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
    ?>
    <div class="map-container">
    	<div id="map_<?php echo jeo_get_map_id(); ?>" class="map"></div>
    	<?php do_action('jeo_map'); ?>
    </div>
    <script type="text/javascript">jeo(<?php echo jeo_map_conf(); ?>);</script>
    <?php
  }

  public function form($instance) {
    ?>
    <?php
  }

  public function update($new_instance, $old_instance) {
    $instance = array();
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
