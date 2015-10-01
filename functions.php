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

function newsroom_logo() {
	$logo = newsroom_get_logo();
	if($logo) {
		?>
		<h1 class="has-logo">
			<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
				<?php bloginfo('name'); ?>
				<?php echo $logo; ?>
			</a>
		</h1>
		<?php
	} else {
		?>
		<h1>
			<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
				<?php bloginfo('name'); ?>
			</a>
		</h1>
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
