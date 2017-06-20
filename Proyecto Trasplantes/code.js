

$(document).ready(function() {
	var slider_width = $('.menu').width();
	//get width automaticaly
	$("#close").on("click", function() {
		//stuff to do on mouseover
		if ($(window).width() >= 270) {
			if ($(".menu").width() != 0) {
				$('.menu2').animate({
					"width" : 0
				});
				$('.menu2').hide();

			}
			if ($(".menu2").width() == 0) {

				$('.menu2').animate({
					"width" : 270
				});
				$('.menu2').show();
			} else {
				if (!$(".menu2").is(':animated'))//perevent double click to double margin
				{

					$('.menu2').animate({
						"margin-left" : -2
					});
				}
			}
		}

	});
});
