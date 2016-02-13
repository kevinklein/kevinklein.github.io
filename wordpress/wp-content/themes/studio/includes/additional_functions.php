<?php
add_action( 'admin_init', 'vp_meta_boxes');
function vp_meta_boxes() {
	add_meta_box('vp_post_meta', 'Page Options', 'vp_post_meta', 'page', 'normal', 'high');
	//add_meta_box('vp_pagetemplates_meta', 'Page Template Settings', 'vp_pagetemplates_meta', 'page', 'side');
}
function vp_post_meta() {
	global $post;
	$temp = maybe_unserialize(get_post_meta($post->ID,'vp_settings',true));
	$background = isset($temp['background']) ? $temp['background'] : '';
	$background_color = isset($temp['background_color']) ? $temp['background_color'] : '';
	$slogan = isset($temp['slogan']) ? $temp['slogan'] : '';
	$slogan_bg = isset($temp['slogan_bg']) ? $temp['slogan_bg'] : '';
	$variation = isset($temp['variation']) ? $temp['variation'] : '';
?>
	<div>
		<div style="margin: 15px 0px 15px 4px" class="vp_bg">
			<label style="font-weight: bold" for="vp_background">Background style:</label><br />
			<select name="vp_bg_style" class="vp_bg_style">
				<option value="1" <?php if($variation == '1' || !isset($variation) || $variation == '') echo 'selected="selected"';?>>Default</option>
				<option value="2" <?php if($variation == '2') echo 'selected="selected"';?>>Purple</option>
				<option value="3" <?php if($variation == '3') echo 'selected="selected"';?>>White</option>
				<option value="4" <?php if($variation == '4') echo 'selected="selected"';?>>Full</option>
				<option value="5" <?php if($variation == '5') echo 'selected="selected"';?>>Custom (defined below)</option>
			</select>
		</div>
		<div style="margin: 15px 0px 15px 4px" class="vp_custom_bg">
			<label style="font-weight: bold" for="vp_background">Background image URL:</label><br />
			<input type="text" name="vp_background" id="vp_background" value="<?php echo $background;?>" style="width: 40em" />
		</div>
		<div style="margin: 15px 0px 15px 4px" class="vp_custom_bg">
			<label style="font-weight: bold" for="vp_background_color">Background image color:</label>(use just the hex code, skip the "#" character. Will use just a color and not an image) <br />
			<input type="text" name="vp_background_color" id="vp_background_color" value="<?php echo $background_color;?>" style="width: 40em" />
		</div>
		<!--<div style="margin: 15px 0px 15px 4px">
			<label style="font-weight: bold" for="vp_slogan">Slogan text:</label><br />
			<input type="text" name="vp_slogan" id="vp_slogan" value="<?php echo $slogan;?>" style="width: 40em" />
		</div>
		<div style="margin: 15px 0px 15px 4px">
			<label style="font-weight: bold" for="vp_sloganbg">Slogan background image url:</label><br />
			<input type="text" name="vp_sloganbg" id="vp_sloganbg" value="<?php echo $slogan_bg;?>" style="width: 40em" />
		</div>-->
	</div>
	<script type="text/javascript">
			jQuery(document).ready(function() {	
				var $bg_style = jQuery("select.vp_bg_style");
				$bg_style.on("change", function() {
					var val = jQuery(this).val();
					if(val == 5) {
						jQuery(".vp_custom_bg").show(400);
					}
					else {
						jQuery(".vp_custom_bg").hide(400);
						jQuery(".vp_background").val("");
						jQuery(".vp_background_color").val("");
					}
				});
				$bg_style.trigger('change');
			});
	</script>
<?php 
}
add_action('save_post', 'vp_save_metadata', 10, 2);
function vp_save_metadata($post_id, $post) 
{
	// verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
   		 return;
   	// Check permissions
    if ( 'page' == $post->post_type ) 
    {
 	   if ( !current_user_can( 'edit_page', $post_id ) )
       		 return;
 	}
  	else
  	{
    	if ( !current_user_can( 'edit_post', $post_id ) )
        	return;	
    }
    $temp['background'] = isset($_POST['vp_background']) ? esc_attr($_POST['vp_background']) : '';
    $temp['background_color'] = isset($_POST['vp_background_color']) ? esc_attr($_POST['vp_background_color']) : '';
    $temp['slogan'] = isset($_POST['vp_slogan']) ? $_POST['vp_slogan'] : '';
    $temp['slogan_bg'] = isset($_POST['vp_sloganbg']) ? esc_attr($_POST['vp_sloganbg']) : '';
    $temp['variation'] = isset($_POST['vp_bg_style']) ? esc_attr($_POST['vp_bg_style']) : '';
    update_post_meta($post_id, 'vp_settings', $temp);
}

//*********** Page Templates Area **************

function vp_pagetemplates_meta() {
	global $post;
	$temp = maybe_unserialize(get_post_meta($post->ID,'vp_ptemplate_settings',true));
	$categories = isset($temp['categories']) ? $temp['categories'] : '';
	$blog_posts = isset($temp['blog_posts']) ? $temp['blog_posts'] : '';
?>
		Here you'll see some page template options(just for the theme specific page templates)
		<div style="margin: 15px 0px 15px 0px; display: none" class="blog">
			<h4>Select categories to include: </h4>
					
			<?php $cats_array = get_categories('hide_empty=0');
			foreach ($cats_array as $cat) {
				$checked = '';
				
				if (!empty($categories)) {
					if (in_array($cat->cat_ID, $categories)) $checked = "checked=\"checked\"";
				} ?>
				
				<label style="padding-bottom: 5px; display: block" for="<?php echo 'cat-' . $cat->cat_ID; ?>">
					<input type="checkbox" name="vp_categories[]" id="<?php echo 'cat-' . $cat->cat_ID; ?>" value="<?php echo $cat->cat_ID; ?>" <?php echo $checked; ?> />
					<?php echo $cat->cat_name; ?>
				</label>							
			<?php } ?>
		</div>

		<div style="margin: 15px 0px 15px 0px; display: none" class="blog">
			<label style="font-weight: bold" for="vp_blogposts">Number of blog posts per page:</label>
			<input size="2" type="text" name="vp_blogposts" id="vp_blogposts" value="<?php if($blog_posts == '') echo '6'; else echo $blog_posts;?>" />
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {	
				var page_template = jQuery('select#page_template'),
					page_template_div = jQuery('#vp_pagetemplates_meta');
				page_template.on('change', function() {
					page_template_div.find('.inside > div').css('display','none');
					var ptval = jQuery(this).val();
					if(ptval === "page-template-blog.php")
						jQuery("div.blog").show(400);
				});
				page_template.trigger('change');				
			});
		</script>
<?php 
}
add_action('save_post', 'vp_save_ptemplate_settings', 10, 2);
function vp_save_ptemplate_settings($post_id, $post) 
{
	// verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
   		 return;
   	// Check permissions
    if ( 'page' == $post->post_type )  
    {
 	   if ( !current_user_can( 'edit_page', $post_id ) )
       		 return;
 	}
  	else
  	{
    	if ( !current_user_can( 'edit_post', $post_id ) )
        	return;	
    }
    $temp = array();
    if(isset($_POST['vp_categories']))
    {
    		$temp['categories'] = (array)$_POST['vp_categories'];
    }
    else
    	$temp['categories'] = '';

    if(isset($_POST['vp_blogposts']) != '' && is_numeric($_POST['vp_blogposts']) )
    	$temp['blog_posts'] = (int)$_POST['vp_blogposts'];
    else
    	$temp['blog_posts'] = 6; 
    update_post_meta($post_id, 'vp_ptemplate_settings', $temp);
}

?>