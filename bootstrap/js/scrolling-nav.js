//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 30) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

(function($){

  var sections = [];
  var id = false;
  var $navbar = $('.navbar-nav');
  var $navbara = $('a', $navbar);

  $navbara.click(function(e){
    e.preventDefault();
    $('html, body').animate({
      scrollTop: $($(this).attr('href')).offset().top - $navbar.height()
    });
    hash($(this).attr('href'));
  });

  $navbara.each(function(){
    sections.push($($(this).attr('href')));
  });

  $(window).scroll(function(e){
    var scrollTop = $(this).scrollTop() + ($(window).height() / 2)
    for(var i in sections){
      var section = sections[i];
      if (scrollTop > section.offset().top) {
        scrolled_id = section.attr('id');
      }
    }
    if (scrolled_id !== id) {
      id = scrolled_id
      $navbara.parent().removeClass('active');
      $('a[href="#' + id + '"]', $navbar).parent().addClass('active');
    }
  });

})(jQuery);
