<?php
/*
Notification
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
 * For no Gravity Forms plugin installed or enabled
 */
function gf_kgm_notification_attachment_admin_notices() {
    echo '<div class="error"><p>' . __( "You must have Gravity Forms activated in order to use Notification Attachments for Gravity Forms.", "gf_kgm_notification_attachment" ) . '</p></div>';
}