<?php
if(have_posts()) :
  ?>
  <div class="post-list">
    <ul class="post-list-posts">
    <?php
    while(have_posts()) :
      the_post();
      ?>
      <li class="post-list-item <?php if(!has_post_thumbnail()) echo 'no-thumbnail'; ?>">
        <article id="post-<?php the_ID(); ?>">
          <?php if(has_post_thumbnail()) : ?>
            <div class="post-list-thumbnail">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('medium'); ?></a>
            </div>
          <?php endif; ?>
          <div class="post-list-post-content">
            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
            <p class="date"><?php echo get_the_date(); ?></p>
            <div class="excerpt"><?php the_excerpt(); ?></div>
          </div>
        </article>
      </li>
      <?php
      wp_reset_postdata();
    endwhile;
    ?>
    </ul>
    <?php posts_nav_link(); ?>
  </div>
  <?php
endif;
?>
