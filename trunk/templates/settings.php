<?php
	// Set up any data we'll need within this template.
	
	$post_types = get_post_types(array(
		'public' => true
	));
	
	$options = get_option('pss_options');
	
?>

<h2>Page Specific Stylesheets - Options</h2>

<p>Below are the various settings for configuring Page Specific Stylesheets.</p>

<form method="post" action="options.php">
	<?php settings_fields('pss_plugin_options'); ?>
	<table class="form-table">
		<tr>
			<td>Post Types: </td>
			<td>
				<?php
					
					foreach($post_types as $key => $value) {
					
						$checked_value = '';
						
						if(isset($options['post_types'][$value])) {
							$checked_value = ' checked';
						}
						
						echo '<input type="checkbox" name="pss_options[post_types][', $value, ']"', $checked_value, '> ', $value, '<br>';
						
					}
					
				?>
			</td>
		</tr>
		<tr>
			<td>Delete Style Data on Uninstall?</td>
			<td>
				<input type="checkbox" name="pss_options[delete_styles_on_uninstall]"<?php if(isset($options['delete_styles_on_uninstall'])) { echo ' checked'; } ?>> 
				<span style="color:red;">Yes, I am certain and I know this data cannot be recovered once deleted.</span>
			</td>
		</tr>
		<tr>
			<td>Delete Plugin Options on Uninstall?</td>
			<td>
				<input type="checkbox" name="pss_options[delete_options_on_uninstall]"<?php if(isset($options['delete_options_on_uninstall'])) { echo ' checked'; } ?>> 
				<span style="color:red;">Yes, I am certain and I know this data cannot be recovered once deleted.</span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" class="button-primary" value="Save Changes">
			</td>
		</tr>
	</table>	
</form>