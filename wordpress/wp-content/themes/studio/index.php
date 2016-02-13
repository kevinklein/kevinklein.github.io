<?php get_header(); ?> 

<?php if ( is_front_page() ) : ?>
					
	<div class="slider-home">
		
			<?php $args = array( 'post_type' => 'homeslider', 'orderby' => 'menu_order', 'order' => 'ASC' );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
			  $thumb_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_id(),'full'));
				echo '<div class="slide" style="background-image:url(' . $thumb_img . ')"><div class="slider-band"><div class="slider-band-title">';
				the_title();
				echo '</div>';
				echo '<div class="slider-band-content">';
				the_content();
				echo '</div></div>';
				echo '</div>';
			endwhile; ?>						

	</div>
	
<?php endif; ?>

<?php wp_reset_postdata(); ?>
 
<?php 
if ( ( $locations = get_nav_menu_locations() ) && $locations['top-menu'] ) {
    $menu = wp_get_nav_menu_object( $locations['top-menu'] );
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    $include = array();
    foreach($menu_items as $item) {
        if($item->object == 'page')
            $include[] = $item->object_id;
    }
    query_posts( array( 'post_type' => 'page', 'post__in' => $include, 'posts_per_page' => count($include), 'orderby' => 'post__in' ) );
}
else
{
    if(isset($scrn['pages_topmenu']) && $scrn['pages_topmenu'] != '' )
        query_posts(array( 'post_type' => 'page', 'post__in' => $scrn['pages_topmenu'], 'posts_per_page' => count($scrn['pages_topmenu']), 'orderby' => 'menu_order', 'order' => 'ASC' ) );
    else
        query_posts(array( 'post_type' => 'page', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
}
$i = 1;
while(have_posts() ) : the_post(); ?>

    <?php $temp = get_post_meta($post->ID, 'vp_settings', true);?>
    <div class="bg <?php 
      if(isset($temp['variation']) && $temp['variation'] == 3) {
        echo 'bg-white';
      } elseif(isset($temp['variation']) && $temp['variation'] == 2) {
        echo 'bg-purple';
      } elseif(isset($temp['variation']) && $temp['variation'] == 4) {
        echo 'bg-full';
      }
      ?>" 
    id="<?php echo $post->post_name;?>"
        <?php if(isset($temp['variation']) && $temp['variation'] == 5) { echo 'style="';
        if(isset($temp['background_color']) && $temp['background_color'] != '') echo 'background-color: #' . $temp['background_color']; 
        else if(isset($temp['background']) && $temp['background'] != '') echo 'background-image: url(\'' . $temp['background'] . '\')'; echo '"'; } ?>>
        <div class="container">
          
          <?php if ( $post->post_name == "past-events") : ?>
          
            <h1 style="text-align: center;">Past Events</h1>
					
				<div class="slider-events">

        			<?php $args = array( 'post_type' => 'pastevents', 'orderby' => 'date', 'order' => 'DESC' );
        			$loop = new WP_Query( $args );
        			while ( $loop->have_posts() ) : $loop->the_post();
        				echo '<div class="slide">';
        				echo '<a href="' . get_permalink($post->ID) . '" title="' . get_the_title($post->ID) . '">';
        				the_post_thumbnail();
        				echo '<strong>';
        				the_excerpt();
        				echo '</strong><h3>';
        				the_title();
        				echo '</h3></a></div>';
        			endwhile; ?>		
        						
        		</div>	
        
                <?php wp_reset_postdata(); ?>
						
				<?php endif; ?>
				
				<?php if ( $post->post_name == "conversation") : ?>
				
				    <h1 style="text-align: center;">Community</h1>
				
					<div class="slider-conversation">

            			<?php $args = array( 'category_name' => 'twitter,instagram' );
            			$loop = new WP_Query( $args );
            			while ( $loop->have_posts() ) : $loop->the_post();
            			    $category = get_the_category();
            				echo '<div class="slide ' . $category[0]->cat_name .'">';
            				if( $category[0]->cat_name == "Twitter") {
                				$twitter_userid = get_option('itap_user_id'); 
                				$tweet_id = get_post_meta($post->ID, '_tweet_id', true);
                				$tweet_url = 'https://twitter.com/'. $twitter_userid .'/status/'. $tweet_id;
                				echo '<a href=" ' .$tweet_url. '" class="twitter-link"><strong>Women Co/Create</strong><br>@womencocreate</a>';
            				}
            				//echo '<a href="' . get_permalink($post->ID) . '" title="' . get_the_title($post->ID) . '">';
            				//the_post_thumbnail();
            				//the_title();
            				//the_excerpt();
            				the_content();
            				echo '</div>';
            			endwhile; ?>		
            						
    		        </div>	

                <?php wp_reset_postdata(); ?>
					
			    <?php endif; ?>
          
          <?php the_content('');?>
            
        </div> <!-- end container -->
    </div> <!-- end bg -->

<?php $i++; endwhile; wp_reset_query(); ?>   
    
<?php get_footer();?>