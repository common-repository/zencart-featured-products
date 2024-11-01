<?php 
 /* 
    Plugin Name: Featured Products Display - Zencart
    Plugin URI: http://www.techize.co.uk/plugins
    Description: Plugin for displaying the featured products as taken from a ZenCart database
    Author: Jonathan Gill
    Version: 1.0 
    Author URI: http://www.techize.co.uk/
    */  
	
function zenfpd_getproducts($product_cnt=1) {
 //Connect to the Zencart database  
    $zencartdb = new wpdb(get_option('zenfpd_dbuser'),get_option('zenfpd_dbpwd'), get_option('zenfpd_dbname'), get_option('zenfpd_dbhost'));  
	$retval = '';  
	$zen_prefix = get_option('zenfpd_prefix');
	if ($product_cnt == "")
	{
	  $product_cnt=1;
	}
	$TABLE_FEATURED = $zen_prefix . 'featured';
	$TABLE_PRODUCTS_DESCRIPTION = $zen_prefix . 'products_description';
	$TABLE_PRODUCTS = $zen_prefix . 'products';
	$image_width = get_option('zenfpd_image_width');
    $image_height = get_option('zenfpd_image_height');	
	$store_url = get_option('zenfpd_store_url');  
    $image_folder = get_option('zenfpd_prod_img_folder');  
  
			   
	$featured_products_query = "SELECT DISTINCT p.products_id, p.products_image, pd.products_name, p.master_categories_id FROM " . $TABLE_FEATURED . " AS f 
        JOIN (SELECT(RAND() * (SELECT MAX(featured_id) FROM " . $TABLE_FEATURED . ")) AS id) AS f2, (" . $TABLE_PRODUCTS . " p 
        LEFT JOIN " . $TABLE_PRODUCTS_DESCRIPTION  . " pd ON p.products_id = pd.products_id )
	    WHERE f.featured_id >= f2.id AND 
                p.products_id = f.products_id AND 
                p.products_id = pd.products_id AND 
                p.products_status = 1 AND
                f.status = 1 
				LIMIT " . $product_cnt . ";";

	$featured_products = $zencartdb->get_results($featured_products_query);
	foreach ($featured_products as $featured_product)
	{
	    //Build the HTML code  
        $retval .= '<div class="zenfpd_product">';  
        $retval .= '<a href="'. $store_url . '/index.php?main_page=product_info&products_id=' . $featured_product->products_id . '"><img src="' . $image_folder . $featured_product->products_image . '" width = "'.$image_width . '" height = "' . $image_height . '"/></a><br />';  
        $retval .= '<a href="'. $store_url . '/index.php?main_page=product_info&products_id=' . $featured_product->products_id . '">' . $featured_product->products_name . '</a>';  
        $retval .= '</div>';  
    }
    return $retval;  
}
 
 function zenfpd_admin(){
  include ('featured-products-zencart-admin.php');
}
 
 
function zenfpd_admin_actions() {  
    add_options_page("ZenCart Settings", "ZenCart Featured Product Display", 1, "zencart-featured-product_display", "zenfpd_admin");  
}  

// set up the shortcode stuff so product count can be added when using the shortcode

function zencart_featured_products_shortcode($atts, $content = null){
  extract(shortcode_atts(array("product_count" => '1'), $atts));
  return zenfpd_getproducts($product_count); 
}


// add a widget so can be added to side bar and not just within the page/post.


class wp_zencart_featured_products_display extends WP_Widget {
	
		function wp_zencart_featured_products_display() {
		  parent::WP_Widget(false, $name = __('ZenCart Featured Products', 'wp_widget_plugin') );
		}
		
		function form ($instance) {
			// Check values
			if( $instance) {
				 $product_count = esc_attr($instance['product_count']);
				 
			} else {
				 $product_count = '1';			 
			}
			?>

			<p>
			<label for="<?php echo $this->get_field_id('product_count'); ?>"><?php _e('Number of Products to display', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('product_count'); ?>" name="<?php echo $this->get_field_name('product_count'); ?>" type="text" value="<?php echo $product_count; ?>" />
			</p>
			<?php
		}
		function update($new_instance, $old_instance){
			$instance = $old_instance;
			// Fields
			$instance['product_count'] = strip_tags($new_instance['product_count']);
			return $instance;
		}
		
		function widget($args, $instance){
		  echo zenfpd_getproducts($instance['product_count']); 
		}
	} 
add_action('admin_menu', 'zenfpd_admin_actions');  
add_shortcode( 'zencart_featured','zencart_featured_products_shortcode');

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_zencart_featured_products_display");'));
?> 