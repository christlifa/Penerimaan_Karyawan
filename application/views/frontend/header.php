<!doctype html>
<html class="" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?php echo $this->config->item('app_name'); ?>
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link href="images/apple-touch-icon.png" type="images/x-icon" rel="shortcut icon">
    <!-- All css files are included here. -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('bower_components/font-awesome/css/font-awesome.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/core.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.new.css');?>">
    <!-- customizer style css -->
    <link href="#" data-style="styles" rel="stylesheet">
    <!-- Modernizr JS -->
    <script src="<?php echo base_url('assets/js/vendor/modernizr-2.8.3.min.js')?>"></script>
</head>

<body>

    <div class="boxed-layout">
        <div class="wrapper white-bg">
            <!--Header section start-->
            <div class="header sticky-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-3 col-xs-6">
                        <div class="logo">
                        <a href="<?php echo site_url(); ?>">
                            <img src="<?php echo base_url('assets/images/logo/logo.png');?>" alt="">
                        </a>
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-9 col-xs-6">
                        <div class="mgea-full-width">
                            <div class="header-right">
                                <div class="header-menu hidden-sm hidden-xs">
                                    <?php $this->load->view('frontend/menu'); ?>
                                </div>
                                <!--<div class="search">
                                    <div class="search-inner">
                                        <a href="#"><i class="mdi mdi-magnify"></i></a>
                                    </div>
                                </div>  -->
                            </div>
                            <div class="search-inside" style="display: none;">
                                <a href="#" class="search-close"><i class="mdi mdi-close"></i></a>
                                <div class="search-overlay"></div>
                                <div class="searchbar-inner">
                                    <div class="search">
                                        <form action="#">
                                            <input type="search" placeholder="Search here"><button type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile menu start -->
            <div class="mobile-menu-area hidden-lg hidden-md">
                <div class="container">
                    <div class="col-md-12">
                        <nav id="dropdown">
                            <ul>
                                <li><a href="#">Home</a>
                                    <ul class="dropdown_menu">
                                        <li><a href="index.html">home page one</a></li>
                                        <li><a href="index-2.html">home page two</a></li>
                                        <li><a href="index-3.html">home page three</a></li>
                                        <li><a href="index-4.html">home page four</a></li>
                                        <li><a href="index-box.html">home page five</a></li>
                                        <li><a href="index-box-fixed.html">home page six</a></li>
                                    </ul>
                                </li>
                                <li><a href="about-us.html">about</a></li>
                                <li class="mega-parent"><a href="#">Elements</a>
                                    <ul class="mgea-menu">
                                        <li class="mega-sub"><a href="#">Column one</a>
                                            <ul class="mega-sub-item">
                                                <li><a href="elements-accordion.html">Accordion</a></li>
                                                <li><a href="elements-tab.html">Tab</a></li>
                                                <li><a href="elements-table.html">table</a></li>
                                                <li><a href="elements-progressbar.html">progressbar</a></li>
                                                <li><a href="elements-alerts.html">Alerts</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-sub"><a href="#">Column two</a>
                                            <ul class="mega-sub-item">
                                                <li><a href="elements-audio.html">Audio</a></li>
                                                <li><a href="elements-video.html">vido</a></li>
                                                <li><a href="elements-gallery.html">gallery one</a></li>
                                                <li><a href="gallery.html">Gallery two</a></li>
                                                <li><a href="elements-typhography.html">typhogrpahy</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-sub"><a href="#">Column Three</a>
                                            <ul class="mega-sub-item">
                                                <li><a href="elements-testimonail.html">Testimonial</a></li>
                                                <li><a href="elements-brand.html">brand</a></li>
                                                <li><a href="elements-team.html">Team</a></li>
                                                <li><a href="elements-button.html">Button</a></li>
                                                <li><a href="elements-map.html">map</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-sub"><a href="#">Column one</a>
                                            <ul class="mega-sub-item">
                                                <li><a href="elements-food-item-1.html">Food menu item 1</a></li>
                                                <li><a href="elements-food-item-2.html">Food menu item 2</a></li>
                                                <li><a href="elements-contact.html">Contact form</a></li>
                                                <li><a href="elements-food-product.html">Food product</a></li>
                                                <li><a href="elements-no-sticky.html">No sticky</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">Feature</a>
                                    <ul class="dropdown_menu">
                                        <li><a href="404.html">404</a></li>
                                        <li><a href="contact-us.html">contact us</a></li>
                                        <li class="dropdown-mega"><a href="index.html">home page</a>
                                            <ul class="dropdown-submenu">
                                                <li><a href="index-2.html">Animated text</a></li>
                                                <li><a href="index-3.html">Video background</a></li>
                                                <li><a href="index-4.html">Parallax verison</a></li>
                                                <li><a href="index-box.html">Box layout</a></li>
                                                <li><a href="index-box-fixed.html">Box layout fixed</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="blog.html">Blog page</a></li>
                                        <li><a href="blog-details.html">Blog details</a></li>
                                        <li class="dropdown-mega"><a href="#">Extra elements</a>
                                            <ul class="dropdown-submenu">
                                                <li><a href="elements-accordion.html">Accordion</a></li>
                                                <li><a href="elements-tab.html">Tab</a></li>
                                                <li><a href="elements-progressbar.html">progress bar</a></li>
                                                <li><a href="elements-table.html">Table</a></li>
                                                <li><a href="elements-audio.html">Audio</a></li>
                                                <li><a href="elements-video.html">video</a></li>
                                                <li><a href="elements-alerts.html">Alerts</a></li>
                                                <li><a href="elements-typhography.html">Typhography</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="food-menu.html">Food menu</a></li>
                                        <li><a href="gallery.html">gallery</a></li>
                                    </ul>
                                </li>
                                <li><a href="gallery.html">gallery</a></li>
                                <li><a href="#">pricing</a></li>
                                <li><a href="blog.html">blog</a></li>
                                <li><a href="contact-us.html">contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Mobile menu end -->
            </div>
           <!--Header section end-->