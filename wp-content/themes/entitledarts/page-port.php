<?php 
/*
	Template Name: Portfolio
*/
?>
<?php get_header(); ?>

		<section class="main-bg portfolio-bg sectionpd">
			<div class="container">
				<div class="row mt-50 mb-50">
					<div class="col-sm-12 p-0">
						<div class="page-heading text-center">1000s of Music<br>Lots of Drinks<br>& lots of efforts</div>
					</div>
				</div>

				<div class="text-center">
					<div class="filters-button-group">
						<button class="button is-checked" data-filter=".category-all">All</button>
						<button class="button" data-filter=".category-branding">Branding</button>
						<button class="button" data-filter=".category-websites">Websites</button>
						<button class="button" data-filter=".category-apps">Apps</button>
						<button class="button" data-filter=".category-creatives">Creatives</button>
						<button class="button" data-filter=".category-photography">Photography</button>
					</div>
				</div>
			</div>

			<div class="portfolio-section">
				<div class="grid" data-masonry='{ "itemSelector": ".element-item", "columnWidth": 0 }'>
					<?php query_posts('post_type=Gallery&post_status=publish&posts_per_page=20&orderby=id&order=asc&paged='. get_query_var('paged')); ?>
						<?php if( have_posts() ): ?>
							<?php while( have_posts() ): the_post(); ?>
								<div <?php post_class( 'element-item'); ?>>
									<?php $post_id = get_the_ID(); ?>
									<div id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
										<?php the_post_thumbnail(''); ?>
										
										<a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
											<div class="hover-bg">
												<div class="hover-content">
													<h2><?php the_title(); ?></h2>
													<p>Logo Design</p>
												</div>
											</div>
										</a>
		    						</div>
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

			<div class="col-sm-12 p-0 mt-50">
				<div id="load-images" class="page-heading text-center">More More!</div>
			</div>

		</section>

	    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-content zoom">
	            <div class="container">
	                <div class="row">
	                	<div class="close-modal" data-dismiss="modal">
			                <div class="lr"></div>
			                <div class="rl"></div>
			            </div>
	                    <div class="col-sm-12">
	                        <div class="modal-body">
	                            <!-- Project Details Go Here -->
								<?php query_posts('post_type=Gallery&post_status=publish&posts_per_page=20&orderby=id&order=asc&paged='. get_query_var('paged')); ?>
									<?php if( have_posts() ): ?>
										<?php the_post(); ?>
											<div id="post-<?php get_the_ID(); ?>" <?php post_class(); ?>>
	                            				<?php the_post_thumbnail(''); ?>
	                            				<h2 class="project-title"><?php the_title(); ?> <span class="post-date"><?php echo get_the_date('j F Y'); ?></span></h2>
	                            				<h2 class="project-sub-title">Client Project</h2>
	                            				<?php the_content(); ?>

								        		<div class="col-sm-12 mt-50 text-center fun">
													<div class="col-sm-3">
														<img src="images/portfolio/icon/love-fill.png">
														<h1 class="fs-50 fw-8 mb-10">15</h1>
														<h2 class="fs-18 fw-8 text-uppercase">Loves</h2>
													</div>
													<div class="col-sm-3">
														<img src="images/portfolio/icon/comments.png">
														<h1 class="fs-50 fw-8 mb-10">05</h1>
														<h2 class="fs-18 fw-8 text-uppercase">Comments</h2>
													</div>
													<div class="col-sm-3">
														<img src="images/portfolio/icon/share.png">
														<h1 class="fs-50 fw-8 mb-10">12</h1>
														<h2 class="fs-18 fw-8 text-uppercase">Shares</h2>
													</div>
													<div class="col-sm-3">
														<img src="images/portfolio/icon/time.png">
														<h1 class="fs-50 fw-8 mb-10">02<span>hrs</span></h1>
														<h2 class="fs-18 fw-8 text-uppercase">Time Taken</h2>
													</div>
													<div class="col-sm-3">
														<img src="images/portfolio/icon/team.png">
														<h1 class="fs-50 fw-8 mb-10">01</h1>
														<h2 class="fs-18 fw-8 text-uppercase">Team Size</h2>
													</div>
												</div>

												<div class="comments-section">
													<div class="comment">
														<h2 class="user-name">John Doe</h2>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Virtutis, magnitudinis animi, patientiae, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Virtutis, magnitudinis animi, patientiae,</p>
													</div>

													<div class="comment">
														<div class="user-name">John Doe</div>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Virtutis, magnitudinis animi, patientiae, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Virtutis, magnitudinis animi, patientiae,</p>
													</div>
												</div>

												<div class="comment-form">
													<h2>Leave a Comment</h2>
													<form action="">
														<div class="form-group col-sm-6">
															<input type="text" class="form-control" id="" placeholder="Name" name="">
														</div>

														<div class="form-group col-sm-6">
															<input type="email" class="form-control" id="" placeholder="Email Id" name="">
														</div>

														<div class="form-group col-sm-12">
															<textarea class="form-control" rows="5" id="" placeholder="Add a Comment"></textarea>
														</div>
														<div class="col-sm-12 text-center mt-30">
															<button type="submit" class="btn btn-light">Submit</button>
														</div>
													</form>
												</div>

									            <div class="row col-sm-12 p-0 mt-50 mb-50">
													<div class="main-hading text-center">Related Works</div>
												</div>

											</div>
								        <?php ?>
								        
									<?php else: ?>

									<div id="post-404" class="noposts">
										<p><?php _e('None found.','example'); ?></p>
								    </div><!-- /#post-404 -->

								<?php endif; wp_reset_query(); ?>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div><!--End Portfolio 1-->

<?php get_footer(); ?>