<?php
/*
Enqueue style and script
Plugin: Notification Attachments for Gravity Forms
Since: 0.1
Author: KGM Servizi
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function gf_kgm_notification_attachment_attach_script() {
	global $gf_kgm_notification_attachment;
	$plugin = $gf_kgm_notification_attachment;

	if ( class_exists( 'GFForms' ) ) {
		if ( GFForms::get_page() == 'notification_edit' ) {
			wp_enqueue_script( $plugin->text_domain, $plugin->plugin_url . '/assets/script.js', array( 'gform_gravityforms' ), $plugin->version, true );	
		}
	}
}