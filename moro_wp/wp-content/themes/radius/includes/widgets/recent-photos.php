<?php
/*-----------------------------------------------------------------------------------*/
/* Okay Recent Photos Widget
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'load_ok_recent_photos_widget' );

function load_ok_recent_photos_widget() {
	register_widget( 'okay_recent_photos' );
}

class okay_recent_photos extends WP_Widget {

	function okay_recent_photos() {
	$widget_ops = array( 'classname' => 'ok-recent-photos', 'description' => __('Okay Recent Photos Widget', 'ok-recent-photos') );
	$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ok-recent-photos' );
	$this->WP_Widget( 'ok-recent-photos', __('Okay Recent Photos Widget', 'ok-recent-photos'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {

		extract( $args );
		$phototitle = $instance['photo-title'];
		$photocount = $instance['photo-count'];
		$photocat = $instance['photo-cat'];
		
		echo $before_widget;
?>

		
			<?php if ( $phototitle ) { ?>
				<h2><?php echo $instance['photo-title']; ?></h2>
			<?php } ?>
			
			<ul class="recent-photos">
				<?php query_posts('cat='.$instance["photo-cat"].'&showposts='.$instance["photo-count"]); ?>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					<?php if ( has_post_thumbnail() ) { ?>
						<li class="recent-photo">
							<a rel="recent_photos" class="fancybox" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'recent-photo' ); ?></a>
						</li>
					<?php } ?>
					
				<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
			</ul>
	
			

<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['photo-title'] = $new_instance['photo-title'];
		$instance['photo-count'] = $new_instance['photo-count'];
		$instance['photo-cat'] = $new_instance['photo-cat'];		
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'photo-title' => '', 'photo-count' => '', 'photo-cat' => '') );
		$instance['photo-title'] = $instance['photo-title'];
		$instance['photo-count'] = $instance['photo-count'];
		$instance['photo-cat'] = $instance['photo-cat'];
?>
			<p>
				<label for="<?php echo $this->get_field_id('photo-title'); ?>"><?php _e('Recent Photos Title:','okay'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('photo-title'); ?>" name="<?php echo $this->get_field_name('photo-title'); ?>" type="text" value="<?php echo $instance['photo-title']; ?>" /></label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('photo-count'); ?>"><?php _e('Recent Photos Count','okay'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('photo-count'); ?>" name="<?php echo $this->get_field_name('photo-count'); ?>" type="text" value="<?php echo $instance['photo-count']; ?>" /></label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('photo-cat'); ?>"><?php _e('Recent Photos Category','okay'); ?></label>
				<?php 
				  wp_dropdown_categories( array(
				    'name' => $this->get_field_name( 'photo-cat' ),
				    'selected' => $instance["photo-cat"],
				    ) );
				
				?>
			</p>
              
  <?php
	}
}
?>