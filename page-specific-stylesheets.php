<?php
/**
 * Plugin Name: Page Specific Stylesheets
 * Description: Allows a simple method of keeping your styles.css file nice and clean by allowing page-specific CSS to be managed within that page. When the page is deleted, so is its CSS.
 * Version: 1.2.2
 * Date: 24 May 2014
 * Author: Tyler Shaw
**/

define('PSS', true);

// Admin specific code.
if(is_admin()) {
	
	function pss_init() {
		register_setting('pss_plugin_options', 'pss_options');
	}
	add_action('admin_init', 'pss_init');
	
	function pss_add_options_page() {
		add_options_page('Page Specific Stylesheets Settings', 'Page Specific Stylesheets', 'manage_options', __FILE__, 'pss_render_form');
	}
	add_action('admin_menu', 'pss_add_options_page');
	
	// Add a link to plugin settings on the plugins page, next to the activate and edit links.
	function pss_plugin_action_links($links, $file) {
		if ($file == plugin_basename(__FILE__)) {
			$pss_links = '<a href="'.get_admin_url() . 'options-general.php?page=page-specific-stylesheets/page-specific-stylesheets.php">' . 'Settings' . '</a>';
			// make the 'Settings' link appear first
			array_unshift($links, $pss_links);
		}
		return $links;
	}
	add_filter('plugin_action_links', 'pss_plugin_action_links', 10, 2);

	function pss_render_form() {
		include __DIR__ . '/templates/settings.php';
	}
	
	// Set up default plugin options.
	function pss_default_options() {
		
		$pss_options = get_option('pss_options');
		
		if($pss_options === false) {
			
			$defaults = array(
				'post_types' => array(
					'page' => 'on',
					'post' => 'on'
				)
			);
			
			update_option('pss_options', $defaults);
		}
		
	}
	register_activation_hook(__FILE__, 'pss_default_options');
	
	function pss_delete_plugin_cleanup() {
		
		$options = get_option('pss_options');
		
		// Clean out styles if that option is checked.
		if(isset($options['delete_styles_on_uninstall'])) {
			delete_post_meta_by_key('pss_style');
		}
		
		// Clean out options if that option is checked.
		if(isset($options['delete_options_on_uninstall'])) {
			delete_option('pss_options');
		}
		
	}
	register_uninstall_hook(__FILE__, 'pss_delete_plugin_cleanup');
	
	// Define the function responsible for adding the stylesheet boxes.
	function pss_add_meta_boxes() {
		$options = get_option('pss_options');
		
		if(!empty($options['post_types'])) {
			foreach($options['post_types'] as $key => $value) {
				add_meta_box( 
					'pss_style_box',
					'Page Specific Stylesheet',
					'pss_render_meta_box_content',
					$key,
					'advanced',
					'high'
				);
			}
		}
    }
	
	// Define the function responsible for displaying the stylesheet boxes.
	function pss_render_meta_box_content() {
		global $post;
    	include __DIR__ . '/templates/meta-box.php';
    }
	
	// Set up the action to create the stylesheet boxes.
	add_action('add_meta_boxes', 'pss_add_meta_boxes');
	
	function pss_update_stylesheet($post_id) {
		global $post;
		if(isset($_POST['pss_textarea'])) {
			if(!empty($_POST['pss_textarea'])) {
				update_post_meta($post->ID, 'pss_style', $_POST['pss_textarea']);
			}
			else {
				delete_post_meta($post->ID, 'pss_style');
			}
		}
	}
	add_action('save_post', 'pss_update_stylesheet');
	
	
	function pss_clean_deleted_post_meta($post_id) {
		delete_post_meta($post_id, 'pss_style');
	}
	add_action('delete_post', 'pss_clean_deleted_post_meta');
	
	
	// Include our CodeMirror files.
	// This should not occur if CodeMirror is disabled by the filter.
	function pss_add_cm_files() {
		
		$fancy_editor = apply_filters('pss_fancy_editor', false);
		
		if($fancy_editor === true) {
		
			wp_enqueue_script('pss_codemirror', plugins_url('codemirror/codemirror-compressed.js', __FILE__));
			
			wp_enqueue_script('pss_cm_setup', plugins_url('js/setup.js', __FILE__), array('jquery', 'pss_codemirror'));
			
			wp_enqueue_style('pss_codemirror_css', plugins_url('codemirror/codemirror.css', __FILE__));
			
			wp_enqueue_style('pss_codemirror_hint_css', plugins_url('codemirror/show-hint.css', __FILE__));
		
		}
		
	}

	add_action('admin_enqueue_scripts', 'pss_add_cm_files');
}

// Site specific code.
if(!is_admin()) {
	
	function pss_add_inline_stylesheet() {
		global $post;
		
		if(empty($post)) {
			return;
		}
		
		$post_meta = get_post_meta($post->ID, 'pss_style', true);
		
		if(!empty($post_meta)) {	
			echo '<style type="text/css">', $post_meta, '</style>';		
		}
	}
	add_action('wp_head', 'pss_add_inline_stylesheet');	
}