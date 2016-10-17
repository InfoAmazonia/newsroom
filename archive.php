<?php
/**
 * The archive template file.
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

		<header class="archive-header">
			<?php if(is_tag() || is_category() || is_tax()) : ?>
				<p class="tax-name">
					<?php
					if(is_tax()) {
						global $wp_query;
						$tax = get_taxonomy($wp_query->query_vars['taxonomy']);
					} elseif(is_category()) {
						$tax = get_taxonomy('category');
					} elseif(is_tag()) {
						$tax = get_taxonomy('post_tag');
					}
					echo $tax->labels->singular_name;
					?>
				</p>
			<?php endif; ?>

			<h1 class="archive-title">
				<?php
					if( is_tag() || is_category() || is_tax() ) :
						printf( __( '%s', 'newsroom' ), single_term_title() );
					elseif ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'newsroom' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'newsroom' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'newsroom' ) ) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'newsroom' ), get_the_date( _x( 'Y', 'yearly archives date format', 'newsroom' ) ) );
					else :
						_e( 'Archives', 'newsroom' );
					endif;
				?>
			</h1>

			<?php if(is_tag() || is_category() || is_tax()) : ?>
				<div class="term-description">
					<?php echo term_description(); ?>
				</div>
			<?php endif; ?>
		</header>

    <div class="row">
      <?php jeo_featured(); ?>
    </div>
    <ul class="archive-sidebar">
      <?php dynamic_sidebar('archive'); ?>
    </ul>
		<?php get_template_part( 'loop' ); ?>

	</div><!-- #content .site-content -->

</div><!-- #primary .content-area -->

<?php get_footer(); ?>
