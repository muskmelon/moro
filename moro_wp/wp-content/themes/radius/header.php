<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head> 
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" /> 
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	
	<title>
	<?php
		global $page, $paged;

		wp_title( '|', true, 'right' );

		bloginfo( 'name' );

		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

		if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
	?>
	</title>
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />
	
	<!-- stylesheet -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	
	<!-- responsive media queries -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/media-queries.css" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no" />
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/ie/ie.css" />
	<![endif]-->
	
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css' />

	<?php if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script('comment-reply'); wp_head(); ?>
	
	<!-- conditional css -->
	<style type="text/css">
		a {
			color:<?php echo of_get_option('of_colorpicker', 'no entry' ); ?>;
		}
		#nav > li.current-menu-item {
			background: <?php echo of_get_option('of_nav_colorpicker', 'no entry' ); ?>;
		}
		
		body.category-<?php echo of_get_option('of_portfolio_cat'); ?> #nav li.sidebar-toggle { display: none; }
		
		<?php if ( of_get_option('of_theme_css') ) { ?>
			<?php echo of_get_option('of_theme_css'); ?>
		<?php } ?>
	</style>
</head>

<body <?php body_class( $class ); ?>>
	<!--Main Wrapper -->
	<div class="main-wrapper">
		<div class="header-wrapper">
			<div class="header-texture">
				<div class="header">
					<div class="header-left">
						<!-- Grab the logo if uploaded -->
						<?php if ( of_get_option('of_logo') ) { ?>
							<h1>
								<a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo of_get_option('of_logo'); ?>" alt="<?php the_title(); ?>" /></a>
							</h1>
						<!-- Otherwise show the site title and description -->	
						<?php } else { ?>
						    <h1 class="logo-text">
						    	<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name') ?></a>
						    </h1>
						<?php } ?>
					</div>
					
					<div class="clear hide-clear"></div>
					
					<!-- Menu -->
					<div class="header-right">
						<?php wp_nav_menu( array( 'theme_location' => 'header', 'menu_id' => 'nav', 'menu_class' => 'nav-top' ) ); ?>
					</div>
					
					<div class="clear"></div>
				</div><!-- header -->
			</div><!-- header texture -->
		</div><!-- header wrapper -->