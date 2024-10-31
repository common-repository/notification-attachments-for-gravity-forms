<?php
/*
Send Functions
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
 * Send attachment with Gravity Froms Notification
 */
function gf_kgm_notification_attachment_send( $notification, $form, $lead ) {
	$attachment_ids = explode( ',',rgar( $notification, 'attachment_id' ) );
	$wp_upload_dir  = wp_upload_dir();
	if( !empty( $attachment_ids ) ) {
		foreach( $attachment_ids as $attachment_id ){
			$attachment = wp_get_attachment_url( $attachment_id );
			if( !empty( $attachment ) ){
				// Filter for upload dir by @effakt
				$path = str_replace( $wp_upload_dir['baseurl'], $wp_upload_dir['basedir'], $attachment );
				$path = apply_filters( 'gf_kgm_notification_attachment_path', $path, $attachment_id, $form, $lead );
				if ( $path ) {
					$notification['attachments'][] = $path;
				}
			}
		}
	}
	return $notification;
}