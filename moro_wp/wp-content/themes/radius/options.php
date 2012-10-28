<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Buttons
	$button_color = array("blue" => "Blue", "green" => "Green", "orange" => "Orange", "gray" => "Gray", "purple" => "Purple");
	
	// Slider Size
	$slider_size = array("fullwidth" => "Full Width", "940" => "940px", "noslider" => "No Slider");
	
	//Slider Action
	$slider_action = array("showtext" => "Show Title and Text", "linkpost" => "Link to Post");
	
	// Background Defaults
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	$options = array();
	
	// ------------- Basic Settings Tab  ------------- //	
		
	$options[] = array( "name" => __('Basic Settings', 'okay'), 
						"type" => "heading");
						
	$options[] = array( 'name' => __('Logo Upload', 'okay'),
						"desc" => __('Upload your image to use in the header.', 'okay'),
						"id" => "of_logo",
						"type" => "upload");

	
	$options[] = array( "name" => __('Link Color', 'okay'),
						"desc" => __('Select the color you would like your links to be. The demo site uses #f5461e.', 'okay'),
						"id" => "of_colorpicker",
						"std" => "#f5461e",
						"type" => "color");	
						
	$options[] = array( "name" => __('Nav Tab Background Color', 'okay'),
						"desc" => __('Select the background color for the current page navigation. The demo site uses #F26A4B.', 'okay'),
						"id" => "of_nav_colorpicker",
						"std" => "#F26A4B",
						"type" => "color");																		 						
						
	$options[] = array( "name" => __('Dashboard Page Link', 'okay'),
						"desc" => __('Select the page that will link to the Social Dashboard page.', 'okay'),
						"id" => "of_dashboard_link",
						"type" => "select",
						"options" => $options_pages);	
	
	$options[] = array( "name" => __('Homepage Large Slider Category', 'okay'),
						"desc" => __('Please select the category to populate the slider on the homepage.', 'okay'),
						"id" => "of_slider_cat",
						"type" => "select",
						"options" => $options_categories);	
						
	$options[] = array( "name" => __('Homepage Slider Size', 'okay'),
						"desc" => __('Do you want a full-width slider on the homepage, a 940px slider, or no slider?', 'okay'),
						"id" => "of_slider_size",
						"type" => "select",
						"options" => $slider_size);	
						
	$options[] = array( "name" => __('Homepage Slider Action', 'okay'),
						"desc" => __('When a slide is clicked, do you want to show the title and excerpt overlay or link the slide to the post? ', 'okay'),
						"id" => "of_slider_action",
						"type" => "select",
						"options" => $slider_action);						
						
	$options[] = array( "name" => __('Portfolio Category', 'okay'),
						"desc" => __('Please select the category that contains your Portfolio posts. This category will populate the Portfolio section of the homepage and the portfolio page.', 'okay'),
						"id" => "of_portfolio_cat",
						"type" => "select",
						"options" => $options_categories);	
						
	$options[] = array( "name" => __('Blog Category', 'okay'),
						"desc" => __('Please select the category that contains your Blog posts. This category will populate the Blog page.', 'okay'),
						"id" => "of_blog_cat",
						"type" => "select",
						"options" => $options_categories);											
						
	$options[] = array( "name" => __('Homepage Latest Work Text', 'okay'),
						"desc" => __('Text for the homepage Latest Work area next to the portfolio images.', 'okay'),
						"id" => "of_portfolio_text",
						"std" => "",
						"type" => "textarea"); 							
						
	$options[] = array( "name" => __('Tracking Code', 'okay'),
						"desc" => __('Put your Google Analytics or other tracking code here.', 'okay'),
						"id" => "of_tracking_code",
						"std" => "",
						"type" => "textarea"); 							
																																																											
	// ------------- Social Icons Tab  ------------- //
						
	$options[] = array( "name" => __('Social Media Links', 'okay'),
						"type" => "heading");															
	
	$options[] = array( "name" => __('Twitter URL', 'okay'),
						"desc" => __('Enter the full url to your Twitter profile.', 'okay'),
						"id" => "twitter_icon",
						"std" => "",
						"type" => "text");	
						
	$options[] = array( "name" => __('Google+ URL', 'okay'),
						"desc" => __('Enter the full url to your Google+ profile.', 'okay'),
						"id" => "google_icon",
						"std" => "",
						"type" => "text");	
	
	$options[] = array( "name" => __('Dribbble URL', 'okay'),
						"desc" => __('Enter the full url to your Dribbble profile.', 'okay'),
						"id" => "dribbble_icon",
						"std" => "",
						"type" => "text");											
						
	$options[] = array( "name" => __('Vimeo URL', 'okay'),
						"desc" => __('Enter the full url to your Vimeo profile.', 'okay'),
						"id" => "vimeo_icon",
						"std" => "",
						"type" => "text");						
	
	$options[] = array( "name" => __('Facebook URL', 'okay'),
						"desc" => __('Enter the full url to your Facebook profile.', 'okay'),
						"id" => "facebook_icon",
						"std" => "",
						"type" => "text");	
						
	$options[] = array( "name" => __('Flickr URL', 'okay'),
						"desc" => __('Enter the full url to your Flickr profile.', 'okay'),
						"id" => "flickr_icon",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Tumblr URL', 'okay'),
						"desc" => __('Enter the full url to your Tumblr profile.', 'okay'),
						"id" => "tumblr_icon",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('LinkedIn URL', 'okay'),
						"desc" => __('Enter the full url to your LinkedIn profile.', 'okay'),
						"id" => "linkedin_icon",
						"std" => "",
						"type" => "text");	
						
	$options[] = array( "name" => __('RSS URL', 'okay'),
						"desc" => __('Enter the full url to your RSS feed.', 'okay'),
						"id" => "rss_icon",
						"std" => "",
						"type" => "text");	
						
						
	// ------------- Custom CSS Tab  ------------- //
	
	$options[] = array( "name" => "Custom CSS",
						"type" => "heading");
	
	$options[] = array( "name" => __('Custom CSS', 'okay'),
						"desc" => __('If you would like to make light styling modifications, you can add custom CSS here. If you are going to make heavy modifications to the theme, consider doing them in a <a href="http://codex.wordpress.org/Child_Themes">child theme</a>, which is included with your theme.', 'okay'),
						"id" => "of_theme_css",
						"std" => "",
						"type" => "textarea"); 						
						
	
	// ------------- Okay Themes Tab  ------------- //
						
	$options[] = array( "name" => "Support",
						"type" => "heading");					
						
	$options[] = array( "name" => __('Theme Documentation & Support', 'okay'),
						"desc" => "<p class='okay-text'>Theme support and documentation is available for all customers. Visit <a target='blank' href='http://okaythemes.com/support'>Okay Themes Support Forum</a> to get started. Simply follow the ThemeForest or Okay user instructions to verify your purchase and get a support account.</p>
						
						<div class='okay-buttons'><a target='blank' class='okay-button video-button' href='https://vimeo.com/38336799'><span class='okay-icon icon-video'>Radius Install Video</span></a><a target='blank' class='okay-button help-button' href='http://themes.okaythemes.com/docs/radius/index.html'><span class='okay-icon icon-help'>Radius Help File</span></a><a target='blank' class='okay-button support-button' href='http://okaythemes.com/support'><span class='okay-icon icon-support'>Support Forum</span></a><a target='blank' class='okay-button custom-button' href='http://okaythemes.com/customization'><span class='okay-icon icon-custom'>Customize Theme</span></a></div>
						
						<h4 class='heading'>More Themes by Okay Themes</h4>
						
						<div class='embed-themes'></div>
						
						",
						"type" => "info");																																													
								
	return $options;
}