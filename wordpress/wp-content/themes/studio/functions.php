<?php 

$scrn = get_option('scrn');

add_action( 'after_setup_theme', 'vp_setup' );

if ( ! function_exists( 'vp_setup' ) ){

	function vp_setup(){

		global $scrn;

		//require get_template_directory() . '/teoPanel/custom-functions.php';

		//require get_template_directory() . '/includes/shortcodes.php';

		//require get_template_directory() . '/includes/comments.php';

		require get_template_directory() . '/includes/additional_functions.php';

		//load_theme_textdomain('SCRN', get_template_directory() . '/languages');

		$current_user = wp_get_current_user();

	//	if($scrn['superadmin'] == '' || $current_user->user_login == $scrn['superadmin'])

	//		require 'teoPanel/nhp-options.php';

	}

}

// Loading js files into the theme

add_action('wp_head', 'vp_scripts');

if ( !function_exists('vp_scripts') ) {

	function vp_scripts() {

		global $scrn;

		wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array(), '1.0');

		wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/js/jquery.smooth-scroll.js', array(), '1.0');

		wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), '1.0');

		wp_enqueue_script( 'inview', get_template_directory_uri() . '/js/jquery.inview.js', array(), '1.0');

		if ( is_singular() && get_option( 'thread_comments' ) )

    		wp_enqueue_script( 'comment-reply' );

	}



}



//Loading the CSS files into the theme

add_action('wp_enqueue_scripts', 'vp_load_css');

if( !function_exists('vp_load_css') ) {

	function vp_load_css() {

		global $scrn;

		wp_enqueue_style( 'raleway', 'http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300', array());

		wp_enqueue_script('jquery');

		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/slick.min.js', array(), '1.0');
		
		wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), '1.0');

	}

}



add_action('init', 'vp_misc');

function vp_misc() {

	global $scrn;

	if(isset($scrn['wordpress_version']) && $scrn['wordpress_version'] == 0)

		remove_action('wp_head', 'wp_generator'); 

	add_filter('show_admin_bar', '__return_false');

	add_theme_support( 'automatic-feed-links' );

	

}

if ( ! isset( $content_width ) ) $content_width = 960;



function encEmail ($orgStr) {

    $encStr = "";

    $nowStr = "";

    $rndNum = -1;



    $orgLen = strlen($orgStr);

    for ( $i = 0; $i < $orgLen; $i++) {

        $encMod = rand(1,2);

        switch ($encMod) {

        case 1: // Decimal

            $nowStr = "&#" . ord($orgStr[$i]) . ";";

            break;

        case 2: // Hexadecimal

            $nowStr = "&#x" . dechex(ord($orgStr[$i])) . ";";

            break;

        }

        $encStr .= $nowStr;

    }

    return $encStr;

} 



function register_menus() {

	register_nav_menus( array( 'top-menu' => 'Top primary menu')

						);

}

add_action('init', 'register_menus');



class description_walker extends Walker_Nav_Menu

{

      function start_el(&$output, $item, $depth, $args)

      {

           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';



           $class_names = $value = '';



           $classes = empty( $item->classes ) ? array() : (array) $item->classes;



           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

           $class_names = ' class="'. esc_attr( $class_names ) . '"';



           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';



           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';

           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';

           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

           if($item->object == 'page')

           {

                $varpost = get_post($item->object_id);

                $attributes .= ' href="/wp/#' . $varpost->post_name . '"';

           }

           else

                $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            $item_output = $args->before;

            $item_output .= '<a'. $attributes .'>';

            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );

            $item_output .= $args->link_after;

            $item_output .= '</a>';

            $item_output .= $args->after;



            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

            }

}



add_filter( 'posts_orderby', 'sort_query_by_post_in', 10, 2 );

	

function sort_query_by_post_in( $sortby, $thequery ) {

	if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )

		$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";

	

	return $sortby;

}

add_theme_support( 'post-thumbnails' );


function create_post_type() {
	
	/* homepageslider */
	register_post_type( 'homeslider',
		array(
		  'exclude_from_search' => true,
			'public' => true,
			'query_var' => false,
			'hierarchical' => true,
			'show_in_admin_bar' => true,
			'menu_position'     => 5,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'page-attributes'
			),
			'labels' => array(
				'name' => 'Home Page Slider Items',
				'singular_name' => 'Home Page Slider Item',
				'add_new' => 'Add New Home Page Slider Item',
				'add_new_item' => 'New Home Page Slider Item'
			)
		)
	);
	
 /* pastevents */
	register_post_type( 'pastevents',
		array(
			'public' => true,
			'hierarchical' => false,
			'show_in_admin_bar' => true,
			'menu_position'     => 5,
			'rewrite' => array( 'slug' => 'events', 'with_front' => false ),
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'excerpt',
				'custom-fields'
			),
			'labels' => array(
				'name' => 'Past Events',
				'singular_name' => 'Past Event',
				'add_new' => 'Add New Past Event',
				'add_new_item' => 'Add New Past Event'
			)
		)
	);
	
}

add_action( 'init', 'create_post_type' );

// turn of jetpack comments
function tweakjp_rm_comments_att( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'tweakjp_rm_comments_att', 10 , 2 );

?>