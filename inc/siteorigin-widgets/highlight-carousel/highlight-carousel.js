(function($) {
  $(document).ready(function() {
    var $container = $('.newsroom-highlight-carousel');
    $container.each(function() {
      var $container = $(this);
      var $items = $container.find('.highlight-carousel-item');
      var count = $items.length;
      var $nav = $('<nav class="highlight-carousel-nav" />');
      $container.append($nav);
      var next;
      var interval;
      var delay = $container.data('rotate-delay') || 8000;
      var view = function(i) {
        $items.hide();
        next = i+1;
        if(next >= count) next = 0;
        $nav.find('a').removeClass('active');
        $nav.find('a[data-count="' + i + '"]').addClass('active');
        $($items.get(i)).show();
        if($container.data('rotate') == 1) {
          clearInterval(interval);
          interval = setInterval(function() {
            view(next);
          }, delay);
        }
      };
      for(i = 0; i < count; i++) {
        var $li = $('<a href="#" data-count="' + i + '" />');
        $li.on('click', function() {
          view($(this).data('count'));
          return false;
        });
        $nav.append($li);
      }
      view(0);

    });
  });
})(jQuery);
