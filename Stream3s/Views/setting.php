<div class="wrap">
	<div id="icon-users" class="icon32"></div>
	<h1><?php _e('Google Drive Stream', 'stream3s') ?></h1>
	<div class="col-container">
		
		<form action="<?php echo esc_url(admin_url('admin-ajax.php')) ?>" method="post">
			
			<input type="hidden" name="action" value="stream3s_save_setting">
   
			<div class="form-field form-required term-name-wrap">
				<label for="tag-client_id"><?php _e('Client id', 'stream3s') ?></label><br>
				<input type="text" name="stream3s_client_id" id="tag-client_id" value="<?php echo esc_attr(get_option('stream3s_client_id')) ?>" required>
			</div>
			
			<div class="form-field form-required term-name-wrap">
				<label for="tag-secret_key"><?php _e('Secret key', 'stream3s') ?></label><br>
				<input type="text" name="stream3s_secret_key" id="tag-secret_key" value="<?php echo esc_attr(get_option('stream3s_secret_key')) ?>" required>
			</div>
   
            <p><a href="https://stream3s.com/account/register" target="_blank"><?php _e('Register Stream3s api', 'stream3s') ?></a></p>
			
			<p class="submit">
				<button type="submit" name="submit" class="button button-primary"><?php _e('Update Setting', 'stream3s') ?></button>
			</p>
		</form>
	
	</div>
</div>