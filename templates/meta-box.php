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