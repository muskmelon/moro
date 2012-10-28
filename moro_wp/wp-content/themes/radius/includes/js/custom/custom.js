jQuery(document).ready(function( $ ) { 
		
		//Wrap Instagram widget
		$('.wpinstagram').wrap('<div class="wpinstagram-wrap" />');
		
	
		//Drop Down Menu
		function mainmenu(){
		$('#nav ul').css({display: "none"}); // Opera Fix
		
		$('#nav li').hover(function(){
			$(this).find('ul:first').css({visibility: "visible",display: "none"}).fadeToggle(200);
			},function(){
			$(this).find('ul:first').css({visibility: "hidden"});
			});
		}
		
		mainmenu();
		
		
		//Add Menu Items
		$('#nav .entypo a').wrap('<div class="entypo-inner" />');	
		
		
		//Flexslider
		$(window).load(function() {
			$('#header-slider').flexslider({
				start: function(slider) {
				if (slider.count == 1) {
				 $('.flex-control-nav, .flex-direction-nav').hide();
				} 
				},
				slideshow: false,
				animationDuration: 200 
			});
			
			$('.flexslider').flexslider();
		});
		
		
		// Tab Box
		$("ul.tabs").tabs("div.panes > div",{effect: "fade" }); 
		
		$('.hidden-toggle').click(function() {
		  $('.header-hidden').slideToggle('fast', function() {
		    // Animation complete.
		  });
		  $(".header-hidden-toggle-wrap").toggleClass("show-hidden");
		});
		
		
		// Show the sidebar
		$('#nav').append('<li class="sidebar-toggle"><a id="sidebar-close" href="#" title="close"></a></li>');
		
		$('#sidebar-close').click(function () {
			$('body').addClass('sidebar-panel-open');
		    $("#sidebar-wrap").addClass("show-sidebar");
		    $(".content,.header,.page-title,.footer,.footer-widgets").addClass("content-fade");
		});
		
		//Hide the sidebar
		$('#sidebar-close2').click(function () {
			$('body').removeClass('sidebar-panel-open');
		    $("#sidebar-wrap").removeClass("show-sidebar");
		    $(".content,.header,.page-title,.footer,.footer-widgets").removeClass("content-fade");
		});

		
		//FitVids
		$(".okvideo").fitVids();
		
		
		//Video iFrame Fix
		$('iframe').each(function(){
	        var url = $(this).attr("src");
	        $(this).attr("src",url+"?wmode=opaque");
	    })
		
		
		//Menu
		$('#nav').mobileMenu();
		
		
		//Responsive Select Menu		
	    if (!$.browser.opera) {
	        $('select.select-menu').each(function(){
	            var title = $(this).attr('title');
	            if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
	            $(this)
	                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
	                .after('<span class="select">' + title + '</span>')
	                .change(function(){
	                    val = $('option:selected',this).text();
	                    $(this).next().text(val);
	                    })
	        });
	    };
		
		
		//Toggle
		$('.showcase-toggle').click(function() {
		  $(".showcase,#header-slider").toggleClass("showcase-open");
		  $(".showcase-image").toggleClass("showcase-image-hide");
		  $(".showcase-info").toggleClass("showcase-info-open");
		  $(".showcase-title h2").toggleClass("showcase-title-white");
		  $(".showcase-text").toggleClass("showcase-text-show");
		  return false;
		});
		
		
		//Flickr Fancybox		
		$(".fancybox").fancybox({
			"transitionIn":			"elastic",
			"transitionOut":		"elastic",
			"easingIn":			"easeOutBack",
			"easingOut":			"easeInBack",
			"titlePosition":		"over",
			"padding":			0,
			"hideOnContentClick":		"true"
		});
		
			
		$(".social-widget").each(function(index) {
		    $(this).delay(400*index).fadeIn(200);
		});
				
});