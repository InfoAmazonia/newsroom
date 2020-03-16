<?php
/**
* The 404 template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @package Newsroom
* @since Newsroom 1.0
* @license GPL 3.0
*/

get_header(); ?>

<div id="primary" class="content-area">

  <div id="content" class="site-content" role="main">

    <div class="archive-header">
      <?php
      $search_term = substr($_SERVER['REQUEST_URI'],1);
      // by mohjak: 2020-03-09 fix issue All category landing pages broken issue#203
      $s = "";
      // by mohjak: 2019-11-21 issue#114 + excel line 21 issue#120
      if (function_exists('qtrans_getLanguage')) {
          $find = array("'.html'", "'" . qtrans_getLanguage() . "/'", "'[-/_]'");
      }
      if (isset($find) && $find) {
          $s = trim(preg_replace($find, ' ', $search_term));
      }
      ?>
      <h1 class="search-title"><?php _e('404 Not Found', 'newsroom'); ?></h1>
      <h2><?php _e('Looking search results for ', 'newsroom'); ?> "<?php echo $s; ?>"</h2>
    </div>
    <ul class="search-sidebar">
      <?php dynamic_sidebar('archive'); ?>
    </ul>
    <?php query_posts(array('s' => $s)); ?>
    <?php get_template_part( 'loop' ); ?>
    <?php wp_reset_query(); ?>

  </div><!-- #content .site-content -->

</div><!-- #primary .content-area -->

<?php get_footer(); ?>
