<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>

	<?php //jeo_map(); ?>

	<article id="primary" class="content-area" role="main">
		<header class="page-header">
			<h1><?php the_title(); ?></h1>
      <?php global $post; if($post->post_excerpt) : ?>
        <div class="subhead">
          <?php the_excerpt(); ?>
        </div>
      <?php endif; ?>
      <div class="kicker">
        <?php newsroom_featured_media(); ?>
      </div>
			<div class="post-meta">
        <div class="byline">
  				<p><?php the_author(); ?>, <?php the_date(); ?></p>
        </div>
        <div class="terms">
          <?php newsroom_tax_terms(); ?>
        </div>
			</div>
		</header>
		<section class="content">
			<?php the_content(); ?>
			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'newsroom' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
			<?php comments_template(); ?>
		</section>
		<aside id="sidebar">
			<ul class="widgets">
				<?php dynamic_sidebar('post'); ?>
			</ul>
		</aside>
	</article>

<?php endif; ?>

<?php get_footer(); ?>
