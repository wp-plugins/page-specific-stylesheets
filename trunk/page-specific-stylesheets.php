<?php
/**
 * Plugin Name: Page Specific Stylesheets
 * Description: Allows a simple method of keeping your styles.css file nice and clean by allowing page-specific CSS to be managed within that page. When the page is deleted, so is it's CSS.
 * Version: 1.0.2
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
		global $post;
		delete_post_meta($post->ID, 'pss_style');
	}
	add_action('delete_post', 'pss_clean_deleted_post_meta');
	
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