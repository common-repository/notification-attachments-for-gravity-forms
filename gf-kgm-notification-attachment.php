<?php
/* 
Plugin Name: Notification Attachments for Gravity Forms
Version: 0.5.6
Description: Send attachment in Gravity Forms Notification
Author: KGM Servizi
Author URI: https://kgmservizi.com
License: GPLv2 or later
Text Domain: gf-kgm-notification-attachment
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $gf_kgm_notification_attachment;
add_action( 'init', 'gf_kgm_notification_attachment_init' );

/**
 * Init
 */
function gf_kgm_notification_attachment_init() {
	global $gf_kgm_notification_attachment;

	if ( class_exists( 'GFForms' ) ) {
		add_filter( 'gform_notification', 'gf_kgm_notification_attachment_send', 10, 3 );		
		add_action( 'admin_enqueue_scripts', 'gf_kgm_notification_attachment_attach_script');
		add_filter( 'gform_pre_notification_save', 'gf_kgm_notification_attachment_save', 10, 2 );
		add_filter( 'gform_noconflict_scripts', 'gf_kgm_notification_attachment_gform_noconflict' );
		add_filter( 'gform_notification_settings_fields', 'gf_kgm_notification_attachment_editor', 10, 3 );
		
		$gf_kgm_notification_attachment = (object) array(
			'text_domain' => 'gf-kgm-notification-attachment',
			'version'     => '0.5.6',
			'plugin_url'  => trailingslashit( plugin_dir_url( __FILE__ ) )
			);
		return $gf_kgm_notification_attachment;
	} else {
		add_action( 'admin_notices', 'gf_kgm_notification_attachment_admin_notices' );
	}
}

include( plugin_dir_path( __FILE__ ) . 'includes/form.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/save.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/send.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/enqueue.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/security.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/notification.php' );
