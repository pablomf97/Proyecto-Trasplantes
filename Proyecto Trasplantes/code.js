


$(document).ready(function() {
	var slider_width = $('.menu').width();

	$("#close").on("click", function() {

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
				if (!$(".menu2").is(':animated'))
				{

					$('.menu2').animate({
						"margin-left" : -2
					});
				}
			}
		}

	});
});

$(document).ready(function() {
  var longitud = false,
    minuscula = false,
    numero = false,
    mayuscula = false;
  $('input[type=password]').keyup(function() {
    var pswd = $(this).val();
    if (pswd.length < 8) {
      $('#length').removeClass('valid').addClass('invalid');
      longitud = false;
    } else {
      $('#length').removeClass('invalid').addClass('valid');
      longitud = true;
    }

    //valida letra
    if (pswd.match(/[A-z]/)) {
      $('#letter').removeClass('invalid').addClass('valid');
      minuscula = true;
    } else {
      $('#letter').removeClass('valid').addClass('invalid');
      minuscula = false;
    }

    //valida mayúscula
    if (pswd.match(/[A-Z]/)) {
      $('#capital').removeClass('invalid').addClass('valid');
      mayuscula = true;
    } else {
      $('#capital').removeClass('valid').addClass('invalid');
      mayuscula = false;
    }

    //valida umero
    if (pswd.match(/\d/)) {
      $('#number').removeClass('invalid').addClass('valid');
      numero = true;
    } else {
      $('#number').removeClass('valid').addClass('invalid');
      numero = false;
    }
  }).focus(function() {
    $('#pswd_info').show();
  }).blur(function() {
    $('#pswd_info').hide();
  });

  $("#registro").submit(function(event) {
    alert("hola");
    if(longitud && minuscula && numero && mayuscula){
      alert("password correcto");
      $("#registro").submit();

    }else{
      alert("Password invalido.");
      event.preventDefault();
    }

  });
});