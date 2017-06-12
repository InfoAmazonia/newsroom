<?php get_header(); ?>


    <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>

    <article id="primary" class="content-area" role="main">
		<header class="page-header">
			<span class="author-topline">Author</span>
		</header>

		<section class="page-content">

			<div class="author-bio">
	
				<?php //if ( get_the_author_meta( 'description' ) ) : ?>
					<div class="author-bio-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
					</div>
				<?php //endif; ?>

				<div class="author-bio-description">
					<h1 class="author-headline"><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?> </h1>
				    <?php echo $curauth->user_description; ?>
				</div>

    		<p class="author-leadin">Articles by <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></p>

		    <ul class="author-postlist">
			    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			        <li>
			        	<?php the_post_Thumbnail('thumbnail');?>
			            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
				            <?php the_title(); ?>
				        </a></h2>
				        <?php the_excerpt();?>
			            Posted <?php the_time('d M Y'); ?> in <?php the_category('&');?>
			        </li>

			    <?php endwhile; else: ?>
			        <p><?php _e('No articles by this author.'); ?></p>
			    <?php endif; ?>
			</ul>
		</section>

		<aside id="page-sidebar">
			<ul class="widgets">
				<?php dynamic_sidebar('general'); ?>
			</ul>
		</aside>
	</article>


<?php get_footer(); ?>
