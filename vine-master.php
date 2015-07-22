<?php
/**
Plugin Name: Vine Master
Plugin URI: http://wordpress.techgasp.com/vine-master/
Version: 4.4.2.0
Author: TechGasp
Author URI: http://wordpress.techgasp.com
Text Domain: vine-master
Description: Vine Master for let's you integrate the exciting Vine Videos into any Wordpress widget position, page or post. Only for professional websites.
License: GPL2 or later
*/
/*
Copyright 2013 TechGasp  (email : info@techgasp.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('vine_master')) :
///////DEFINE VERSION///////
define( 'VINE_MASTER_VERSION', '4.4.2.0' );

global $vine_master_version, $vine_master_name;
$vine_master_version = "4.4.2.0"; //for other pages
$vine_master_name = "Vine Master"; //pretty name
if( is_multisite() ) {
update_site_option( 'vine_master_installed_version', $vine_master_version );
update_site_option( 'vine_master_name', $vine_master_name );
}
else{
update_option( 'vine_master_installed_version', $vine_master_version );
update_option( 'vine_master_name', $vine_master_name );
}

class vine_master{
public static function content_with_quote($content){
$quote = '<p>' . get_option('tsm_quote') . '</p>';
	return $content . $quote;
}
//SETTINGS LINK IN PLUGIN MANAGER
public static function vine_master_links( $links, $file ) {
if ( $file == plugin_basename( dirname(__FILE__).'/vine-master.php' ) ) {
		if( is_network_admin() ){
		$techgasp_plugin_url = network_admin_url( 'admin.php?page=vine-master' );
		}
		else {
		$techgasp_plugin_url = admin_url( 'admin.php?page=vine-master' );
		}
	$links[] = '<a href="' . $techgasp_plugin_url . '">'.__( 'Settings' ).'</a>';
	}
	return $links;
}

//END CLASS
}
add_filter('the_content', array('vine_master', 'content_with_quote'));
add_filter( 'plugin_action_links', array('vine_master', 'vine_master_links'), 10, 2 );
endif;

// HOOK ADMIN
require_once( dirname( __FILE__ ) . '/includes/vine-master-admin.php');
// HOOK ADMIN ADDONS
require_once( dirname( __FILE__ ) . '/includes/vine-master-admin-addons.php');
// HOOK ADMIN WIDGETS
require_once( dirname( __FILE__ ) . '/includes/vine-master-admin-widgets.php');
// HOOK WIDGET VIRAL
require_once( dirname( __FILE__ ) . '/includes/vine-master-widget-viral.php');