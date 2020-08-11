<?php 
/*
Template Name: Author List
*/
?>

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

				<div class="author-alphabet">
					<?php 
					$letter = '';
					$newletter = '1';
					$blogusers = get_users( 'orderby=nicename' );
					usort($blogusers, create_function('$a, $b', 'return strnatcasecmp($a->last_name, $b->last_name);'));
					foreach ( $blogusers as $user ) {
						if(!$user->last_name == "") {
							
							$letter = substr($user->last_name,0,1);
							$letter = strtoupper($letter);
							if($letter !== $newletter) {
								$newletter = $letter;
								echo '<a href="#al-' . $letter . '">' . $letter . '</a>';
							}
						} 
					}?>
				</div>

				<div class="authorsList">

					<?php 
					$letter = '';
					$newletter = '1';
					$blogusers = get_users( 'orderby=nicename' );
					usort($blogusers, create_function('$a, $b', 'return strnatcasecmp($a->last_name, $b->last_name);'));
					foreach ( $blogusers as $user ) {
						if(!$user->last_name == "") {
							
							$letter = substr($user->last_name,0,1);
							$letter = strtoupper($letter);
							if($letter !== $newletter) {
								$newletter = $letter;
								echo '<div class="alphabetListing" id="al-' . $letter . '">' . $letter . '</div>';
							}
							
							echo $user->user_url;
							echo '<div class="authorListing"><a href="' . get_bloginfo('url') . '/author/' . $user->user_nicename . '">';
							echo '' . esc_html( $user->last_name ) . ', ' . esc_html( $user->first_name ) . '';
							echo '</a></div>';
						}
					} ?>

				</div>
	    </section>

		<aside id="page-sidebar">
			<ul class="widgets">
				<?php dynamic_sidebar('general'); ?>
			</ul>
		</aside>
	</article>
<?php endif; ?>

<?php get_footer(); ?>
