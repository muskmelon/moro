<?php 
/* 
Template Name: Social Dashboard
*/ 
?>

<?php get_header(); global $more; ?>
				
				<div class="container">
					<div class="content content-full">
						
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
						<div class="page-title">
							<h1><?php the_title(); ?></h1>
						</div>

						<div class="blog_entry">
							<div class="social-wrap">
								<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Social Page') ) : else : ?>		
								<?php endif; ?>
							</div>
						</div><!-- blog entry -->
			
						<?php endwhile; ?>
						<?php endif; ?>

					</div><!-- content -->
					<div class="clear"></div>
				</div><!-- container -->

<?php get_footer(); ?>