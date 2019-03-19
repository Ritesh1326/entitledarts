<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<head>
     <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
     <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; 
     charset=<?php bloginfo('charset'); ?>" />	
     <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> 
     <!-- leave this for stats please -->

     <!-- <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" 
     type="text/css" media="screen" /> -->
     <link rel="alternate" type="application/rss+xml" title="RSS 2.0" 
     href="<?php bloginfo('rss2_url'); ?>" />
     <link rel="alternate" type="text/xml" title="RSS .92" 
     href="<?php bloginfo('rss_url'); ?>" />
     <link rel="alternate" type="application/atom+xml" title="Atom 0.3" 
     href="<?php bloginfo('atom_url'); ?>" />
     <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
     <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/logo.png">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- CSS -->
     <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
     <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
     <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lightbox.min.css">
     <!-- Font awesome -->
     <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
     <!-- Owl carousel -->
     <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.min.css">
     <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.theme.default.min.css">
     <!-- Animate -->
     <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css">

     <!-- Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

     <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
     <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/flexisel.js"></script>
     <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
     <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
     <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
</head>
     <body id="home">
          <!-- Preloader -->
          <?php if ( get_option('preload_website') ) { ?>
               <div class="loader">
                    <div class="icon">
                         <img src="<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>" alt="Entitledarts">
                    </div>
               </div>
          <?php } ?>

          <!-- Header and Navigation -->
          <header>
               <nav class="navbar navbar-default" aria-label="<?php esc_attr_e( 'Main Menu', 'entitledarts' ); ?>">
                    <div class="container-fluid">
                         <div class="navbar-header">
                              <div class="hamburgur">
                                   <div class="bar1"></div>
                                   <div class="bar2"></div>
                                   <div class="bar3"></div>
                              </div>
                              <a class="logo" href="<?php bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-light.png" alt="Entitledarts"></a>
                         </div>
                         <div class="date-time">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/cloud.png">
                              <span class="temp">28</span><span class="deg"></span><span class="temp_type">C</span>
                              <span id="state" class="state">HYD</span>
                              <span id="time" class="time">15:22</span><span id="day" class="day">Mon</span>
                         </div>
                    </div>
                    <div id="mySidenav" class="sidenav">
                         <span href="javascript:void(0)" class="closebtn">
                              <div class="one"></div>
                              <div class="two"></div>
                         </span>
                         <div class="side-menu">
                              <a href="<?php bloginfo('url'); ?>"><img src="<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>" alt="Entitledarts"></a>

                              <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                   <?php   $args = array(
                                           'theme_location' => 'primary',
                                           'container_class' => '',
                                           'fallback_cb' => '',
                                           'menu_id' => 'primary-menu',
                                           'walker' => new Tumbas_Nav_Menu()
                                       );
                                       wp_nav_menu($args);
                                   ?>
                              <?php endif; ?>
                         </div>

                         <div class="side-copyright">
                              <p><?php echo get_option('sidemenu_copyright_text'); ?></p>
                         </div>
                    </div>
               </nav>
          </header>