<?php
/*
Security function for help no dequeue if Gravity Forms setting remove third part script
Plugin: Notification Attachments for Gravity Forms
Since: 0.1
Author: KGM Servizi
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function gf_kgm_notification_attachment_gform_noconflict( $allowed_script_keys ) {
	global $gf_kgm_notification_attachment;
	$plugin                = $gf_kgm_notification_attachment;
	$allowed_script_keys[] = $plugin->text_domain;
	return $allowed_script_keys;
}