(function($) {

  // Fitvids
  $(document).ready(function() {
    $('body').fitVids();
  });

  // Mobile
  $(document).ready(function() {
    $(window).resize(function() {
      if($(window).width() <= 480) {
        $('#wpadminbar').hide();
        $('body').addClass('newsroom-mobile');
        $('#masthead').hide();
        $('.mobile-header').show();
      } else {
        $('#wpadminbar').show();
        $('body').removeClass('newsroom-mobile');
        $('#masthead').show();
        $('.mobile-header').hide();
      }
    });
    $(window).resize();
    $('#mobile-nav .toggle-nav').click(function() {
      if($('#mobile-nav').hasClass('active')) {
        $('#mobile-nav').removeClass('active');
        $('#mobile-nav .toggle-nav').removeClass('icon-cross').addClass('icon-menu');
      } else {
        $('#mobile-nav').addClass('active');
        $('#mobile-nav .toggle-nav').removeClass('icon-menu').addClass('icon-cross');
      }
    });
  });

})(jQuery);
