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

		<h1 class="archive-title"><?php
				if( is_tag() || is_category() || is_tax() ) :
					printf( __( '%s', 'jeo' ), single_term_title() );
				elseif ( is_day() ) :
					printf( __( 'Daily Archives: %s', 'jeo' ), get_the_date() );
				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', 'jeo' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'jeo' ) ) );
				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', 'jeo' ), get_the_date( _x( 'Y', 'yearly archives date format', 'jeo' ) ) );
				else :
					_e( 'Archives', 'jeo' );
				endif;
			?></h1>

		<?php get_template_part( 'loop' ); ?>

	</div><!-- #content .site-content -->

</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
