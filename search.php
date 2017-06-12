<?php
/**
 * The search template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsroom
 * @since Newsroom 1.0
 * @license GPL 3.0
 */

get_header(); ?>

<div id="primary" class="content-area">

	<div id="content" class="site-content" role="main">

		<div class="archive-header">
			<h1 class="search-title"><?php _e('Search results for:', 'jeo'); ?> <?php echo $_GET['s'] ? $_GET['s'] : $_GET['newsroom_filter_s']; ?></h1>
		</div>

    <div class="row">
      <?php jeo_featured(); ?>
    </div>
    <ul class="search-sidebar">
			<?php if(function_exists('newsroom_adv_nav_filters')) : ?>
				<li class="advanced-nav-container">
					<h3><?php _e('Advanced navigation'); ?></h3>
					<?php newsroom_adv_nav_filters(); ?>
				</li>
			<?php endif; ?>
      <?php dynamic_sidebar('search'); ?>
    </ul>
		<?php get_template_part( 'loop' ); ?>

	</div><!-- #content .site-content -->

</div><!-- #primary .content-area -->

<?php get_footer(); ?>
