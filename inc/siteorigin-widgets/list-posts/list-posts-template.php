<?php
parse_str($instance['posts'], $query_args);
$query_args['without_map_query'] = 1;
unset($query_args['additional']);
$list_posts_query = new WP_Query($query_args);
if($list_posts_query->have_posts()) :
  ?>
  <div class="newsroom-list-posts per-row-<?php echo $instance['per_row'] ? $instance['per_row'] : 4; ?>">
    <?php if($instance['title']) : ?>
      <div class="newsroom-section-title">
        <h2>
          <?php if($instance['url']) : ?><a href="<?php echo $instance['url']; ?>" title="<?php echo $instance['title']; ?>"><?php endif; ?>
          <?php echo $instance['title']; ?>
          <?php if($instance['url']) echo '</a>'; ?>
        </h2>
      </div>
    <?php endif; ?>
    <ul class="list-posts-posts">
    <?php
    while($list_posts_query->have_posts()) :
      $list_posts_query->the_post();
      ?>
      <li class="list-posts-item <?php if(!has_post_thumbnail()) echo 'no-thumbnail'; ?>">
        <article id="list-posts-<?php the_ID(); ?>">
          <?php if(has_post_thumbnail()) : ?>
            <div class="list-posts-thumbnail">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
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
