<?php 
/* 
Template Name: Homepage
*/ 
?>

<?php get_header(); ?>

			<?php if ( of_get_option('of_slider_cat') ) { ?>
				<div id="header-slider" class="flexslider <?php if ( of_get_option('of_slider_size') == '940' ) { ?>header-slider-sized<?php } ?> <?php if ( of_get_option('of_slider_size') == 'noslider' ) { ?>no-slider<?php } ?>">
					<ul class="slides">
					<?php $slidercat = of_get_option('of_slider_cat', 'no entry' ); ?>
					<?php query_posts('showposts=12&cat='.$slidercat); ?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
						<li class="showcase">
							<div class="showcase-image">
								<?php if ( has_post_thumbnail() ) { ?>
									<?php if ( of_get_option('of_slider_action') == 'linkpost' ) { ?>
										<a href="
											<?php if ( get_post_meta($post->ID, 'slidelink', true) ) { ?>
												<?php echo get_post_meta($post->ID, 'slidelink', true) ?>
											<?php } else { ?>
												<?php the_permalink(); ?>
											<?php } ?>
										"><?php the_post_thumbnail( 'full-size' ); ?></a>
										<?php } else { ?>									
										<a class="showcase-toggle" href="#"><?php the_post_thumbnail( 'full-size' ); ?></a>
									<?php } ?>
								<?php } ?>
							</div>
							
							<a class="close-slide showcase-toggle" href="#">X</a>
							
							<div class="showcase-info">
								<!-- hide title -->
								<div class="showcase-title <?php if ( get_post_meta($post->ID, 'hidetitle', true) || of_get_option('of_slider_action') == 'linkpost' ) { ?>hide-title<?php } else {} ?>">
									<h2><a class="showcase-toggle hide1" href="#" title=""><?php the_title(); ?></a></h2>
									
									<div class="hide2">
										<h2>
											<a href="
												<?php if ( get_post_meta($post->ID, 'slidelink', true) ) { ?>
													<?php echo get_post_meta($post->ID, 'slidelink', true) ?>
												<?php } else { ?>
													<?php the_permalink(); ?>
												<?php } ?>
											"><?php the_title(); ?>
											</a>
										</h2>
									</div>
									
								</div>
				
								<div class="showcase-text">
									<div class="showcase-meta">
										<ul>
											<li><?php the_author_link(); ?></li>
											<li><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></li>
											<li class="showcase-cat"><?php the_category(', '); ?></li>
										</ul>
									</div>
									
									<?php the_excerpt(); ?>
									<a class="showcase-more" href="
										<?php if ( get_post_meta($post->ID, 'slidelink', true) ) { ?>
											<?php echo get_post_meta($post->ID, 'slidelink', true) ?>
										<?php } else { ?>
											<?php the_permalink(); ?>
										<?php } ?>
									" title="<?php the_title(); ?>">- <?php _e('Continue Reading','okay'); ?> -</a>
								</div>
							</div>
						</li><!-- showcase -->
					
					<?php endwhile; ?>
					<?php endif; ?>
					</ul>
				</div>
			<?php } ?>
			
			<div class="clear"></div>			
						
			<div id="sections-wrap">			
				<div id="sections" class="clearfix">
					
					<?php if ( is_active_sidebar(1) ) { ?>
						<div class="section top-section">
							<div class="section-widget-wrap">
								<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Text Boxes') ) : else : ?>		
								<?php endif; ?>
							</div>
						</div>
					<?php } else { }; ?>
					
					
					<?php if ( is_active_sidebar(2) || is_active_sidebar(3) ) { ?>
						<div class="section mid-section">
	
							<div class="mid-left">
								<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Homepage Mid Left') ) : else : ?>		
								<?php endif; ?>
							</div>
							
							<div class="mid-right">
								<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Homepage Mid Right') ) : else : ?>
								<?php endif; ?>
							</div>
							
						</div>
					<?php } else { }; ?>
					
					
					<?php if ( of_get_option('of_portfolio_cat') ) { ?>
					<div class="section bottom-section">
					
						<div class="home-portfolio">
							
							<div class="home-portfolio-left">
								<ul class="tabs"><li><a href="#" class="current"><?php _e('Latest Work','okay'); ?></a></li>
									<li><a href="#"><?php _e('Recent Posts','okay'); ?></a></li>
								</ul>
								
								<div class="clear"></div>			
								
								<div class="panes">
									<div class="pane" style="display: block; ">
									<?php if ( of_get_option('of_portfolio_text') ) { ?>
										<?php echo of_get_option('of_portfolio_text'); ?>
									<?php } ?>									
									</div>
									<div class="pane" style="display: none; ">
										<ul class="recent-posts">
											<?php query_posts('showposts=2&cat='.of_get_option('of_blog_cat')); ?>	
											<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
												<li class="recent-post">
													<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
													
													<p class="recent-meta"><?php echo get_the_date(); ?>  -  <a href="<?php the_permalink(); ?>/#comments" title="comments"><?php comments_number('0 Comments','1 Comment','% Comments'); ?></a></p>
													<div class="excerpt"><?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,20);?> <a href="<?php the_permalink(); ?>"><span class="recent-read-more">...</span></a></div>
												</li>
											<?php endwhile; ?>
											<?php endif; ?>
										</ul>
									</div>
								</div>
								
							</div><!-- portfolio left -->
							
							<div class="home-portfolio-right">
								<div class="home-portfolio-item-wrap">
									<?php $portcat = of_get_option('of_portfolio_cat', 'no entry' ); ?>
									<?php query_posts('showposts=6&cat='.$portcat); ?>
										
									<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
										<div class="home-portfolio-item">
											<?php if ( has_post_thumbnail() ) { ?>
											<a class="home-portfolio-item-img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'home-portfolio' ); ?></a>
											<?php } ?>
											<div class="clear"></div>
											<a class="portfolio-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</div>
									<?php endwhile; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					
				</div><!-- sections -->	
			</div><!-- sections wrap -->
			
<?php get_footer(); ?>