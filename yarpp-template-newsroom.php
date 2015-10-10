<?php
if(have_posts()) :
  ?>
  <h3><?php _e('Related Content', 'newsroom'); ?></h3>
  <div class="newsroom-square-posts">
    <ul class="square-posts-posts">
    <?php
    while(have_posts()) :
      the_post();
      ?>
      <li class="square-posts-item <?php if(!has_post_thumbnail()) echo 'no-thumbnail'; ?>">
        <article id="related-post-<?php the_ID(); ?>">
          <?php if(has_post_thumbnail()) : ?>
            <div class="square-posts-thumbnail">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('small-thumb'); ?></a>
            </div>
          <?php endif; ?>
          <div class="square-posts-post-content">
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <p class="date"><?php echo get_the_date(); ?></p>
          </div>
        </article>
      </li>
      <?php
      wp_reset_postdata();
    endwhile;
    ?>
    </ul>
  </div>
  <?php
endif;
?>
