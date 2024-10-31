<?php
/*
Retrieve Value
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
 * Retrieve attachment ID from media modal
 */
function gf_kgm_notification_attachment_ajax() {
	$attachment_id = sanitize_key( !empty( $_REQUEST['attachment_id'] ) ? $_REQUEST['attachment_id'] : 0 );
	$attachment    = gf_kgm_notification_attachment_get_meta( intval( $attachment_id ) );
	$response      = array(
		'attachment_id' => intval( $attachment_id ),
		'success'       => empty( intval( $attachment ) ) ? false : true,
		'data'          => $attachment
		);
	echo json_encode( $response );
	die;
}