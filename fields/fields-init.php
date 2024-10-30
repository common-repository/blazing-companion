<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}


function apollothemes_fields_register($wp_customize) {

	require_once trailingslashit(BLAZING_COMPANION_DIR) . 'fields/sortable/class/class-apollothemes-field-sortable.php';
	require_once trailingslashit(BLAZING_COMPANION_DIR) . 'fields/repeater/class/class-apollothemes-field-repeater.php';
}

add_action('customize_register', 'apollothemes_fields_register');

if(!function_exists('apollothemes_field_repeater_sanitize')){
	function apollothemes_field_repeater_sanitize($input){
		$input_decoded = json_decode($input, true);
		
		if(!empty($input_decoded)) {
			foreach ($input_decoded as $boxk => $box ){
				foreach ($box as $key => $value){
						if(is_array($value)){
							foreach ($value as $skey => $svalue) {
								foreach ($svalue as $sikey => $sivalue) {
									$input_decoded[$boxk][$key][$skey][$sikey] = wp_kses_post( force_balance_tags( $sivalue ) );
								}
							}
						}else{
							$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
						}

				}
			}
			return json_encode($input_decoded);
		}
		return;
	}
}

if(!function_exists('apollothemes_field_sortable_sanitize')){
	function apollothemes_field_sortable_sanitize($input){
		$input_decoded = json_decode($input, true);
		$output = array();
		if(is_array($input_decoded) && !empty($input_decoded)){
			foreach ($input_decoded as $key => $value) {
				$output[] = sanitize_text_field($value);
			}
			return json_encode($output);
		}
		return;
	}
}