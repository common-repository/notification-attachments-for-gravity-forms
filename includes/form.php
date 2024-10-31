<?php
/*
Form inside Gravity Forms Notification setting structure and function
Plugin: Notification attachment_ids for Gravity Forms
Since: 0.1
Author: KGM Servizi
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Code for form inside Gravity Forms Notification setting (edited for Gravity Forms 2.5 -> https://docs.gravityforms.com/gform_notification_settings_fields/)
 */
function gf_kgm_notification_attachment_editor( $fields, $notification, $form ) {
	
	if ( !isset( $_POST['gf_kgm_notification_attachment_id'] ) ) {
		$attachment_ids = explode( ',', rgar( $notification, 'attachment_id' ) );
		$attachment_ids_raw = rgar( $notification, 'attachment_id' );
	} else {
		$attachment_ids = explode( ',', $_POST['gf_kgm_notification_attachment_id'] );
		$attachment_ids_raw = sanitize_text_field( $_POST['gf_kgm_notification_attachment_id'] );
	}

	if ( !is_array( $attachment_ids ) && !empty( $attachment_ids ) ) {
		$attachment_ids = array($attachment_ids);
	}

	$attachments = '';
	if ( $attachment_ids ) {
		$attachments .= '<div id="gf_kgm_notification_attachment_li"><ul class="details">';
		if ( $attachment_ids[0] != '' ) {
			foreach ( $attachment_ids as $attachment_id ) {
				$attachment = gf_kgm_notification_attachment_get_meta($attachment_id);
				$attachments .= '<li data-id="'.$attachment_id.'"><img src="'. $attachment->mime_file .'" style="max-width:150px;" /></br>'.$attachment->title.' <b>['.$attachment->mime.']</b><div class="remove dashicons dashicons-dismiss" onClick="kgm_remove_attachment(this)"></div></li>';
			}
		}
		$attachments .= '</ul></div>';
	}

	$attachments .='<div id="gf_kgm_notification_attachment_input"><input type="hidden" name="gf_kgm_notification_attachment_id" id="attachment_ids" value="' . $attachment_ids_raw . '" />
            	<a href="#" class="button add gf_kgm_notification_attachment" onClick="kgm_add_attachment()" title="' . __('Add Attachment', 'gf-notification-attachment') . '">
            		' . __('Add Attachment', 'gf-notification-attachment') . '</a></div>';

	$fields[] = array(
		'title'  => esc_html__( 'Attachments', 'gf-notification-attachment' ),
		'fields' => array(
			array(
				'name' => 'Attachments',
				'type' => 'html',
				'html' => $attachments,
			),
		),
	);

	return $fields;
}

/**
 * Retrieve attachment value for form
 * @param $attachment_id -> id of attachment from db
 */
function gf_kgm_notification_attachment_get_meta( $attachment_id ) {

	$attachment = get_post($attachment_id);
	$image      = wp_get_attachment_image_src($attachment_id, array(150,150), true); 
	$image      = !empty($image) ? $image[0] : null;

	if ( is_null( $image ) ) {
		$image = wp_mime_type_icon($attachment->post_mime_type);
	}

	return (object) apply_filters('gf_kgm_notification_attachment_get_meta', array(
			'id'        => $attachment_id,
			'mime_file' => $image,
			'mime'      => $attachment->post_mime_type,
			'title'     => $attachment->post_title
		), $attachment_id, $attachment);
}