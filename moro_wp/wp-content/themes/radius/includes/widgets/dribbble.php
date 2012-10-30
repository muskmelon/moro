<?php

function wpDribbble() { 
	include_once(ABSPATH . WPINC . '/feed.php');
 
  	$options = get_option("widget_wpDribbble");
	$playerName = $options['playerName'];

	if(function_exists('fetch_feed')):
		$rss = fetch_feed("http://dribbble.com/players/$playerName/shots.rss");
		add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 1800;' ) );
		if (!is_wp_error( $rss ) ) : 
			$items = $rss->get_items(0, $rss->get_item_quantity($options['maxItems'])); 
		endif;
	endif;

	if (!empty($items)): ?>
	
	<h2 class="widgettitle dribbbletitle"><?php echo $options['dribbbleTitle'] ?></h2>
	<ul class="dribbbles clearfix">
	<?php	
	foreach ( $items as $item ):
		$title = $item->get_title();
		$link = $item->get_permalink();
		$date = $item->get_date('F d, Y');
		$description = $item->get_description();
	
		preg_match("/src=\"(http.*(jpg|jpeg|gif|png))/", $description, $image_url);
		$image = $image_url[1];
		if(!$options['bigImage']) {
			//$image = preg_replace('/.(jpg|jpeg|gif|png)/', '_teaser.$1',$image); #comment this out if you want to use the big 400x300 image
		}
	?>
	<li class="dribbble-img"> 
		<a href="<?php echo $image; ?>" target="_blank" class="dribbble-link fancybox"><img src="<?php echo $image; ?>" alt="<?php echo $title;?>"/></a> 
 	</li>
<?php endforeach;?>
</ul>
<a class="dribbble-more" target="_blank" href="http://dribbble.com/<?php echo $options['playerName'] ?>"><?php _e('More Shots &rarr;','okay'); ?></a>
<?php endif;
}

function wpDribbble_control() {
  $options = get_option("widget_wpDribbble");
  if (!is_array( $options )) {
	$options = array(
		'playerName'=> 'Your Player Name',
  		'maxItems' => '3'
    );
  }
  if ($_POST['wpDribbble-Submit']) {
    $options['dribbbleTitle'] = htmlspecialchars($_POST['wpDribbble-WidgetTitle']);
    $options['playerName'] = htmlspecialchars($_POST['wpDribbble-WidgetPlayerName']);
    $options['maxItems'] = htmlspecialchars($_POST['wpDribbble-WidgetCount']);
    update_option("widget_wpDribbble", $options);
  }
?>
<p>
    <label class="labbbel" for="wpDribbble-WidgetTitle"><?php _e('Dribbble Title:','okay'); ?> </label>
    <input type="text" id="wpDribbble-WidgetTitle" name="wpDribbble-WidgetTitle" value="<?php echo $options['dribbbleTitle'];?>" />
    
    <br />
    <br />
    
    <label class="labbbel" for="wpDribbble-WidgetPlayerName"><?php _e('Player Name:','okay'); ?> </label>
    <input type="text" id="wpDribbble-WidgetPlayerName" name="wpDribbble-WidgetPlayerName" value="<?php echo $options['playerName'];?>" />
    
    <br />
    <br />
    
    <label class="labbbel" for="wpDribbble-WidgetCount"><?php _e('Number of Shots:','okay'); ?> </label>
    <input type="text" id="wpDribbble-WidgetCount" name="wpDribbble-WidgetCount" value="<?php echo $options['maxItems'];?>" />
</p>
    <input type="hidden" id="wpDribbble-Submit" name="wpDribbble-Submit" value="1" />

<?php
}
 
function widget_wpDribbble($args) {
  extract($args);
  echo $before_widget;
 ?>
  <?php echo wpDribbble(); echo $after_widget;
}
  
function wpDribbble_init()
{
  $options = get_option("widget_wpDribbble");
  wp_register_sidebar_widget(__('dribbble'),__('Okay Dribbble Widget'), 'widget_wpDribbble' ,array('description' => 'Pull in your latest Dribbble shots'));
  
  
	wp_register_widget_control(
	'dribbble', // your unique widget id
	'Okay Dribbble Widget', // widget name
	'wpDribbble_control' // Callback function
	);
  
	add_action( 'wp_dribbble', 'wpDribbble' );
}
add_action("init", "wpDribbble_init");
?>