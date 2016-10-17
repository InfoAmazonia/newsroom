<?php

/*
 * Newsroom
 * Theme options
 */

class Newsroom_Options {

	function __construct() {

		add_action('admin_menu', array($this, 'admin_menu'));
		add_action('admin_init', array($this, 'init_theme_settings'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

	}

	function enqueue_scripts() {

		if(get_current_screen()->id == 'appearance_page_newsroom_options') {
			wp_enqueue_media();
			wp_enqueue_script('newsroom-theme-options', get_stylesheet_directory_uri() . '/inc/theme-options.js');
		}

	}

	var $themes = array(
		'Default' => ''
	);

	function admin_menu() {

		add_theme_page(__('Newsroom Style', 'newsroom'), __('Newsroom', 'newsroom'), 'edit_theme_options', 'newsroom_options', array($this, 'admin_page'));

	}

	function admin_page() {

		$this->options = get_option('newsroom_options');

		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2><?php _e('Newsroom Theme Options', 'newsroom'); ?></h2>
			<form method="post" action="options.php">
			<?php
				settings_fields('newsroom_options_group');
				do_settings_sections('newsroom_options');
				submit_button();
			?>
			</form>
		</div>
		<?php
	}

	function init_theme_settings() {

		mapbox_metabox_init();

		add_settings_section(
			'newsroom_style_section',
			__('Style', 'newsroom'),
			'',
			'newsroom_options'
		);

		add_settings_section(
			'newsroom_links_section',
			__('Links', 'newsroom'),
			'',
			'newsroom_options'
		);

		add_settings_section(
			'newsroom_social_apis_section',
			__('Social APIs', 'newsroom'),
			'',
			'newsroom_options'
		);

		add_settings_field(
			'newsroom_style',
			__('Choose a style', 'newsroom'),
			array($this, 'style_field'),
			'newsroom_options',
			'newsroom_style_section'
		);

		add_settings_field(
			'newsroom_logo',
			__('Upload a custom logo', 'newsroom'),
			array($this, 'logo_field'),
			'newsroom_options',
			'newsroom_style_section'
		);

		add_settings_field(
			'newsroom_facebook',
			__('Facebook url', 'newsroom'),
			array($this, 'facebook_field'),
			'newsroom_options',
			'newsroom_links_section'
		);

		add_settings_field(
			'newsroom_twitter',
			__('Twitter url', 'newsroom'),
			array($this, 'twitter_field'),
			'newsroom_options',
			'newsroom_links_section'
		);

		add_settings_field(
			'newsroom_legal_disclaimer',
			__('Legal disclaimer', 'newsroom'),
			array($this, 'legal_disclaimer_field'),
			'newsroom_options',
			'newsroom_links_section'
		);

		add_settings_field(
			'newsroom_facebook_client_id',
			__('Facebook App ID', 'newsroom'),
			array($this, 'facebook_api_field'),
			'newsroom_options',
			'newsroom_social_apis_section'
		);

		register_setting('newsroom_options_group', 'newsroom_options');

	}

	function style_field() {
		?>
		<select id="newsroom_style" name="newsroom_options[style]">
			<?php foreach($this->themes as $theme => $path) { ?>
				<option <?php if($this->options['style'] == $path) echo 'selected'; ?> value="<?php echo $path; ?>"><?php _e($theme); ?></option>
			<?php } ?>
		</select>
		<?php
	}

	function logo_field() {
		$logo = $this->options['logo'];
		?>
		<div class="uploader">
			<input id="newsroom_logo" name="newsroom_options[logo]" type="text" placeholder="<?php _e('Logo url', 'newsroom'); ?>" value="<?php echo $logo; ?>" size="80" />
			<a  id="newsroom_logo_button" class="button" /><?php _e('Upload'); ?></a>
		</div>
		<?php if($logo) { ?>
			<div class="logo-preview">
				<img src="<?php echo $logo; ?>" style="max-width:300px;height:auto;" />
			</div>
			<?php } ?>
		<?php
	}

	function facebook_field() {
		$facebook = $this->options['facebook_url'];
		?>
		<input id="newsroom_facebook_url" name="newsroom_options[facebook_url]" type="text" value="<?php echo $facebook; ?>" size="70" />
		<?php
	}

	function twitter_field() {
		$twitter = $this->options['twitter_url'];
		?>
		<input id="newsroom_twitter_url" name="newsroom_options[twitter_url]" type="text" value="<?php echo $twitter; ?>" size="70" />
		<?php
	}

	function legal_disclaimer_field() {
		$disclaimer = $this->options['legal_disclaimer'];
		?>
		<textarea id="newsroom_legal_disclaimer" name="newsroom_options[legal_disclaimer]" rows="10" cols="70"><?php echo $disclaimer; ?></textarea>
		<?php
	}

	function facebook_api_field() {
		$app_id = $this->options['facebook_client_id'];
		?>
		<input type="text" size="80" id="newsroom_facebook_client_id" name="newsroom_options[facebook_client_id]" value="<?php echo $app_id; ?>" />
		<?php
	}

}

if(is_admin())
	$GLOBALS['newsroom_options'] = new Newsroom_Options();

function newsroom_get_logo() {

	$options = get_option('newsroom_options');
	if($options['logo'])
		return '<img src="' . $options['logo'] . '" alt="' . get_bloginfo('name') . '" />';
	else
		return false;

}

function newsroom_get_facebook_url() {

	$options = get_option('newsroom_options');
	if($options['facebook_url']) {
		return $options['facebook_url'];
	} else {
		return false;
	}

}

function newsroom_get_twitter_url() {

	$options = get_option('newsroom_options');
	if($options['twitter_url']) {
		return $options['twitter_url'];
	} else {
		return false;
	}

}

function newsroom_get_legal_disclaimer() {

	$options = get_option('newsroom_options');
	if($options['legal_disclaimer']) {
		return $options['legal_disclaimer'];
	} else {
		return false;
	}

}

function newsroom_get_fb_client_id() {
	$options = get_option('newsroom_options');
	if($options['facebook_client_id']) {
		return $options['facebook_client_id'];
	}	 else {
		return false;
	}
}
