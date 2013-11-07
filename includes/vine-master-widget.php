<?php
//Hook Widget
add_action( 'widgets_init', 'vine_master_widget' );
//Register Widget
function vine_master_widget() {
register_widget( 'vine_master_widget' );
}

class vine_master_widget extends WP_Widget {
	function vine_master_widget() {
	$widget_ops = array( 'classname' => 'Vine Master', 'description' => __('Vine Master for let\'s you integrate the exciting twitter Vine Videos into any Wordpress widget position, page or post. Bombastic. ', 'Vine Master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'vine_master_widget' );
	$this->WP_Widget( 'vine_master_widget', __('Vine Master', 'vine_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Our variables from the widget settings.
		$name = "Vine Master";
		$title = isset( $instance['title'] ) ? $instance['title'] :false;
		$vinespacer = "'";
		$show_vine_twitter_button = isset( $instance['show_vine_twitter_button'] ) ? $instance['show_vine_twitter_button'] :false;
		$vine_twitter_user = $instance['vine_twitter_user'];
		echo $before_widget;
		
	// Display the widget title
		if ( $title )
		echo $before_title . $name . $after_title;
	//Display Vine Player

	//Display Vine Twitter Follow Button
		if ( $show_vine_twitter_button )
		echo '<br><a href="https://twitter.com/'.$vine_twitter_user.'" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow</a>&nbsp;&nbsp;' .
			'<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'.$vinespacer.'http'.$vinespacer.':'.$vinespacer.'https'.$vinespacer.';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'.$vinespacer.'://platform.twitter.com/widgets.js'.$vinespacer.';fjs.parentNode.insertBefore(js,fjs);}}(document, '.$vinespacer.'script'.$vinespacer.', '.$vinespacer.'twitter-wjs'.$vinespacer.');</script>' .
			'<a href="https://twitter.com/share" class="twitter-share-button" data-via="'.$vine_twitter_user.'">Tweet</a>' .
			'<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'.$vinespacer.'http'.$vinespacer.':'.$vinespacer.'https'.$vinespacer.';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'.$vinespacer.'://platform.twitter.com/widgets.js'.$vinespacer.';fjs.parentNode.insertBefore(js,fjs);}}(document, '.$vinespacer.'script'.$vinespacer.', '.$vinespacer.'twitter-wjs'.$vinespacer.');</script>';
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_vine_twitter_button'] = $new_instance['show_vine_twitter_button'];
		$instance['vine_twitter_user'] = $new_instance['vine_twitter_user'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'name' => __('Vine Master', 'vine_master'), 'title' => true, 'show_vine_twitter_button' => false, 'vine_twitter_user' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'vine_master'); ?></b></label></br>
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_vine_twitter_button'], true ); ?> id="<?php echo $this->get_field_id( 'show_vine_twitter_button' ); ?>" name="<?php echo $this->get_field_name( 'show_vine_twitter_button' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_vine_twitter_button' ); ?>"><b><?php _e('Show Twitter Buttons', 'vine_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'vine_twitter_user' ); ?>"><?php _e('insert your Twitter Username:', 'vine_master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'vine_twitter_user' ); ?>" name="<?php echo $this->get_field_name( 'vine_twitter_user' ); ?>" value="<?php echo $instance['vine_twitter_user']; ?>" style="width:auto;" />
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Show Vine Player</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Vine Player Display Type</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Vine Player Size</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
		<p>
		<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
		&nbsp;
		<b>Vine Master Website</b>
		</p>
		<p><a class="button-secondary" href="http://wordpress.techgasp.com/vine-master/" target="_blank" title="Vine Master Info Page">Info Page</a> <a class="button-secondary" href="http://wordpress.techgasp.com/vine-master-documentation/" target="_blank" title="Vine Master Documentation">Documentation</a> <a class="button-primary" href="http://wordpress.techgasp.com/vine-master/" target="_blank" title="Vine Master">Advanced Version</a></p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
		<p>
		<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
		&nbsp;
		<b>Advanced Version Updater:</b>
		</p>
		<div class="description">The advanced version updater allows to automatically update your advanced plugin. Only available in advanced version.</div>
	<?php
	}
 }
?>