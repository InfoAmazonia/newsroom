<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<article id="primary" class="content-area" role="main">
		<header class="page-header">
			<h1><?php the_title(); ?></h1>
		</header>
	    <section class="page-content">
				<?php the_content(); ?>
				<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'jeo' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
				?>
	    </section>
		<aside id="page-sidebar">
			<ul class="widgets">
				<?php dynamic_sidebar('general'); ?>
			</ul>
		</aside>
	</article>
<?php endif; ?>

<?php get_footer(); ?>
