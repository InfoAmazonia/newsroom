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
		<div class="content-container">
			<aside id="share">
				<p><?php _e('Share this story', 'newsroom'); ?></p>
				<ul>
					<li>
						<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="box_count" data-show-faces="false" data-send="false"></div>
					</li>
					<li>
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-lang="en" data-count="vertical">Tweet</a>
					</li>
					<li>
						<div class="g-plusone" data-size="tall" data-href="<?php the_permalink(); ?>"></div>
					</li>
				</ul>
			</aside>
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
					<aside id="bottom-share">
						<p><?php _e('Share this story', 'newsroom'); ?></p>
						<ul>
							<li>
								<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="box_count" data-show-faces="false" data-send="false"></div>
							</li>
							<li>
								<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-lang="en" data-count="vertical">Tweet</a>
							</li>
							<li>
								<div class="g-plusone" data-size="tall" data-href="<?php the_permalink(); ?>"></div>
							</li>
						</ul>
					</aside>
					<?php
					if(function_exists('yarpp_related')) {
						yarpp_related();
					}
					?>
				<?php comments_template(); ?>
			</section>
		</div>
		<aside id="sidebar">
			<ul class="widgets">
				<?php dynamic_sidebar('post'); ?>
			</ul>
		</aside>
	</article>

<?php endif; ?>

<?php get_footer(); ?>
