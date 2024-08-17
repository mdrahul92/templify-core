<?php
/**
 * Add Reminder Notice
 *
 * @package     EDD recurring
 * @copyright   Copyright (c) 2014, Pippin Williamson
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       2.4
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$reminder_type = isset( $_GET['edd_recurring_reminder_type'] ) ? $_GET['edd_recurring_reminder_type'] : 'renewal';

$notices = new EDD_Recurring_Reminders();
?>
<div class="wrap">
	<h1><?php esc_html_e( 'Add Reminder Notice', 'templify-recurring' ); ?></h1>
	<a href="<?php echo esc_url( edd_recurring_get_email_settings_url() ); ?>"><?php esc_html_e( 'Return to Email Settings', 'templify-recurring' ); ?></a>

	<form id="edd-add-reminder-notice" action="" method="post">
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row" valign="top">
					<label for="edd-notice-type"><?php _e( 'Notice Type', 'templify-recurring' ); ?></label>
				</th>
				<td>
					<select name="type" id="edd-notice-type">
						<?php foreach ( $notices->get_notice_types() as $type => $label ) : ?>
							<option value="<?php echo esc_attr( $type ); ?>"<?php selected( $type, $reminder_type ); ?>><?php echo esc_html( $label ); ?></option>
						<?php endforeach; ?>
					</select>

					<p class="description"><?php _e( 'Is this a renewal notice or an expiration notice?', 'templify-recurring' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top">
					<label for="edd-notice-subject"><?php _e( 'Email Subject', 'templify-recurring' ); ?></label>
				</th>
				<td>
					<input name="subject" id="edd-notice-subject" class="edd-notice-subject" type="text" value="" />

					<p class="description"><?php _e( 'The subject line of the reminder notice email', 'templify-recurring' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top">
					<label for="edd-notice-period"><?php _e( 'Email Period', 'templify-recurring' ); ?></label>
				</th>
				<td>
					<select name="period" id="edd-notice-period">
						<?php foreach ( $notices->get_notice_periods() as $period => $label ) : ?>
							<option value="<?php echo esc_attr( $period ); ?>"><?php echo esc_html( $label ); ?></option>
						<?php endforeach; ?>
					</select>

					<p class="description"><?php _e( 'When should this email be sent?', 'templify-recurring' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top">
					<label for="edd-notice-message"><?php _e( 'Email Message', 'templify-recurring' ); ?></label>
				</th>
				<td>
					<?php wp_editor( '', 'message', array( 'textarea_name' => 'message' ) ); ?>
					<p class="description"><?php esc_html_e( 'The email message to be sent with the reminder notice. The following template tags can be used in the message:', 'templify-recurring' ); ?></p>
					<ul>
						<li><code>{name}</code> <?php esc_html_e( 'The customer\'s name', 'templify-recurring' ); ?></li>
						<li><code>{subscription_name}</code> <?php esc_html_e( 'The name of the product the subscription belongs to', 'templify-recurring' ); ?></li>
						<li><code>{expiration}</code> <?php esc_html_e( 'The expiration or renewal date for the subscription', 'templify-recurring' ); ?></li>
						<li><code>{amount}</code> <?php esc_html_e( 'The recurring amount of the subscription', 'templify-recurring' ); ?></li>
						<li><code>{subscription_details}</code> <?php esc_html_e( 'The subscription details', 'templify-recurring' ); ?></li>
						<li><code>{subscription_period}</code> <?php esc_html_e( 'The subscription period', 'templify-recurring' ); ?></li>
					</ul>
				</td>
			</tr>

			</tbody>
		</table>
		<p class="submit">
			<input type="hidden" name="edd-action" value="recurring_add_reminder_notice" />
			<input type="hidden" name="edd-recurring-reminder-notice-nonce" value="<?php echo wp_create_nonce( 'edd_recurring_reminder_nonce' ); ?>" />
			<input type="submit" value="<?php _e( 'Add Reminder Notice', 'templify-recurring' ); ?>" class="button-primary" />
		</p>
	</form>
</div>
