<footer id="colophon">
  <div class="footer-content">
    <nav id="footer-nav">
      <?php wp_nav_menu(array('theme_location' => 'footer_menu')); ?>
    </nav>
    <ul id="footer-sidebar">
      <?php dynamic_sidebar('footer'); ?>
    </ul>
    <div class="credits">
      <p><?php printf(__('This website is built on <a href="%s" target="_blank" rel="external">WordPress</a> using the <a href="%s" target="_blank" rel="external">JEO Newsroom</a> theme', 'newsroom'), 'http://wordpress.org', 'http://github.com/infoamazonia/newsroom/'); ?></p>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
