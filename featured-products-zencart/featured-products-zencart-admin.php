<?php
  if ($_POST['zenfpd_hidden'] =='Y') {
  //Form data sent, save it out as required 
        $zen_dbhost = $_POST['zenfpd_dbhost'];  
        update_option('zenfpd_dbhost', $zen_dbhost);            
        $zen_dbname = $_POST['zenfpd_dbname'];  
        update_option('zenfpd_dbname', $zen_dbname);  
        $zen_prefix = $_POST['zenfpd_prefix'];  
        update_option('zenfpd_prefix', $zen_prefix);  
        $zen_dbuser = $_POST['zenfpd_dbuser'];  
        update_option('zenfpd_dbuser', $zen_dbuser);            
        $zen_dbpwd = $_POST['zenfpd_dbpwd'];  
        update_option('zenfpd_dbpwd', $zen_dbpwd);  
        $zen_prod_img_folder = $_POST['zenfpd_prod_img_folder'];  
        update_option('zenfpd_prod_img_folder', $zen_prod_img_folder);    
        $zen_store_url = $_POST['zenfpd_store_url'];  
        update_option('zenfpd_store_url', $zen_store_url);  
		$zen_image_width = $_POST['zenfpd_image_width'];  
        update_option('zenfpd_image_width', $zen_image_width);  
		$zen_image_height = $_POST['zenfpd_image_height'];  
        update_option('zenfpd_image_height', $zen_image_height);  
        ?>  
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>  
		<?php
  } else {
        $zen_dbhost = get_option('zenfpd_dbhost');  
        $zen_dbname = get_option('zenfpd_dbname');  
		$zen_prefix = get_option('zenfpd_prefix');
        $zen_dbuser = get_option('zenfpd_dbuser');  
        $zen_dbpwd = get_option('zenfpd_dbpwd');  
        $zen_prod_img_folder = get_option('zenfpd_prod_img_folder');  
        $zen_store_url = get_option('zenfpd_store_url');  
		$zen_image_width = get_option('zenfpd_image_width');
		$zen_image_height = get_option('zenfpd_image_height');
  }
  ?>
  <div class="wrap">
			<?php    echo "<h2>" . __( 'ZenCart Featured Products Display Options', 'zenfpd_trdom' ) . "</h2>"; ?>
			
			<form name="zenfpd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="zenfpd_hidden" value="Y">
				<?php    echo "<h4>" . __( 'ZenCart Database Settings', 'zenfpd_trdom' ) . "</h4>"; ?>
				<table class="form-table">
				<tbody>
				<tr>
				  <th scope="row"><label for="database_host"><?php _e("Database host: " ); ?></label></th>
				  <td><input type="text" name="zenfpd_dbhost" value="<?php echo $zen_dbhost; ?>" size="20"><?php _e(" ex: localhost" ); ?></td></tr>
				<tr>
				  <th scope="row"><label for="database_name"><?php _e("Database name: " ); ?></label></th>
				  <td><input type="text" name="zenfpd_dbname" value="<?php echo $zen_dbname; ?>" size="20"><?php _e(" ex: zencart_shop" ); ?></td>
				</tr>
				<tr>
				  <th scope="row"><label for="table_prefix"><?php _e("Database table prefix: "); ?></label></th>
				  <td><input type="text" name="zenfpd_prefix" value="<?php echo $zen_prefix; ?>" size="20"><?php _e(" ex: zen_"); ?></td>
				</tr>  
				<tr>
				  <th scope="row"><label for="database_user"><?php _e("Database user: " ); ?></label></th>
				  <td><input type="text" name="zenfpd_dbuser" value="<?php echo $zen_dbuser; ?>" size="20"><?php _e(" ex: root" ); ?></td>
				</tr>
				<tr>
				  <th scope="row"><label for="database_password"><?php _e("Database password: " ); ?></label></th>
				  <td><input type="text" name="zenfpd_dbpwd" value="<?php echo $zen_dbpwd; ?>" size="20"><?php _e(" ex: secretpassword" ); ?></td>
				</tr>  
				</table>
				<hr />
				<?php    echo "<h4>" . __( 'ZenCart Store Settings', 'zenfpd_trdom' ) . "</h4>"; ?>
				<table class="form-table">
				  <tr>
				    <th scope="row"><label for="store_url"><?php _e("Store URL: " ); ?></label></th>
				    <td><input type="text" name="zenfpd_store_url" value="<?php echo $zen_store_url; ?>" size="20"><?php _e(" ex: http://www.yourstore.com/" ); ?></td>
				  </tr>
				  <tr>
				    <th scope="row"><label for="image_folder"><?php _e("Product image folder: " ); ?></label></th>
					<td><input type="text" name="zenfpd_prod_img_folder" value="<?php echo $zen_prod_img_folder; ?>" size="20"><?php _e(" ex: http://www.yourstore.com/images/" ); ?></td>
					</tr>
				</table>
				<?php    echo "<h4>" . __( 'ZenCart Image Settings', 'zenfpd_trdom' ) . "</h4>"; ?>
				<table class="form-table">
				  <tr>
				    <th scope="row"><label for="image_width"><?php _e("Image Width (pixels) : " ); ?></label></th>
				    <td><input type="text" name="zenfpd_image_width" value="<?php echo $zen_image_width; ?>" size="20"><?php _e(" ex: 200" ); ?></td>
				  </tr>
				  <tr>
				    <th scope="row"><label for="image_height"><?php _e("Image Height (pixels) : " ); ?></label></th>
					<td><input type="text" name="zenfpd_image_height" value="<?php echo $zen_image_height; ?>" size="20"><?php _e(" ex: 200" ); ?></td>
					</tr>
				</table>
			
				<p class="submit">
				<input type="submit" name="Submit" class="button button-primary" value="<?php _e('Update Options', 'zenfpd_trdom' ) ?>" />
				</p>
			</form>
		</div>
	