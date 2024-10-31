<?php
/*
Save in registration functions
Plugin: Notification Attachments for Gravity Forms
Since: 0.1
Author: KGM Servizi
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Retrieve attachment ID for save in Gravity Forms registration
 */
function gf_kgm_notification_attachment_save( $notification, $form ) {
	$notification['attachment_id'] = rgpost( 'gf_kgm_notification_attachment_id' );
	return $notification;
}