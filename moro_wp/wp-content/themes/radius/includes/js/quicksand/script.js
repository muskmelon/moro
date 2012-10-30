jQuery.noConflict();
jQuery(document).ready(function($){

 	// Clone applications to get a second collection
	var $data = $(".filter-posts").clone();
	
	$('.filter-list li').click(function(e) {
		$(".filter li").removeClass("active");	
		// Use the last category class as the category to filter by.
		var filterClass=$(this).attr('class').split(' ').slice(-1)[0];
		
		if (filterClass == 'all-projects') {
			var $filteredData = $data.find('.project');
		} else {
			var $filteredData = $data.find('.project[data-type~=' + filterClass + ']');
		}
		$(".filter-posts").quicksand($filteredData, {
			duration: 400,
			easing: 'jswing',
			adjustHeight: 'auto',
		});		
		$(this).addClass("active"); 			
		return false;
	});
});
