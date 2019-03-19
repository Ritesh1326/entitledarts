		<!-- footer -->
		<div class="footer sectionpd pb-0 pt-0">

			<!-- Footer Top -->
			<div class="footer-top pt-200">
				<div class="container">
					<div class="row">
						<div class="footer-top-bg">
							<img src="<?php echo get_template_directory_uri(); ?>/images/footer/bottle.png">
						</div>
						<div class="col-sm-12 text-center pb-30">
							<div class="lets-meet">
								<h1>Let's meet & pop some bottles</h1>
								<h1>and make the day interesting</h1>
							</div>
						</div>

						<div class="col-sm-12 project-form">
							<form class="form-inline">
								<div class="form-group">
									<label for="name">HEY MY NAME IS</label>
									<input type="text" class="form-control" id="name" placeholder="Name">
								</div>
								<div class="form-group">
									<label for="project">AND I WOULD LIKE TO DICUSS</label>
									<input type="text" class="form-control" id="project" placeholder="About a Project.">
								</div>
								<div class="form-group">
									<label for="email">HERE IS MY EMAIL</label>
									<input type="email" class="form-control" id="email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="phone">YOU CAN ALSO REACH ME AT</label>
									<input type="number" class="form-control" id="phone" placeholder="Phone No.">
								</div>
								<div class="form-group form-btn">
									<button type="submit" class="btn btn-dark">Send</button>
								</div>
							</form>
						</div>

						<div class="col-sm-12 text-center mt-30 mb-50" style="float: left;">
							<h1 class="fs-18 fw-7 text-uppercase">COZ, We don't believe in chance. We believe in YOU. And together, we create AWESOME STORY.</h1>
						</div>
					</div>
				</div>

				<div class="footer-top-wave">
					<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/footer/wave-light.png" style="top: 3550px;" data-parallax-speed="0.6" data-max-scroll="6000">
					<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/footer/wave-medium.png" style="top: 3000px;" data-parallax-speed="0.5" data-max-scroll="5850">
					<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/footer/wave-dark.png" style="top: 2500px;" data-parallax-speed="0.4" data-max-scroll="5900">
				</div>

				<div class="footer-top-wave-mobile">
					<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/footer/wave-light.png" style="top: 3050px;" data-parallax-speed="0.5" data-max-scroll="5920">
					<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/footer/wave-medium.png" style="top: 2480px;" data-parallax-speed="0.4" data-max-scroll="5920">
					<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/footer/wave-dark.png" style="top: 1900px;" data-parallax-speed="0.3" data-max-scroll="5920">
				</div>
			</div>

			<!-- Footer Middle -->
			<div class="footer-middle pt-20 pb-100">
				<div class="container">
					<div class="row">
						<div class="footer-news-left">
							<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/footer/news-left.png" style="position: relative; top: 3300px;" data-parallax-speed="0.5" data-max-scroll="6600">
						</div>

						<div class="footer-news-right">
							<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/footer/news-right.png" style="position: relative; top: 2600px;" data-parallax-speed="0.4" data-max-scroll="6700">
						</div>

						<div class="col-sm-12 text-center pb-30">
							<div class="heading">
								<span>Breaking</span><span>News</span>
							</div>
						</div>

						<div class="news-slider owl-theme">
							<?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>
								<?php if( have_posts() ): ?>
        							<?php while( have_posts() ): the_post(); ?>
        								<div class="item">
	    									<div id="post-<?php get_the_ID(); ?>" <?php post_class(); ?>>
        										<a href="<?php the_permalink(); ?>">
        											<div class="news-thumb">
        												<?php the_post_thumbnail('thumbnail'); ?>
        											</div>
        										</a>

        										<div class="news-content">
            										<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            											<?php $content = get_the_content();
            												$trimmed_content = wp_trim_words( $content, 40 )
        												?>
        												<p><?php echo $trimmed_content; ?></p>
            										<p class="date">- <?php echo get_the_date('j M Y'); ?></p>
					    						</div>
            								</div><!-- /#post-<?php get_the_ID(); ?> -->
            							</div>

							        <?php endwhile; ?>

									<div class="navigation">
										<span class="newer"><?php previous_posts_link(__('« Newer','example')) ?></span> <span class="older"><?php next_posts_link(__('Older »','example')) ?></span>
									</div><!-- /.navigation -->

								<?php else: ?>

									<div id="post-404" class="noposts">

									    <p><?php _e('None found.','example'); ?></p>

								    </div><!-- /#post-404 -->

								<?php endif; wp_reset_query(); ?>
						</div>
					</div>
				</div>
			</div>

			<!-- Footer Bottom -->
			<div class="footer-bottom pt-0 pb-0">
				<div class="footer-bottom-bg">
					<img src="<?php echo get_template_directory_uri(); ?>/images/footer/footer-bottom.png">
				</div>

				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<?php
								if(is_active_sidebar('footer-1')){
								dynamic_sidebar('footer-1');
								}
							?>
							<!-- <img class="img-responsive mb-30" src="<?php //echo get_template_directory_uri(); ?>/images/footer/footer-logo.png">
							<p class="fs-12">Entitledarts is a creative company in constant pursuit of creating design & products that move people's hearts. We've been helping businesses to design and develop digital products since 2009, with a creative team in India.</p>
							<div class="subscribe-form">
							    <form action="">
						      		<input type="text" placeholder="SUBSCRIBE OUR NEWSLETTER" name="search">
							      	<button type="submit"><span class="lnr lnr-arrow-right"></span></button>
							    </form>
					   		</div> -->
						</div>

						<div class="col-md-3">
							<?php
								if(is_active_sidebar('footer-2')){
								dynamic_sidebar('footer-2');
								}
							?>
							<!-- <div class="footer-menu">
								<ul>
									<li><a href="index.html">About Us</a></li>
									<li><a href="index.html">Services</a></li>
									<li><a href="index.html">Pricing</a></li>
									<li><a href="index.html">Terms & Condition</a></li>
									<li><a href="index.html">Privacy Policy</a></li>
									<li><a href="index.html">Site Map</a></li>
									<li><a href="index.html">Contact</a></li>
								</ul>
							</div> -->
						</div>

						<div class="col-md-3">
							<?php
								if(is_active_sidebar('footer-3')){
								dynamic_sidebar('footer-3');
								}
							?>
							<!-- <div class="contact-detail">
								<h1><a href="tel:+040 29805098">+040 29805098</a></h1>
								<p class="address">VR Sunshine Tower, St. #3 , patrika nagar, madhapur, HYDERABAD - 81, T.S, INDIA</p>
								<p class="info-mail"><a href="mailto:info@entitledarts.com">info@entitledarts.com</a></p>
								<h1><a href="tel:8431 mi">8431 mi</a></h1>
								<p>From United State</p>
							</div> -->
						</div>

						<div class="col-md-3">
							<?php
								if(is_active_sidebar('footer-4')){
								dynamic_sidebar('footer-4');
								}
							?>
							<!-- <div class="download-detail">
								<h1>Download</h1>
								<a href=""><img src="<?php //echo get_template_directory_uri(); ?>/images/footer/ppt-icon.png"> ENTITLEDARTS PPT</a>
								<a href=""><img src="<?php //echo get_template_directory_uri(); ?>/images/footer/pdf-icon.png"> ENTITLEDARTS PDF</a>
							</div> -->
						</div>
					</div>

					<div class="row">
						<?php if ( get_option('footersocial') ) { ?>
						<div class="col-sm-12 footer-social text-center">
							<ul>
								<li><a href="<?php echo get_option('twitter_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/footer/social-icon/twitter.png"></a></li>
								<li><a href="<?php echo get_option('facebook_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/footer/social-icon/facebook.png"></a></li>
								<li><a href="<?php echo get_option('youtube_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/footer/social-icon/youtube.png"></a></li>
								<li><a href="<?php echo get_option('linkedin_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/footer/social-icon/linkedin.png"></a></li>
								<li><a href="<?php echo get_option('googleplus_url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/footer/social-icon/google-plus.png"></a></li>
							</ul>
						</div>
						<?php } ?>

						<div class="col-sm-12 footer-copyright text-center">
							<p><?php echo get_option('footer_copyright_text'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer -->
        
        <?php if ( get_option('scrolltotop') ) { ?>
        <div id="slidebox" class="scrolltop">
            <a href="#" onClick="scrollToTop();return false"><span class="lnr lnr-arrow-up"></span></a>
        </div>
        <?php } ?>
        		
		<!-- Libraries -->
		<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/lightbox.min.js"></script>
		<?php if ( get_option('multiparalax') ) { ?>
		<script src="<?php echo get_template_directory_uri(); ?>/js/parallax.js"></script>
		<?php } ?>
        <!-- Scripts -->
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.min.js"></script>
		<!-- Main -->
		<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
	
</body>
</html>