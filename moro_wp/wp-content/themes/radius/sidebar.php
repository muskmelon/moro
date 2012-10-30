				<div id="sidebar-wrap">
					<div id="sidebar">
						<a id="sidebar-close2" href="#" title="close"><span>X</span> <?php _e('Close Panel','okay'); ?></a>
						
						<div class="widget">
							<div class="social-box">
								<div class="social-icons">
									<?php if ( of_get_option('twitter_icon') ) { ?>
										<a href="<?php echo of_get_option('twitter_icon'); ?>" title="twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-twitter.png" alt="twitter" /></a>
									<?php } ?>
									
									<?php if ( of_get_option('google_icon') ) { ?>
										<a href="<?php echo of_get_option('google_icon'); ?>" title="google"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-google.png" alt="google" /></a>
									<?php } ?>
									
									<?php if ( of_get_option('dribbble_icon') ) { ?>
										<a href="<?php echo of_get_option('dribbble_icon'); ?>" title="dribbble"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-dribbble.png" alt="dribbble" /></a>
									<?php } ?>
									
									<?php if ( of_get_option('facebook_icon') ) { ?>
										<a href="<?php echo of_get_option('facebook_icon'); ?>" title="facebook"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-facebook.png" alt="facebook" /></a>
									<?php } ?>
									
									<?php if ( of_get_option('vimeo_icon') ) { ?>
										<a href="<?php echo of_get_option('vimeo_icon'); ?>" title="vimeo"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-vimeo.png" alt="vimeo" /></a>
									<?php } ?>
									
									<?php if ( of_get_option('tumblr_icon') ) { ?>
										<a href="<?php echo of_get_option('tumblr_icon'); ?>" title="tumblr"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-tumblr.png" alt="tumblr" /></a>
									<?php } ?>
									
									<?php if ( of_get_option('linkedin_icon') ) { ?>
										<a href="<?php echo of_get_option('linkedin_icon'); ?>" title="linkedin"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-linkedin.png" alt="linkedin" /></a>
									<?php } ?>
									
									<?php if ( of_get_option('flickr_icon') ) { ?>
										<a href="<?php echo of_get_option('flickr_icon'); ?>" title="flickr"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-flickr.png" alt="flickr" /></a>
									<?php } ?>
									
									<?php if ( of_get_option('rss_icon') ) { ?>
										<a href="<?php echo of_get_option('rss_icon'); ?>" title="rss"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-rss.png" alt="rss" /></a>
									<?php } ?>
								</div><!-- icons -->
							</div><!-- social box -->
						</div><!-- widget -->
						
						<?php dynamic_sidebar('Sidebar'); ?>
					</div><!-- sidebar -->
				</div><!-- sidebar wrap-->
				<div class="clear"></div>