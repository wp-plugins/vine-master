<?php
//Hook Widget
add_action( 'widgets_init', 'vine_master_widget_viral' );
//Register Widget
function vine_master_widget_viral() {
register_widget( 'vine_master_widget_viral' );
}
add_action( 'wp_enqueue_scripts', 'vine_master_wvcss' );
//load css for shortcode
function vine_master_wvcss() {
	wp_register_style( 'vine_master_wvcss', plugins_url('vine-master-style.css', __FILE__) );
	wp_enqueue_style( 'vine_master_wvcss' );
}
class vine_master_widget_viral extends WP_Widget {
	function vine_master_widget_viral() {
	$widget_ops = array( 'classname' => 'Vine Master Viral Buttons', 'description' => __('Advanced Viral Twitter Follow and Tweet buttons to make your website and videos "virulent". Watch those wordpress visits explode!. ', 'vine_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'vine_master_widget_viral' );
	$this->WP_Widget( 'vine_master_widget_viral', __('Vine Master Viral Buttons', 'vine_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Our variables from the widget settings.
		$vine_title = isset( $instance['vine_title'] ) ? $instance['vine_title'] :false;
		$vine_title_new = isset( $instance['vine_title_new'] ) ? $instance['vine_title_new'] :false;
		$vinespacer = "'";
		$show_vine_twitter_button = isset( $instance['show_vine_twitter_button'] ) ? $instance['show_vine_twitter_button'] :false;
		$vine_twitter_user = $instance['vine_twitter_user'];
		echo $before_widget;
		
	// Display the widget title
	if ( $vine_title ){
		if (empty ($vine_title_new)){
		$vine_title_new = get_option('vine_master_name');
		}
		echo $before_title . $vine_title_new . $after_title;
	}
	else{
	}
	//Display Vine Twitter Follow Button
		if ( $show_vine_twitter_button ){
		echo '<div>' .
			'<a href="https://twitter.com/'.$vine_twitter_user.'" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow</a>&nbsp;&nbsp;' .
			'<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'.$vinespacer.'http'.$vinespacer.':'.$vinespacer.'https'.$vinespacer.';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'.$vinespacer.'://platform.twitter.com/widgets.js'.$vinespacer.';fjs.parentNode.insertBefore(js,fjs);}}(document, '.$vinespacer.'script'.$vinespacer.', '.$vinespacer.'twitter-wjs'.$vinespacer.');</script>' .
			'<a href="https://twitter.com/share" class="twitter-share-button" data-via="'.$vine_twitter_user.'">Tweet</a>' .
			'<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'.$vinespacer.'http'.$vinespacer.':'.$vinespacer.'https'.$vinespacer.';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'.$vinespacer.'://platform.twitter.com/widgets.js'.$vinespacer.';fjs.parentNode.insertBefore(js,fjs);}}(document, '.$vinespacer.'script'.$vinespacer.', '.$vinespacer.'twitter-wjs'.$vinespacer.');</script>' .
			'</div>';
		}
		else{
		}
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['vine_title'] = strip_tags( $new_instance['vine_title'] );
		$instance['vine_title_new'] = $new_instance['vine_title_new'];
		$instance['show_vine_twitter_button'] = $new_instance['show_vine_twitter_button'];
		$instance['vine_twitter_user'] = $new_instance['vine_twitter_user'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'vine_title_new' => __('Vine Master', 'vine_master'), 'vine_title' => true, 'vine_title_new' => false, 'show_vine_twitter_button' => false, 'vine_twitter_user' => false, 'show_vine_tweet_button' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<br>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['vine_title'], true ); ?> id="<?php echo $this->get_field_id( 'vine_title' ); ?>" name="<?php echo $this->get_field_name( 'vine_title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'vine_title' ); ?>"><b><?php _e('Display Widget Title', 'vine_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'vine_title_new' ); ?>"><?php _e('Change Title:', 'vine_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'vine_title_new' ); ?>" name="<?php echo $this->get_field_name( 'vine_title_new' ); ?>" value="<?php echo $instance['vine_title_new']; ?>" style="width:auto;" />
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
		<b>Vine Master Website</b>
		</p>
		<p><a class="button-secondary" href="http://wordpress.techgasp.com/vine-master/" target="_blank" title="Vine Master Info Page">Info Page</a> <a class="button-secondary" href="http://wordpress.techgasp.com/vine-master-documentation/" target="_blank" title="Vine Master Documentation">Documentation</a> <a class="button-primary" href="http://wordpress.techgasp.com/vine-master/" target="_blank" title="Visit Website">Get Add-ons</a></p>
	<?php
	}
 }
?>