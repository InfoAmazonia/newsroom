<?php
/**
 * The template for displaying the home page panel. Requires SiteOrigin page builder plugin.
 *
 * Template Name: Page Builder Special
 *
 * @package Newsroom
 * @since Newsroom 1.0
 * @see http://siteorigin.com/page-builder/
 * @license GPL 3.0
 */

get_header();
?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<div class="entry-content">
			<?php
			// by mohjak 2019-11-26 Fix blank landing pages
			if (is_page()) {
				if (function_exists('siteorigin_panels_render')) {
					echo siteorigin_panels_render($post->ID);
				} else {
					the_post();
					the_content();
        }
			}
			?>
		</div>
	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>
