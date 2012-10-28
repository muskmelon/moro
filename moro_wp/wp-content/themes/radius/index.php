<?php get_header(); global $more; ?>

			<div class="container">					
				<div class="content">
					<div class="page-title">
						<?php if(is_search()) { ?>
							<h1><?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $count = $allsearch->post_count; echo $count . ' '; wp_reset_query(); ?><?php _e('Search results for','okay'); ?> "<?php the_search_query() ?>" </h1>
						<?php } else if(is_tag()) { ?>
							<h1><?php _e('Tag','okay'); ?>: <?php single_tag_title(); ?></h1>
						<?php } else if(is_day()) { ?>
							<h1> <?php _e('Archive','okay'); ?>: <?php echo get_the_date(); ?></h1>
						<?php } else if(is_month()) { ?>
							<h1><?php _e('Archive','okay'); ?>: <?php echo get_the_date('F Y'); ?></h1>
						<?php } else if(is_year()) { ?>
							<h1><?php _e('Archive','okay'); ?>: <?php echo get_the_date('Y'); ?></h1>
						<?php } else if(is_404()) { ?>
							<h1><?php _e('404 - Page Not Found','okay'); ?></h1>
						<?php } else if(is_category()) { ?>
							<h1><?php _e('Category','okay'); ?>: <?php single_cat_title(); ?></h1>
						<?php } else if(is_author()) { ?>
							<h1><?php _e('Posts by Author','okay'); ?>: <?php the_author_posts(); ?> <?php _e('posts by','okay'); ?> <?php
							$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); echo $curauth->nickname; ?></h1>
						<?php } ?>
					</div>
						
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
					<div id="post-<?php the_ID(); ?>" <?php post_class('blog-post clearfix'); ?>>
						
						<?php if ( get_post_meta($post->ID, 'okvideo', true) ) { ?>
							<div class="okvideo">
								<?php echo get_post_meta($post->ID, 'okvideo', true) ?>
							</div>
						<?php } else { ?>
						
						<?php if ( has_post_thumbnail() ) { ?>
						<a class="blog-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'blog-image' ); ?></a>
						<?php } ?>
						
						<?php } ?>
						
						<div class="blog-inside clearfix">	
							<div class="blog-text">	
								<div class="title-meta">
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								</div>
							
								<div class="blog-entry">
									<div class="blog-content">
										<?php the_content(); ?>
									</div>
									
									<?php if(is_single()) { ?>
										<div class="pagelink">
											<?php wp_link_pages(); ?>
										</div>
									<?php } ?>
								</div><!-- blog entry -->
							</div><!-- blog text -->
							
							
							<!-- Show this on full site -->
							<div class="blog-meta">
								<ul class="meta-links">
							    	<li><span class="meta-list"><span class="entypo">+</span> <?php the_author_link(); ?></span></li>
							    	<li><span class="meta-list"><span class="entypo">P</span> <?php echo get_the_date('m/d/Y'); ?></span></li>
							    	<li><span class="meta-list"><span class="entypo">t</span> <span class="tag-wrap"><?php the_category(', ') ?></span></span></li>
							    	<?php the_tags('<li><span><span class="entypo">C</span><span class="tag-wrap">', ', ', '</span></span></li>'); ?>
							    	<li><span class="meta-list"><span class="entypo">9</span> <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__('No Comments',radius),__('1 Comment',radius),__( '% Comments',radius) );?></a></span></li>
							    </ul>
								<div class="clear"></div>
								<ul class="post-share">
									<li class="share-title"><?php _e('Share','okay'); ?></li>
									<li class="twitter">
										<a onclick="window.open('http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank"><?php _e('Twitter','okay'); ?></a>
									</li>
									
									<li class="facebook">
										<a onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title(); ?>"  target="blank"><?php _e('Facebook','okay'); ?></a>
									</li>
									
									<li class="googleplus">
										<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;"><?php _e('Google+','okay'); ?></a>
									</li>
								</ul>
							</div><!-- tags -->
						</div><!-- blog inside -->
						<div class="clear"></div>
					</div><!-- blog post -->
					
					<?php endwhile; ?>
				
					<div class="blog-navigation clearfix">
						<div class="alignleft"><?php next_posts_link( __('&larr; Older Entries','okay') ); ?></div>
						<div class="alignright"><?php previous_posts_link( __('Newer Entries &rarr;','okay') ); ?></div>
					</div>
					
					<?php endif; ?>
					
					<!-- 404 page code -->
					<?php if(is_404()) { ?>
						<div class="intro"><?php _e('Sorry, but the page you are looking for is no longer here. Please use the navigations or the search to find what what you are looking for.','okay'); ?></div>

						<?php include('searchform.php'); ?>
					<?php } ?>
				</div><!-- content -->
	
				<?php get_sidebar(); ?>
		</div><!-- container -->	

<?php get_footer(); ?>