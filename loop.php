<?php
if(have_posts()) :
  ?>
  <div class="row">
    <?php jeo_map(); ?>
  </div>
  <div class="newsroom-list-posts per-row-4">
    <ul class="list-posts-posts">
    <?php
    while(have_posts()) :
      the_post();
      ?>
      <li class="list-posts-item <?php if(!has_post_thumbnail()) echo 'no-thumbnail'; ?>">
        <article id="list-posts-<?php the_ID(); ?>">
          <?php if(has_post_thumbnail()) : ?>
            <div class="list-posts-thumbnail">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('list-thumb'); ?></a>
            </div>
          <?php endif; ?>
          <div class="list-posts-post-content">
            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
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
