<?php

/*
* Newsroom
* Advanced navigation
*/


class Newsroom_AdvancedNav {

	var $prefix = 'newsroom_filter_';
	var $slug = 'explore';

	function __construct() {

		add_filter('query_vars', array($this, 'query_vars'));
		add_filter('body_class', array($this, 'body_class'));
		add_action('template_redirect', array($this, 'template_redirect'));
		add_action('pre_get_posts', array($this, 'pre_get_posts'));
		add_action('generate_rewrite_rules', array($this, 'generate_rewrite_rules'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

	}

	function query_vars($vars) {
		$vars[] = 'newsroom_advanced_nav';
		return $vars;
	}

	function body_class($class) {
		if(get_query_var('newsroom_advanced_nav'))
		$class[] = 'advanced-nav';
		return $class;
	}

	function generate_rewrite_rules($wp_rewrite) {
		$widgets_rule = array(
			$this->slug . '$' => 'index.php?newsroom_advanced_nav=1'
		);
		$wp_rewrite->rules = $widgets_rule + $wp_rewrite->rules;
	}

	function template_redirect() {
		if(get_query_var('newsroom_advanced_nav')) {
			include(STYLESHEETPATH . '/search.php');
			exit();
		}
	}

	function pre_get_posts($query) {

		if($query->is_main_query()) {

			if($query->get('newsroom_advanced_nav')) {
				$query->is_home = false;
				$query->set('posts_per_page', 30);
				$query->set('ignore_sticky_posts', true);
			}

			if(isset($_GET[$this->prefix . 's'])) {

				$query->set('s', $_GET[$this->prefix . 's']);

			}

			if(isset($_GET[$this->prefix])) {

				$tax_query = array();

				$taxonomies = get_taxonomies(array(
					'public' => true,
					'object_type' => array('post')
				));

				$tax_key = $this->prefix . 'tax_';

				foreach($taxonomies as $tax) {

					if(isset($_GET[$tax_key . $tax])) {

						$tax_query[] = array(
							'taxonomy' => $tax,
							'field' => 'term_id',
							'terms' => $_GET[$tax_key . $tax]
						);

					}

				}

				$query->set('tax_query', $tax_query);

			}

			if(isset($_GET[$this->prefix . 'category'])) {

				$query->set('category__in', $_GET[$this->prefix . 'category']);

			}

			if(isset($_GET[$this->prefix . 'date_start'])) {

				$after = $_GET[$this->prefix . 'date_start'];
				$before = $_GET[$this->prefix . 'date_end'];

				if($after) {

					if(!$before)
					$before = date('Y-m-d H:i:s');

					$query->set('date_query', array(
						array(
							'after' => date('Y-m-d H:i:s', strtotime($after)),
							'before' => date('Y-m-d H:i:s', strtotime($before)),
							'inclusive' => true
							)
						));
					}

				}

			}

		}

		function enqueue_scripts() {

			wp_enqueue_script('chosen');
			wp_enqueue_script('moment');
			wp_enqueue_style('chosen');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_style('jquery-ui-smoothness', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');

		}

		function get_taxonomy_input($tax) {

			$categories = get_categories();

			$terms = get_terms($tax);
			$tax_obj = get_taxonomy($tax);
			$key = $this->prefix . 'tax_' . $tax;
			$active_terms = isset($_GET[$key]) ? $_GET[$key] : array();
			if($terms) :
				?>
				<div class="tax-input tax-<?php echo $tax; ?>-input adv-nav-input">
					<p class="label"><label for="<?php echo $this->prefix; ?>tax_<?php echo $tax; ?>"><?php echo $tax_obj->labels->name; ?></label></p>
					<select id="<?php echo $this->prefix; ?>category" name="<?php echo $this->prefix; ?>tax_<?php echo $tax; ?>[]" multiple data-placeholder="<?php _e('Select', 'newsroom'); ?> <?php echo $tax_obj->labels->name; ?>">
						<?php foreach($terms as $term) : ?>
							<option value="<?php echo $term->term_id; ?>" <?php if(in_array($term->term_id, $active_terms)) echo 'selected'; ?>><?php echo $term->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<?php
			endif;

		}

		function form() {

			?>
			<form class="advanced-nav-filters <?php if($_GET[$this->prefix]) echo 'active'; ?>">
				<input type="hidden" name="newsroom_advanced_nav" value="1" />
				<input type="hidden" name="<?php echo $this->prefix; ?>" value="1" />
				<div class="search-input adv-nav-input">
					<p class="label"><label for="<?php echo $this->prefix; ?>s"><?php _e('Text search', 'newsroom'); ?></label></p>
					<input type="text" id="<?php echo $this->prefix; ?>s" name="<?php echo $this->prefix; ?>s" placeholder="<?php _e('Type your search here', 'newsroom'); ?>" value="<?php echo (isset($_GET[$this->prefix . 's'])) ? $_GET[$this->prefix . 's'] : ''; ?>" />
				</div>
				<?php
				$taxonomies = get_taxonomies(array(
					'public' => true,
					'object_type' => array('post')
				));
				foreach($taxonomies as $tax) {
					$this->get_taxonomy_input($tax);
				}
				?>
				<?php
				$oldest = array_shift(get_posts(array('posts_per_page' => 1, 'order' => 'ASC', 'orderby' => 'date')));
				$newest = array_shift(get_posts(array('posts_per_page' => 1, 'order' => 'DESC', 'orderby' => 'date')));

				$before = $oldest->post_date;
				$after = $newest->post_date;
				?>
				<div class="date-input adv-nav-input">
					<p class="label"><label for="<?php echo $this->prefix; ?>date_start"><?php _e('Date range', 'newsroom'); ?></label></p>
					<div class="date-range-inputs">
						<div class="date-from-container">
							<label class="sublabel" for="<?php echo $this->prefix; ?>date_start"><?php _e('From', 'newsroom'); ?></label>
							<input type="text" class="date-from" id="<?php echo $this->prefix; ?>date_start" name="<?php echo $this->prefix; ?>date_start" value="<?php echo (isset($_GET[$this->prefix . 'date_start'])) ? $_GET[$this->prefix . 'date_start'] : ''; ?>" />
						</div>
						<div class="date-to-container">
							<label class="sublabel" for="<?php echo $this->prefix; ?>date_end"><?php _e('To', 'newsroom'); ?></label>
							<input type="text" class="date-to" id="<?php echo $this->prefix; ?>date_end" name="<?php echo $this->prefix; ?>date_end" value="<?php echo (isset($_GET[$this->prefix . 'date_end'])) ? $_GET[$this->prefix . 'date_end'] : ''; ?>" />
						</div>
					</div>
				</div>
				<input type="submit" class="button" value="<?php _e('Filter', 'newsroom'); ?>" />
			</form>
			<script type="text/javascript">
			(function($) {

				$(document).ready(function() {

					var advNav = $('.advanced-nav-filters');

					if(advNav.hasClass('active')) {
						$('.toggle-more-filters a').text('<?php _e('Cancel filters', 'newsroom'); ?>');
					}

					$('.toggle-more-filters a').click(function() {

						if(advNav.hasClass('active')) {
							$(advNav).removeClass('active');
							window.location = '<?php echo remove_query_arg(array($this->prefix, $this->prefix . 's', $this->prefix . 'category', $this->prefix . 'date_start', $this->prefix . 'date_end')); ?>';
							$(this).text('<?php _e('More filters', 'newsroom'); ?>');
						} else {
							$(advNav).addClass('active');
							$(this).text('<?php _e('Cancel filters', 'newsroom'); ?>');
						}

						return false;

					});

					$('.tax-input').each(function() {
						$(this).find('select').chosen();
					});

					var min = moment('<?= $before; ?>').toDate();
					var max = moment('<?= $after; ?>').toDate();

					$('.date-range-inputs .date-from').datepicker({
						defaultDate: min,
						changeMonth: true,
						changeYear: true,
						numberOfMonths: 1,
						maxDate: max,
						minDate: min
					});

					$('.date-range-inputs .date-to').datepicker({
						defaultDate: max,
						changeMonth: true,
						changeYear: true,
						numberOfMonths: 1,
						maxDate: max,
						minDate: min
					});

				});

			})(jQuery);
			</script>
			<?php

		}

	}

	$GLOBALS['newsroom_adv_nav'] = new Newsroom_AdvancedNav();

	function newsroom_adv_nav_filters() {
		return $GLOBALS['newsroom_adv_nav']->form();
	}

	?>
