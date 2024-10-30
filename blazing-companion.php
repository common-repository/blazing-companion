<?php
/*
Plugin Name: Blazing Companion
Description: Companion for Blazing WordPress Theme. this plugin is to extend functionality of Blazing theme.
Author: ApolloThemes
Author URI: https://www.apollothemes.com/
Domain Path: /lang/
Version: 1.1
Text Domain: blazing-companion

Blazing Companion is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Blazing Companion is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Blazing Companion. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}


define('BLAZING_COMPANION_DIR', plugin_dir_path(__FILE__));
define('BLAZING_COMPANION_URI', plugin_dir_url(__FILE__));
define('BLAZING_COMPANION_VAR', '1.0');

if(!function_exists('apollothemes_fields_register')){
	require_once trailingslashit(BLAZING_COMPANION_DIR) . 'fields/fields-init.php';
}

if (!function_exists('blazing_companion')) {
	function blazing_companion() {

	}
}

function blazing_companion_init() {
	load_plugin_textdomain('blazing-companion', false, dirname(plugin_basename(__FILE__)) . '/languages');

}
add_action('plugins_loaded', 'blazing_companion_init');

function blazing_companion_customize_register($wp_customize) {

	/*Panels Start*/
	$wp_customize->add_panel('blazing_homepage', array(
		'priority' => 2,
		'title'    => esc_html__('Homepage Options', 'blazing-companion'),
	));
	/*Panel End*/

/* Sections Start */

	$wp_customize->add_section('blazing_home_layout_section', array(
		'title'      => esc_html__('Home Section Manager', 'blazing-companion'),
		'panel'      => 'blazing_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 10,
	));

	$wp_customize->add_section('blazing_home_slider_section', array(
		'title'      => esc_html__('Slider', 'blazing-companion'),
		'panel'      => 'blazing_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 10,
	));


	

	$wp_customize->add_section('blazing_home_about_section', array(
		'title'      => esc_html__('About', 'blazing-companion'),
		'panel'      => 'blazing_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 40,
	));

	
	$wp_customize->add_section('blazing_home_blog_section', array(
		'title'      => esc_html__('Blog', 'blazing-companion'),
		'panel'      => 'blazing_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 50,
	));

	$wp_customize->add_section('blazing_home_services_section', array(
		'title'      => esc_html__('Services', 'blazing-companion'),
		'panel'      => 'blazing_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 60,
	));

	$wp_customize->add_section('blazing_home_testimonials_section', array(
		'title'      => esc_html__('Testimonials', 'blazing-companion'),
		'panel'      => 'blazing_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 70,
	));

	$wp_customize->add_section('blazing_home_brands_section', array(
		'title'      => esc_html__('Brands', 'blazing-companion'),
		'panel'      => 'blazing_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 80,
	));

	$wp_customize->add_section('blazing_socials_section', array(
		'title'      => esc_html__('Social Links', 'blazing-companion'),
		'capability' => 'edit_theme_options',
		'priority'   => 20,
	));


		

/* Sections End */

/*home layout*/
	$wp_customize->add_setting('blazing_home_layout', array(
		'sanitize_callback' => 'apollothemes_field_sortable_sanitize',
		'default'           => json_encode(array('slider', 'hero', 'newproducts', 'about', 'services', 'blog', 'testimonials', 'brands')),
	));

	$wp_customize->add_control(new Apollothemes_Field_Sortable($wp_customize, 'blazing_home_layout', array(
		'label'    => esc_html__('Home Page Layout', 'blazing-companion'),
		'priority' => 30,
		'section'  => 'blazing_home_layout_section',
		'choices'  => array(
			'about'              => esc_html__('About', 'blazing-companion'),
			'blog'               => esc_html__('Blog', 'blazing-companion'),
			'brands'             => esc_html__('Brands', 'blazing-companion'),
			'hero'               => esc_html__('Hero Image', 'blazing-companion'),
			'newproducts'    	 => esc_html__('Latest Products', 'blazing-companion'),
			'services'           => esc_html__('Services', 'blazing-companion'),
			'slider'             => esc_html__('Slider', 'blazing-companion'),
			'testimonials'       => esc_html__('Testimonials', 'blazing-companion'),
		),
	)));

/*home layout*/

/*Slider start*/

	$wp_customize->add_setting('blazing_home_slider', array(
		'sanitize_callback' => 'apollothemes_field_repeater_sanitize',
		'default'           => json_encode(array(
			array(
				'heading'      => esc_attr__('Summer Shoping sale', 'blazing-companion'),
				'description'  => esc_attr__('MAXIMUM DISCOUNT AVAILABLE', 'blazing-companion'),
				'image'        => get_template_directory_uri() . '/images/slide1.jpg',
				'button1_text' => esc_attr__('View Details', 'blazing-companion'),
				'button1_url'  => '#',
				'button2_text' => esc_attr__('Buy Now', 'blazing-companion'),
				'button2_url'  => '#',
			),
			array(
				'heading'      => esc_attr__('Summer Shoping sale', 'blazing-companion'),
				'description'  => esc_attr__('MAXIMUM DISCOUNT AVAILABLE', 'blazing-companion'),
				'image'        => get_template_directory_uri() . '/images/slide2.jpg',
				'button1_text' => esc_attr__('View Details', 'blazing-companion'),
				'button1_url'  => '#',
				'button2_text' => esc_attr__('Buy Now', 'blazing-companion'),
				'button2_url'  => '#',
			),
			array(
				'heading'      => esc_attr__('Summer Shoping sale', 'blazing-companion'),
				'description'  => esc_attr__('MAXIMUM DISCOUNT AVAILABLE', 'blazing-companion'),
				'image'        => get_template_directory_uri() . '/images/slide3.jpg',
				'button1_text' => esc_attr__('View Details', 'blazing-companion'),
				'button1_url'  => '#',
				'button2_text' => esc_attr__('Buy Now', 'blazing-companion'),
				'button2_url'  => '#',
			),
			array(
				'heading'      => esc_attr__('Summer Shoping sale', 'blazing-companion'),
				'description'  => esc_attr__('MAXIMUM DISCOUNT AVAILABLE', 'blazing-companion'),
				'image'        => get_template_directory_uri() . '/images/slide4.jpg',
				'button1_text' => esc_attr__('View Details', 'blazing-companion'),
				'button1_url'  => '#',
				'button2_text' => esc_attr__('Buy Now', 'blazing-companion'),
				'button2_url'  => '#',
			)
		)),
	));

	$wp_customize->add_control(new Apollothemes_Field_Repeater($wp_customize, 'blazing_home_slider', array(
		'label'     => esc_html__('Slide', 'blazing-companion'),
		'section'   => 'blazing_home_slider_section',
		'priority'  => 30,
		'row_label' => esc_html__('Slide', 'blazing-companion'),
		'fields'    => array(
			'heading'      => array(
				'type'    => 'text',
				'label'   => esc_attr__('Title', 'blazing-companion'),
				'default' => esc_attr('Slide Heading', 'blazing-companion'),
			),
			'description'  => array(
				'type'    => 'textarea',
				'label'   => esc_attr__('Description', 'blazing-companion'),
				'default' => esc_attr('Awesome Slide Description', 'blazing-companion'),
			),
			'image'        => array(
				'type'    => 'image',
				'label'   => esc_attr__('Image', 'blazing-companion'),
				'default' => esc_url(get_template_directory_uri() . '/images/slide1.jpg'),
			),
			'button1_text' => array(
				'type'    => 'text',
				'label'   => esc_attr__('Button Text', 'blazing-companion'),
				'default' => esc_attr__('Read More', 'blazing-companion'),
			),
			'button1_url'  => array(
				'type'    => 'text',
				'label'   => esc_attr__('Button URL', 'blazing-companion'),
				'default' => esc_url('#'),
			),
			'button2_text' => array(
				'type'    => 'text',
				'label'   => esc_attr__('Button Text', 'blazing-companion'),
				'default' => esc_attr__('Buy Now', 'blazing-companion'),
			),
			'button2_url'  => array(
				'type'    => 'text',
				'label'   => esc_attr__('Button URL', 'blazing-companion'),
				'default' => esc_url('#'),
			),

		),
	)));

/*Slider end*/

/*Services start*/

	$wp_customize->add_setting('blazing_home_services_heading', array(
		'default'           => esc_html__('Services', 'blazing-companion'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('blazing_home_services_heading', array(
		'type'    => 'text',
		'label'   => esc_html__('Heading', 'blazing-companion'),
		'section' => 'blazing_home_services_section',
	));

	$wp_customize->add_setting('blazing_home_services_desc', array(
		'default'           => esc_html__('Services Description', 'blazing-companion'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('blazing_home_services_desc', array(
		'type'    => 'textarea',
		'label'   => esc_html__('Description', 'blazing-companion'),
		'section' => 'blazing_home_services_section',
	));

	$wp_customize->add_setting('blazing_home_services', array(
		'sanitize_callback' => 'apollothemes_field_repeater_sanitize',
		'default'           => json_encode(array(
			array(
				'heading'     => esc_attr__('Awesome Service', 'blazing-companion'),
				'description' => esc_attr__('Awesome Service Description', 'blazing-companion'),
				'icon'        => 'fa-flash',
			),
			array(
				'heading'     => esc_attr__('Awesome Service', 'blazing-companion'),
				'description' => esc_attr__('Awesome Service Description', 'blazing-companion'),
				'icon'        => 'fa-star',
			),
			array(
				'heading'     => esc_attr__('Awesome Service', 'blazing-companion'),
				'description' => esc_attr__('Awesome Service Description', 'blazing-companion'),
				'icon'        => 'fa-star',
			),
		)),
	));

	$wp_customize->add_control(new Apollothemes_Field_Repeater($wp_customize, 'blazing_home_services', array(
		'label'     => esc_html__('Servces', 'blazing-companion'),
		'section'   => 'blazing_home_services_section',
		'priority'  => 30,
		'row_label' => esc_html__('Service', 'blazing-companion'),
		'fields'    => array(
			'heading'     => array(
				'type'    => 'text',
				'label'   => esc_attr__('Title', 'blazing-companion'),
				'default' => esc_attr('Service Heading', 'blazing-companion'),
			),
			'description' => array(
				'type'    => 'textarea',
				'label'   => esc_attr__('Description', 'blazing-companion'),
				'default' => esc_attr('Service Description', 'blazing-companion'),
			),
			'icon'        => array(
				'type'    => 'icon',
				'label'   => esc_attr__('Icon', 'blazing-companion'),
				'default' => 'fa-star',
			),
		),
	)));
/*Services end*/


/*About start*/
	$wp_customize->add_setting('blazing_home_about_heading', array(
		'default'           => esc_html__('About Us', 'blazing-companion'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('blazing_home_about_heading', array(
		'type'    => 'text',
		'label'   => esc_html__('Heading', 'blazing-companion'),
		'section' => 'blazing_home_about_section',
	));

	$wp_customize->add_setting('blazing_home_about_desc', array(
		'default'           => esc_html__('About Us Description', 'blazing-companion'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('blazing_home_about_desc', array(
		'type'    => 'textarea',
		'label'   => esc_html__('Description', 'blazing-companion'),
		'section' => 'blazing_home_about_section',
	));

	$wp_customize->add_setting('blazing_home_about_image', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'blazing_home_about_image', array(
		'label'   => esc_html__('Image', 'blazing-companion'),
		'section' => 'blazing_home_about_section',
	)));
/*About end*/


/*Testimonials start*/

	$wp_customize->add_setting('blazing_home_testimonials_heading', array(
		'default'           => esc_html__('Testimonials', 'blazing-companion'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('blazing_home_testimonials_heading', array(
		'type'    => 'text',
		'label'   => esc_html__('Heading', 'blazing-companion'),
		'section' => 'blazing_home_testimonials_section',
	));

	$wp_customize->add_setting('blazing_home_testimonials_desc', array(
		'default'           => esc_html__('Testimonials Description', 'blazing-companion'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('blazing_home_testimonials_desc', array(
		'type'    => 'textarea',
		'label'   => esc_html__('Description', 'blazing-companion'),
		'section' => 'blazing_home_testimonials_section',
	));

	$wp_customize->add_setting('blazing_home_testimonials', array(
		'sanitize_callback' => 'apollothemes_field_repeater_sanitize',
		'default'           => json_encode(array(
			array(
				'heading'     => esc_attr__('Testimonial Heading', 'blazing-companion'),
				'description' => esc_attr__('Testimonial Description', 'blazing-companion'),
				'image'       => get_template_directory_uri() . '/images/slide1.jpg',
				'web_name'    => esc_attr__('example.com', 'blazing-companion'),
				'web_link'    => '#example.com',
			),
			array(
				'heading'     => esc_attr__('Testimonial Heading', 'blazing-companion'),
				'description' => esc_attr__('Testimonial Description', 'blazing-companion'),
				'image'       => get_template_directory_uri() . '/images/slide2.jpg',
				'web_name'    => esc_attr__('example.com', 'blazing-companion'),
				'web_link'    => '#example.com',
			),
		)),
	));

	$wp_customize->add_control(new Apollothemes_Field_Repeater($wp_customize, 'blazing_home_testimonials', array(
		'label'     => esc_html__('Testimonials', 'blazing-companion'),
		'section'   => 'blazing_home_testimonials_section',
		'priority'  => 30,
		'row_label' => esc_html__('Testimonial', 'blazing-companion'),
		'fields'    => array(
			'heading'     => array(
				'type'              => 'text',
				'label'             => esc_attr__('Title', 'blazing-companion'),
				'default'           => esc_attr('Awesome Slide Heading', 'blazing-companion'),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'description' => array(
				'type'              => 'textarea',
				'label'             => esc_attr__('Description', 'blazing-companion'),
				'default'           => esc_attr('Awesome Slide Description', 'blazing-companion'),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'image'       => array(
				'type'    => 'image',
				'label'   => esc_attr__('Image', 'blazing-companion'),
				'default' => esc_url(get_template_directory_uri() . '/images/slide1.jpg'),
			),
		),
	)));
/*Testimonials end*/



/*Brands start*/
	$wp_customize->add_setting('blazing_home_brands_heading', array(
		'default'           => esc_html__('Brands', 'blazing-companion'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('blazing_home_brands_heading', array(
		'type'    => 'text',
		'label'   => esc_html__('Heading', 'blazing-companion'),
		'section' => 'blazing_home_brands_section',
	));

	$wp_customize->add_setting('blazing_home_brands_desc', array(
		'default'           => esc_html__('Brands Description', 'blazing-companion'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('blazing_home_brands_desc', array(
		'type'    => 'textarea',
		'label'   => esc_html__('Description', 'blazing-companion'),
		'section' => 'blazing_home_brands_section',
	));

	$wp_customize->add_setting('blazing_home_brands', array(
		'sanitize_callback' => 'apollothemes_field_repeater_sanitize',
		'default'           => json_encode(array(
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand1.png',
			),
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand2.png',
			),
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand3.png',
			),
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand4.png',
			),
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand5.png',
			),
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand6.png',
			),
		)),
	));

	$wp_customize->add_control(new Apollothemes_Field_Repeater($wp_customize, 'blazing_home_brands', array(
		'label'     => esc_html__('Brands', 'blazing-companion'),
		'section'   => 'blazing_home_brands_section',
		'priority'  => 30,
		'row_label' => esc_html__('Brand', 'blazing-companion'),
		'fields'    => array(
			'image'      => array(
				'type'  => 'image',
				'label' => esc_attr__('Image', 'blazing-companion'),
			),
			'brand_link' => array(
				'type'  => 'text',
				'label' => esc_attr__('Brand URL', 'blazing-companion'),
			),
		),
	)));
/*Brands end*/


/*Social Links*/
	$wp_customize->add_setting('blazing_socials', array(
		'sanitize_callback' => 'apollothemes_field_repeater_sanitize',
		'default'           => json_encode(array(
			array(
				'icon'        => 'fa-facebook',
				'link'        => '#',
			),
			array(
				'icon'        => 'fa-youtube',
				'link'        => '#',
			),
			array(
				'icon'        => 'fa-instagram',
				'link'        => '#',
			),
			array(
				'icon'        => 'fa-google-plus',
				'link'        => '#',
			),
			array(
				'icon'        => 'fa-linkedin',
				'link'        => '#',
			),
		)),
	));

	$wp_customize->add_control(new Apollothemes_Field_Repeater($wp_customize, 'blazing_socials', array(
		'label'     => esc_html__('Social Links', 'blazing-companion'),
		'section'   => 'blazing_socials_section',
		'priority'  => 30,
		'row_label' => esc_html__('Social Site', 'blazing-companion'),
		'fields'    => array(
			'icon'        => array(
				'type'    => 'icon',
				'label'   => esc_attr__('Icon', 'blazing-companion'),
				'default' => 'fa-star',
			),
			'link'     => array(
				'type'    => 'text',
				'label'   => esc_attr__('Social Link', 'blazing-companion'),
			),
		),
	)));
/*social Links*/

}

add_action('customize_register', 'blazing_companion_customize_register');

register_activation_hook(__FILE__, 'blazing_companion_activation');
function blazing_companion_activation() {
	flush_rewrite_rules();
}
