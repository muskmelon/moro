<?php 
/* 
Template Name: Full-Width
*/ 
?>

<?php get_header(); global $more; ?>

				<div class="container">												
					<div class="content content-full">
						<div class="page-title">
							<h2><?php the_title(); ?></h2>
						</div>
						
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div class="blog_entry">
							<?php if ( has_post_thumbnail() ) { ?>
							<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
							<?php } ?>
							
							<?php the_content(''); ?>
						</div><!-- blog entry -->
			
						<?php endwhile; ?>
						<?php endif; ?>

					</div><!-- content -->
					<div class="clear"></div>
				</div><!-- container -->

<?php get_footer(); ?>