<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
    <div>
    	<input type="text" name="s" id="s" placeholder="<?php _e('Search here...', 'newsroom'); ?>" value="<?php echo isset($_GET['s']) ? $_GET['s'] : ''; ?>" />
    </div>
</form>
