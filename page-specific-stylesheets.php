<?php
/**
 * Plugin Name: Page Specific Stylesheets
 * Description: Allows a simple method of keeping your styles.css file nice and clean by allowing page-specific CSS to be managed within that page. When the page is deleted, so is its CSS.
 * Version: 1.1.1
 * Date: 24 May 2014
 * Author: Tyler Shaw
**/

define('PSS', true);

// Admin specific code.
if(is_admin()) {

	// Define the function responsible for adding the stylesheet boxes.
	function pss_add_meta_boxes() {
		// Post meta box.
        add_meta_box( 
            'pss_style_box',
            'Page Specific Stylesheet',
			'pss_render_meta_box_content',
			'post',
			'advanced',
			'high'
        );
		
		// Page meta box.
        add_meta_box( 
            'pss_style_box',
			'Page Specific Stylesheet',
			'pss_render_meta_box_content',
			'page',
			'advanced',
			'high'
        );
    }
	
	// Define the function responsible for displaying the stylesheet boxes.
	function pss_render_meta_box_content() {
    	global $post;
    	?>
    	<div>
    		<input type="hidden" id="post-id" value="<?php echo $post->ID ?>" />
    		<textarea class="wp-editor-area" id="pss_textarea" name="pss_textarea"><?php echo get_post_meta($post->ID, 'pss_style', true); ?></textarea>
    	</div>
		<style>
			#pss_textarea {
				width: 100%;
				min-height: 100px;
			}
		</style>
    	<?php
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