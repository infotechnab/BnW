 <?php if(!empty($headerlogo)){
            foreach($headerlogo as $logo){
                $hlogo = $logo->description;
            }
        } 
        if(!empty($headertitle)){
            foreach($headertitle as $title){
                $htitle = $title->description;
            }
        } ?>
<div id="undefined-sticky-wrapper" class="sticky-wrapper" style="height: 70px;"><div role="navigation" class="navbar navbar-default navbar-static-top yamm sticky">
            <div class="container">
                <div class="navbar-header">
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo base_url(); ?>" class="navbar-brand" id='anchor_nav'><img alt="<?php echo $htitle; ?>" src="<?php echo base_url().'content/uploads/images/'.$hlogo; ?>"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown active ">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Home <i class="fa fa-angle-down"></i></a>
                            <ul aria-labelledby="dropdownMenu" role="menu" class="dropdown-menu multi-level">
                                <li class="dropdown-submenu">
                                    <a href="#" tabindex="-1">home - revolution </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index.html"> Full width</a></li>
                                        <li><a href="home-revolution-boxed.html">Revolution Boxed</a></li>
                                        <li><a href="home-revolution-fullscreen.html">Revolution Fullscreen</a></li>
                                        <li><a href="ken-burns.html">Ken burns Slider</a></li>
                                    </ul>
                                </li>
                                <li><a href="home-carousel.html">Home - Carousel</a></li>
                                <li><a href="home-2.html">Home - Flex slider</a></li>
                                <li><a href="home-parallax.html">Home - Parallax</a></li>
                                <li><a href="home-video.html">Home - Video</a></li>
                                <li><a href="home-boxed.html">Home - Boxed</a></li>
                                <li><a href="home-events.html">Home - Events</a></li>                                 
                                <li><a href="home-shop.html">Home - Shop</a></li>
                                <li><a href="one-page/index.html">One page layout</a></li>
                                <li class="dropdown-submenu">
                                    <a href="#" tabindex="-1">Multi level menu </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"> menu level 2</a></li>
                                        <li class="dropdown-submenu">
                                            <a href="#" tabindex="-1">menu level 2 </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"> menu level 3</a></li>
                                                <li><a href="#"> menu level 3</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!--menu home li end here-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle " href="#">Portfolio <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="dropdown-menu multi-level">
                                <li class="dropdown-submenu">
                                    <a href="#" tabindex="-1">Grid Text Boxed </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="portfolio-2.html"> 2 Columns</a></li>
                                        <li><a href="portfolio-3.html"> 3 Columns</a></li>
                                        <li><a href="portfolio-4.html"> 4 Columns</a></li>                         

                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" tabindex="-1">Grid Boxed </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="grid-portfolio-2-no-text.html">2 Columns</a></li>
                                        <li><a href="grid-portfolio-3-no-text.html">3 Columns</a></li>
                                        <li><a href="grid-portfolio-4-no-text.html">4 Columns</a></li>                         

                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" tabindex="-1">No space Full width </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="portfolio-full-width-2.html">2 columns</a></li>
                                        <li><a href="portfolio-full-width-3.html">3 columns</a></li>
                                        <li><a href="portfolio-full-width-4.html">4 columns</a></li>                         
                                        <li><a href="portfolio-full-width-5.html">5 columns</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" tabindex="-1">No Space Boxed </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="portfolio-no-space-bx-2.html"> 2 Columns</a></li>
                                        <li><a href="portfolio-no-space-bx-3.html"> 3 Columns</a></li>
                                        <li><a href="portfolio-no-space-bx-4.html"> 4 Columns</a></li>                         

                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" tabindex="-1">Portfolio Masonry </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="masonry-portfolio-3.html"> 3 Columns</a></li>
                                        <li><a href="masonry-portfolio-4.html"> 4 Columns</a></li>
                                        <li><a href="masonry-portfolio-full.html"> Full Width</a></li>                         

                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" tabindex="-1">Portfolio Items</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="portfolio-single.html">Single item</a></li>
                                        <li><a href="portfolio-single-2.html">Single item 2</a></li>                                                             
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        <!--menu Portfolio li end here-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Blog <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="blog-full.html">Blog - full width</a></li>
                                <li><a href="blog-leftimg.html">Blog - left image</a></li>
                                <li><a href="blog-sidebar.html">Blog - sidebar</a></li>
                                <li><a href="blog-2col.html">Blog - 2 column</a></li>
                                <li><a href="blog-timeline.html">Blog - Timeline</a></li>
                                <li><a href="blog-masonary.html">Blog - Masonry</a></li>
                                <li><a href="blog-single.html">Blog - Single</a></li>
                            </ul>
                        </li>
                        <!--menu blog li end here-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Pages <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="about.html">About</a></li>
                                <li><a href="me.html">About - Me</a></li>

                                <li><a href="services.html">Services</a></li>
                                <li><a href="team.html">Our Team</a></li>
                                <li><a href="pricing.html">Our Pricing</a></li>                                
                                <li><a href="faq.html">FAQS</a></li> 
                                <li><a href="email-template.html">Email Template</a></li>
                                <li class="dropdown-submenu">
                                    <a href="#" tabindex="-1">Contact </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="contact.html"> Contact default</a></li>
                                        <li><a href="contact-advanced.php">Contact advanced</a></li>
                                        <li><a href="contact-option.php">Contact option</a></li>
                                        <li><a href="contact-flat.php">Contact Flat</a></li>
                                    </ul>
                                </li>                                          
                                <li><a href="search-results.html">Search Results</a></li>                                
                                <li><a href="career.html">Career</a></li>
                                <li><a href="gallery.html">Gallery</a></li>
                                <li><a href="invoice.html">Invoice</a></li>
                                <li><a href="process.html">Our Process</a></li>
                            </ul>
                        </li>
                        <!--menu pages li end here-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Shop <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="dropdown-menu">                              
                                <li><a href="shop-2col.html">2 columns sidebar</a></li>
                                <li><a href="shop-3col.html">3 columns sidebar</a></li>
                                <li><a href="shop-4col.html">4 columns full width</a></li>
                                <li><a href="product-list.html">Product list</a></li>
                                <li><a href="product-detail.html">Single product</a></li>
                                <li><a href="cart.html">Shopping cart</a></li>                                
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="shop-login.html">Login</a></li>
                                <li><a href="shop-register.html">Register</a></li>

                            </ul>
                        </li> <!--menu Shop li end here-->
                        <!--mega menu-->
                        <li class="dropdown yamm-fw">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Features  <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="yamm-content">
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <h3 class="heading">headers &amp; Footers</h3>
                                                <ul class="nav mega-vertical-nav">        
                                                    <li><a href="index.html">Header 1 - Default</a></li>
                                                    <li><a href="header-dark.html">Header 2 - dark </a></li>
                                                    <li><a href="header-transparent.html">header 3 - transparent </a></li>
                                                    <li><a href="header-center-logo.html">header 4 - Logo center </a></li>

                                                    <li><a href="index.html">Footer - 1</a></li>
                                                    <li><a href="footer-2.html">Footer - 2</a></li>
                                                    <li><a href="footer-3.html">Footer - 3 </a></li>
                                                </ul>

                                            </div>
                                            <div class="col-sm-3">
                                                <h3 class="heading">Layout grids </h3>
                                                <ul class="nav mega-vertical-nav">
                                                    <li><a href="full-width.html">Full Width</a></li>                                                    
                                                    <li><a href="left-sidebar.html">Left Sidebar</a></li>
                                                    <li><a href="right-sidebar.html">Right sidebar</a></li>
                                                    <li><a href="both-sidebar.html">Both Sidebar</a></li>
                                                    <li><a href="both-right-sidebar.html">Both Right sidebar</a></li>
                                                    <li><a href="both-left-sidebar.html">Both Left Sidebar</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-3">
                                                <h3 class="heading">Features</h3>
                                                <ul class="nav mega-vertical-nav">
                                                    <li><a href="typography.html">Typography</a></li>
                                                    <li><a href="element.html">Elements</a></li>                                                   
                                                    <li><a href="home-soon.html">Coming Soon</a></li>   
                                                    <li><a href="side-nav.html">side navigation </a></li> 
                                                    <li><a href="testimonials.html">testimonials </a></li> 
                                                </ul>
                                            </div>
                                            <div class="col-sm-3">
                                                <h3 class="heading">MISCELLANEOUS</h3>
                                                <ul class="nav mega-vertical-nav">
                                                    <li><a href="maintenance-page.html">Maintenance page </a></li>
                                                    <li><a href="blank.html">Blank Page</a></li>
                                                    <li><a href="error.html">Error - 404</a></li>
                                                    <li><a href="login-ragister.html">Login / Register</a></li>
                                                    <li><a href="login-ragister-classic.html">Login / Register - Classic </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li> <!--menu Features li end here-->
                        <!--mega menu end-->    

                        <li class="dropdown">
                            <a data-toggle="dropdown" class=" dropdown-toggle" href="#"><i class="fa fa-lock"></i> Sign In</a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-login-box animated fadeInUp">
                                <form role="form">
                                    <h4>Signin</h4>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" placeholder="Username" class="form-control">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" placeholder="Password" class="form-control">
                                        </div>
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                        <a class="btn btn-theme-bg pull-right">Login</a>
                                        <!--                                        <button type="submit" class="btn btn-theme pull-right">Login</button>                 -->
                                        <div class="clearfix"></div>
                                        <hr>
                                        <p>Don't have an account! <a href="#">Register Now</a></p>
                                    </div>
                                </form>
                            </div>
                        </li> <!--menu login li end here-->
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--container-->
        </div></div>