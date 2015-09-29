<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php
            wp_title ( '|', true, 'right');
            bloginfo('name');?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/ico/verbs-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/ico/verbs-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/ico/verbs-icon-152x152.png" />
    <link rel="icon" sizes="192x192" href="<?php echo get_stylesheet_directory_uri(); ?>/ico/verbs-icon-192x192.png">
    <script src="//use.typekit.net/qmn1nmb.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 7]>
            <p class="browsehappy">Hello There. You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<header class="container site-top">
	<div class="row">
		<div class="col-xs-12">
            <div class="site-logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/lola-cap-black.svg" alt="Wisconsin Verbs" title="Wisconsin Verbs"></a></div>
<?php wp_nav_menu( array('menu' => 'Top Custom', 'container_class' => 'site-nav', 'menu_id' => 'nav' )); ?>
		</div>
	</div>
</header>
