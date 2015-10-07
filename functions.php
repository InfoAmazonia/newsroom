<?php

/*
 * Plugin dependencies
*/

require_once(STYLESHEETPATH . '/inc/class-tgm-plugin-activation.php');

function newsroom_register_required_plugins() {
	$plugins = array(
		array(
			'name' => 'Page Builder by SiteOrigin',
			'slug' => 'siteorigin-panels',
			'required' => true,
			'force_activation' => true
		)
	);
	$options = array(
		'default_path' => '',
		'menu' => 'newsroom-install-plugins',
		'has_notices' => true,
		'dismissable' => true,
		'dismiss_msg' => '',
		'is_automatic' => false,
		'message' => ''
	);
	tgmpa($plugins, $options);
}
add_action('tgmpa_register', 'newsroom_register_required_plugins');

/*
 * Theme options
 */

require_once(STYLESHEETPATH . '/inc/theme-options.php');

function newsroom_logo($mobile = false) {
	$logo = newsroom_get_logo();
	if($logo) {
		?>
		<?php echo $mobile ? '<span class="logo with-image">' : '<h1 class="has-logo">'; ?>
			<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
				<?php bloginfo('name'); ?>
				<?php echo $logo; ?>
			</a>
		<?php echo $mobile ? '</span>' : '</h1>'; ?>
		<?php
	} else {
		?>
		<?php echo $mobile ? '<span class="logo">' : '<h1>'; ?>
			<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
				<?php bloginfo('name'); ?>
			</a>
		<?php echo $mobile ? '</span>' : '</h1>'; ?>
		<?php
	}
}

/*
 * Theme setup
 */
function newsroom_setup() {

	add_image_size('highlight-carousel', 672, 380, true);
	add_image_size('kicker', 1020, 800);
	add_image_size('small-thumb', 87, 87, true);
	add_image_size('list-thumb', 237, 112, true);

	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');

	// text domain
	load_child_theme_textdomain('newsroom', get_stylesheet_directory() . '/languages');

	// nav
	register_nav_menus(array(
		'header_menu' => __('Header menu', 'newsroom'),
		'footer_menu' => __('Footer menu', 'newsroom')
	));

	unregister_sidebar('front_page');

	//sidebars
	register_sidebar(array(
		'name' => __('Post sidebar', 'newsroom'),
		'id' => 'post',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => __('General sidebar', 'newsroom'),
		'id' => 'general',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => __('Archive sidebar', 'newsroom'),
		'id' => 'archive',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => __('Search results sidebar', 'newsroom'),
		'id' => 'search',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
}
add_action('after_setup_theme', 'newsroom_setup', 100);

/*
 * Newsroom widgets
 */

include_once(STYLESHEETPATH . '/inc/widgets/single-map.php');
include_once(STYLESHEETPATH . '/inc/siteorigin-widgets/highlight-carousel/highlight-carousel.php');
include_once(STYLESHEETPATH . '/inc/siteorigin-widgets/square-posts/square-posts.php');
include_once(STYLESHEETPATH . '/inc/siteorigin-widgets/list-posts/list-posts.php');
include_once(STYLESHEETPATH . '/inc/siteorigin-widgets/list-images/list-images.php');

/*
 * Clears JEO default front-end styles and scripts
 */
function newsroom_scripts() {

	// deregister jeo styles
	wp_deregister_style('jeo-main');
  // deregister jeo site frontend scripts
  wp_deregister_script('jeo-site');

}
add_action('wp_enqueue_scripts', 'newsroom_scripts', 10);

/*
 * JEO Hooks examples
 * Most common hooks
 */

// Action right after JEO functionality inits
function newsroom_init() {
  // Action goes here
}
add_action('jeo_init', 'newsroom_init');

// Hook scripts after JEO scripts has been initialized
function newsroom_jeo_scripts() {

	// JS libraries
	wp_register_script('fitvids', get_stylesheet_directory_uri() . '/lib/jquery.fitvids.js', array('jquery'), '1.1');
	wp_register_script('hammer.js', get_stylesheet_directory_uri() . '/lib/hammerjs/hammer.min.js');


	// CSS Dependencies
	wp_register_style('newsroom-normalize', get_stylesheet_directory_uri() . '/css/normalize.css');
	wp_register_style('newsroom-entypo', get_stylesheet_directory_uri() . '/css/entypo.css');
	wp_register_style('newsroom-fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,600,600italic,700,700italic,300italic,200|Crimson+Text:400,600,700');


  // Enqueue child theme JEO related scripts
  // wp_enqueue_script('newsroom-jeo-scripts', get_stylesheet_directory_uri() . '/js/jeo-scripts.js', array('jquery') , '0.0.1');

	// Main
	wp_enqueue_script('newsroom-main', get_stylesheet_directory_uri() . '/js/main.js', array('jquery', 'fitvids'), '0.0.1');

  // Enqueue child theme main CSS

  wp_enqueue_style('newsroom-styles', get_stylesheet_directory_uri() . '/css/main.css', array('newsroom-normalize', 'newsroom-entypo', 'newsroom-fonts'));

}
add_action('jeo_enqueue_scripts', 'newsroom_jeo_scripts', 20);

function newsroom_pb_parse_query($pb_query) {
	$query = wp_parse_args($pb_query);
	if($query['tax_query']) {
		$tax_args = explode(',', $query['tax_query']);
		$query['tax_query'] = array();
		foreach($tax_args as $tax_arg) {
			$tax_arg = explode(':', $tax_arg);
			$query['tax_query'][] = array(
				'taxonomy' => $tax_arg[0],
				'field' => 'slug',
				'terms' => $tax_arg[1]
			);
		}
	}
	return $query;
}

// Single templates
include_once(STYLESHEETPATH . '/inc/single-templates/single-templates.php');

function newsroom_tax_terms($post_id = false) {
	global $post;
	$post_id = $post_id ? $post_id : $post->ID;
	$taxonomies = get_taxonomies(array(
		'public' => true,
		'show_ui' => true
	), 'objects');
	$post_tax_terms = array();
	foreach($taxonomies as $tax) {
		$terms = wp_get_post_terms($post_id, $tax->name);
		if($terms) {
			$post_tax_terms[$tax->name] = array();
			$post_tax_terms[$tax->name]['taxonomy'] = $tax;
			$post_tax_terms[$tax->name]['terms'] = $terms;
		}
	}
	if(!empty($post_tax_terms)) :
		?>
		<div class="newsroom-tax-terms">
			<?php foreach($post_tax_terms as $tax) : ?>
				<div class="tax-<?php echo $tax['taxonomy']->name; ?> tax-item">
					<p><?php echo $tax['taxonomy']->labels->name; ?>:</p>
					<ul>
						<?php foreach($tax['terms'] as $term) : ?>
							<li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	endif;
}

// Photoswipe
include_once(STYLESHEETPATH . '/inc/photoswipe/photoswipe.php');

// Featured media
include_once(STYLESHEETPATH . '/inc/featured-media/featured-media.php');


/*
 * Social APIs
 */
function newsroom_social_apis() {

	// Facebook
	$fb_api = newsroom_get_fb_client_id();
	if($fb_api) :
		?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=<?php echo $fb_api; ?>";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<?php
	endif;

	// Twitter
	?>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<?php

	// Google Plus
	?>
	<script type="text/javascript">
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
	<?php
}
add_action('wp_footer', 'newsroom_social_apis');
