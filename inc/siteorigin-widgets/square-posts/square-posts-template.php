<?php
parse_str($instance['posts'], $query_args);
$query_args['without_map_query'] = 1;
unset($query_args['additional']);
$square_posts_query = new WP_Query($query_args);
if($square_posts_query->have_posts()) :
  ?>
  <div class="newsroom-square-posts per-row-<?php echo $instance['per_row'] ? $instance['per_row'] : 4; ?>">
    <ul class="square-posts-posts">
    <?php
    while($square_posts_query->have_posts()) :
      $square_posts_query->the_post();
      ?>
      <li class="square-posts-item <?php if(!has_post_thumbnail()) echo 'no-thumbnail'; ?>">
        <article id="<?php echo $instance['panels_info']['id']; ?>-square-posts-<?php the_ID(); ?>">
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
