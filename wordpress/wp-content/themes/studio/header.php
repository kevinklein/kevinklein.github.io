<?php global $scrn; ?>

<!DOCTYPE html>

<!--[if lt IE 7 ]><html style="margin-top: 0 !important" class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html style="margin-top: 0 !important" class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html style="margin-top: 0 !important" class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <!--<![endif]-->

<html style="margin-top: 0 !important" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('-');?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="/favicon.gif"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE]>
        <link href="<?php echo get_stylesheet_directory_uri() . '/css/ie.css';?>" rel='stylesheet' type='text/css'>
    <![endif]-->
    <?php wp_head(); global $scrn;  
    if(isset($scrn['integration_header'])) echo $scrn['integration_header'] . PHP_EOL; ?>
    <script type="text/javascript" src="//use.typekit.net/jui7doy.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>

<body <?php body_class();?>>

<header class="header" id="top">
  <a class="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><strong>WOMEN</strong> CO/CREATE</a>
  <!--<a class="logo2" href="#"><strong>S</strong>C/C <i class="fa fa-chevron-right"></i></a>-->
</header>

<section class="menu-container">
    <a href="#top" class="menu-top"></a>
    <a href="javascript:void();" class="menu-nav"><span></span></a> 
</section>  

<nav class="menu-items">
<?php wp_nav_menu(array(
    'theme_location' => 'top-menu',
    'container' => '',
    'fallback_cb' => 'show_top_menu',
    'echo' => true,
    'walker' => new description_walker(),
    'depth' => 1 ) ); 
?>
</nav> 