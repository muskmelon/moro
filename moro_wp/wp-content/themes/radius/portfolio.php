<?php 
/* 
Template Name: Portfolio
*/ 
?>

<?php get_header(); global $more; ?>

				<div class="container">
						<div class="filter-bar clearfix">
							<ul class="filter-list filter clearfix"> 
								<li class="entypo active all-projects">d</li>
								<?php 
								$portfoliocat = of_get_option('of_portfolio_cat', 'no entry' );
								$categories = get_categories('child_of='.$portfoliocat.''); 
								//echo '<pre>';
								//print_r($terms);
								foreach($categories as $category) {
									echo '<li class="cat-item '.str_replace('-', '', $category->slug).'"><a href="" title="'.$category->name.' projects">'.$category->name.'</a> </li>'; 
								} 
								?>
							</ul>
							
							<div class="portfolio-nav">
								<?php query_posts( array( 'showposts' => 12, 'cat' => $portfoliocat, 'paged' => get_query_var('paged') ) ); ?>
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								
								<?php endwhile; ?>
									<div class="nav-right"><?php next_posts_link('<span class="next-text">Next Page</span> <span class="next-arrow">&rarr;</span>') ?></div>
									<div class="nav-left"><?php previous_posts_link('<span class="prev-arrow">&larr;</span> <span class="prev-text">Previous Page</span>') ?></div>
								<?php endif; ?>
							</div>
						</div>
						
						<div class="portfolio-full clearfix">
							<div class="filter-posts">
							
							<?php $portfoliocat = of_get_option('of_portfolio_cat', 'no entry' );?>
							<?php query_posts( array( 'showposts' => 12, 'cat' => $portfoliocat, 'paged' => get_query_var('paged') ) ); ?>
							
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							
								<div data-id="post-<?php the_ID(); ?>" data-type="<?php $categories = get_the_category(); $count = count($categories); $i=1; foreach($categories as $category) {	echo str_replace('-', '', $category->slug); if ($i<$count) echo ' '; $i++;} ?>" class="post-<?php the_ID(); ?> <?php $categories = get_the_category(); foreach($categories as $category) {	echo str_replace('-', '', $category->slug).' '; } ?> project portfolio-item-wrap">
									<div class="portfolio-item">
										<?php if ( has_post_thumbnail() ) { ?>
										<a class="portfolio-item-img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'portfolio-image' ); ?></a>
										<?php } ?>
										
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<p>
											<?php
												$categories = get_the_category(); 
												$temp = array();
												foreach($categories as $category) {
													if ($category->category_parent == 0) continue;
													$temp[] = str_replace('-', '', $category->name); 
												} 
												echo implode(", ", $temp);
											?>
										</p>
									</div>
								</div>
								
								<?php endwhile; ?>
								<?php endif; ?>
							</div><!-- filter posts -->
							
							<div class="clear"></div>
							
							<div class="portfolio-nav-mobile">
								<?php query_posts( array( 'showposts' => 12, 'cat' => $portfoliocat, 'paged' => get_query_var('paged') ) ); ?>
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								
								<?php endwhile; ?>
									<div class="nav-right-mobile"><?php next_posts_link('Next Page &rarr;') ?></div>
									<div class="nav-left-mobile"><?php previous_posts_link('&larr; Previous Page') ?></div>
								<?php endif; ?>
							</div>
							
						</div><!-- content -->
						<div class="clear"></div>
				</div><!-- container -->

<?php get_footer(); ?>