<?php if(!empty($instance['images'])) : ?>
  <div class="newsroom-list-images">
    <?php if($instance['title']) : ?>
      <div class="newsroom-section-title">
        <h2>
          <?php if($instance['url']) : ?><a href="<?php echo $instance['url']; ?>" title="<?php echo $instance['title']; ?>"><?php endif; ?>
          <?php echo $instance['title']; ?>
          <?php if($instance['url']) echo '</a>'; ?>
        </h2>
      </div>
    <?php endif; ?>
    <ul class="list-images-images">
      <?php foreach($instance['images'] as $image) :
        $src = wp_get_attachment_image_src($image['image'], 'full');
        ?>
        <li>
          <?php if($image['url']) : ?><a href="<?php echo $image['url']; ?>" title="<?php /* by mohjak 2019-11-21 issue#119 */ echo isset($image['title']) ? $image['title'] : ''; ?>"><?php endif; ?>
          <img src="<?php echo $src[0]; ?>" />
          <?php if($image['url']) echo '</a>'; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
