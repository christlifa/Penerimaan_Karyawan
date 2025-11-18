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
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  
    
    
    <!-- Pre Loader
	============================================ -->
	<!--
    <div class="preloader">
		<div class="loading-center">
			<div class="loading-center-absolute">
				<div class="object object_one"></div>
				<div class="object object_two"></div>
				<div class="object object_three"></div>
			</div>
		</div>
	</div>
    -->
  <!-- Body main wrapper start -->
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
                            </div>	-->
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
       
       <?php
        // check jika slider ada yg active
        if($slider_data): 
        $no = 1;
        ?>
           <!--slider section start-->
            <div class="slider-container">
                <!-- Slider Image -->
                <div id="mainSlider" class="nivoSlider slider-image">
                <?php foreach($slider_data as $slider_row): ?>
                    <img src="<?php echo base_url('assets/images/slider/'.$slider_row->gambar);?>" alt="" title="#htmlcaption<?php echo $no; ?>"/>
                <?php 
                    $no++;
                endforeach; 
                ?>
                </div>
            </div>
            <!--slider section end-->
        <?php endif; ?>
        
        <!--popular dises start-->
        <div class="popular-dishes">
            <div class="bg-img-2 ptb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="section-title text-center grey_bg">
                                <h2>Our Popular Dishes</h2>
                                <p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="dises-list">

                                    <div class="dises-show text-center">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="single-disesh">
                                                <div class="disesh-img">
                                                    <a href="#"><img class="img img-responsive" src="<?php echo base_url('assets/images/paket/ramadhan1.png')?>" alt=""></a>
                                                </div>
                                                <div class="disesh-desc pt-50">
                                                    <h3><a href="">Ramadhan</a></h3>                                                    
                                                    <p>
                                                        Nikmati paket ramadhan disini.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="single-disesh">
                                                <div class="disesh-img">
                                                    <a href="#"><img class="img img-responsive" src="<?php echo base_url('assets/images/paket/makansiang.png')?>" alt=""></a>
                                                </div>
                                                <div class="disesh-desc pt-50">
                                                    <h3><a href="">Makan Siang</a></h3>
                                                    <p>
                                                        Waktu pengantaran 10:00 - 12:00 <br>
                                                        Waktu konsumsi 12:00 - 14:00
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="single-disesh">
                                                <div class="disesh-img">
                                                    <a href="#"><img class="img img-responsive" src="<?php echo base_url('assets/images/paket/makanmalam.png')?>" alt=""></a>
                                                </div>
                                                <div class="disesh-desc pt-50">
                                                    <h3><a href="">Makan Malam</a></h3>
                                                    <p>
                                                        Waktu pengantaran 10:00 - 12:00 <br>
                                                        Waktu konsumsi 12:00 - 14:00
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>	
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--popular dises end-->

        <!--Footer section start-->
        <div class="footer">
            <div class="footer-top ptb-100 grey-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="single-footer">
                                <h3 class="single-footer-title">Contact us</h3>
                                <div class="single-footer-details mt-30">
                                    <p class="addresses">
                                        <strong>Address:</strong> House No 08, Ro ad No 08<br>Din Bari, Dhaka, Bangladesh
                                    </p>
                                    <p class="email">
                                       <strong> Email:</strong> Username@gmail.com<br>Damo@gmail.com
                                    </p>
                                    <p class="phon">
                                        <strong>Phone:</strong>(+660 256 24857)<br>(+660 256 24857)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="single-footer">
                                <h3 class="single-footer-title">open hours</h3>
                                <div class="single-footer-details mt-30">
                                    <p>Lorem ipsum dolor sit amet,  tore latthi dimu consectetueiusmodm dost   </p>
                                    <div class="open-list">
                                        <ul>
                                            <li>Monday- Friday. . . . . . . . . . . . . <span>8 AM - 5PM</span></li>
                                            <li>Sunday. . . . . . . . . . . . . . . . . . . . . <span>12 AM - 5PM</span></li>
                                            <li>Saturday . . . . . . . . . . . . . . . . . . . . . . . . . . . <span>Close</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="single-footer instagram">
                                <h3 class="single-footer-title">Paket Terlaris</h3>
                                <div class="single-footer-details mt-30">
                                   <ul>
                                       <li><a href="#"><img src="<?php echo base_url('assets/images/instagram/1.jpg'); ?>" alt=""></a></li>
                                       <li><a href="#"><img src="<?php echo base_url('assets/images/instagram/2.jpg'); ?>" alt=""></a></li>
                                       <li><a href="#"><img src="<?php echo base_url('assets/images/instagram/3.jpg'); ?>" alt=""></a></li>
                                       <li><a href="#"><img src="<?php echo base_url('assets/images/instagram/4.jpg'); ?>" alt=""></a></li>
                                       <li><a href="#"><img src="<?php echo base_url('assets/images/instagram/5.jpg'); ?>" alt=""></a></li>
                                       <li><a href="#"><img src="<?php echo base_url('assets/images/instagram/6.jpg'); ?>" alt=""></a></li>
                                   </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="single-footer newsletter">
                                <h3 class="single-footer-title">Tentang Kami</h3>
                                <div class="single-footer-details mt-30">
                                    <p>
                                        Mamam berasal dari kata makan yg artinya mamam
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            <div class="copyright text-center ptb-20 white-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <p>
                            Copyright &copy; <?php echo $this->config->item('app_copyright'); ?>. 
                            Created by <a target="_blank" href="http://camar-software.com">Camar Software</a>
                            - <?php echo $this->config->item('app_name'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <!--Footer section end-->
    </div>
    </div>
    <!-- Body main wrapper end -->
    
   
    <!-- Placed js at the end of the document so the pages load faster -->

    
    <!-- All js plugins included in this file. -->
    <script src="<?php echo base_url('bower_components/jquery/dist/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.nivo.slider.pack.js');?>"></script>
    <script src="<?php echo base_url('assets/js/isotope.pkgd.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/ajax-mail.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.magnific-popup.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.counterup.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/animated-headlines.js');?>"></script>
    <script src="<?php echo base_url('assets/js/waypoints.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.collapse.js');?>"></script>
    <script src="<?php echo base_url('assets/js/plugins.js');?>"></script>
    <script src="<?php echo base_url('assets/js/main.js');?>"></script>

</body>

</html>