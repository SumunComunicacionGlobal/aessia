jQuery(document).ready(function($) {
	var body = $('body');

	jQuery(window).scroll(function() {
		var scroll = $(window).scrollTop();
		if (scroll >= 25) {
			body.addClass("scrolled");
		} else {
			body.removeClass("scrolled");
		}

	   if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
	       body.addClass("near-bottom");
	   } else {
			body.removeClass("near-bottom");
	   }

	});

  $('.abrir-mega-menu').click(function(e) {
    e.preventDefault();
    $('#aessia-menu-modal').modal();
  });

  $('.abrir-buscador').click(function(e) {
    e.preventDefault();
    $('#aessia-buscador-modal').modal();
  });

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var iframe = $(e.relatedTarget.hash).find('iframe'); 
    var src = iframe.attr('src');
    iframe.attr('src', '');
    iframe.attr('src', src);
  });

  $('.abrir-chat, a[href="#abrir-chat"]').click(function(e) {
    e.preventDefault();
    $('#lbContactHeaderFloat').trigger('click');
  });

  $('.filtro-tema').change(function () {
    location.href = $(this).val();
  }); 

  $('.boton-chat, a[href="#abrir-chat"]').click(function(e) {
    e.preventDefault();
    $('#lbContactHeaderFloat').trigger('click');
  });  

});


/* Carruseles */

jQuery('.slick-carousel').slick({
  dots: false,
  arrows: true,
  infinite: true,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 1,
  autoplay: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

jQuery('.slick-navbar').slick({
  dots: false,
  arrows: false,
  infinite: false,
  slidesToShow: 1,
  speed: 300,
  variableWidth: true,
  // centerMode: true
});

/***/
