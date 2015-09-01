<?php
parse_str($instance['posts'], $query_args);
$query_args['posts_per_page'] = 4;
$query_args['without_map_query'] = 1;
unset($query_args['additional']);
$highlight_query = new WP_Query($query_args);
if($highlight_query->have_posts()) :
  ?>
  <div class="newsroom-highlight-carousel" data-rotate="<?php echo $instance['rotate'] ? 1 : 0; ?>" data-rotate-delay="<?php echo $instance['rotate_delay']; ?>">
    <ul class="highlight-carousel-posts">
    <?php
    while($highlight_query->have_posts()) :
      $highlight_query->the_post();
      ?>
      <li class="highlight-carousel-item">
        <article id="highlight-carousel-<?php the_ID(); ?>">
          <div class="highlight-carousel-thumbnail">
            <?php the_post_thumbnail(); ?>
          </div>
          <div class="highlight-carousel-post-content">
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <p class="date"><?php echo get_the_date(); ?></p>
            <?php the_excerpt(); ?>
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
