<?php get_header(); global $more; ?>

				<div class="container">
					<div class="content">
						<div class="page-title">
							<h1><?php the_title(); ?></h1>
						</div>
						
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div class="blog_entry">
							<?php if ( has_post_thumbnail() ) { ?>
							<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'blog-image' ); ?></a>
							<?php } ?>
							
							<?php the_content(''); ?>
						</div><!-- blog entry -->
			
						<?php endwhile; ?>
						<?php endif; ?>

					</div><!-- content -->
					
					<?php get_sidebar(); ?>
				</div><!-- container -->

<?php get_footer(); ?>