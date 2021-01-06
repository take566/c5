
	$(document).ready(function(){
		var windowHeight = $(window).height();
		var nomalHeight = $(".section-pt1").height();
		if(nomalHeight<windowHeight){
			$(".section-pt1").height(windowHeight);
		}
		$(window).resize(function() {
			windowHeight = $(window).height();
			if(nomalHeight < windowHeight){
				$(".section-pt1").height(windowHeight);
			}
		});
	});
