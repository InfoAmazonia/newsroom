(function($) {
  $(document).ready(function() {
    var $container = $('.newsroom-highlight-carousel');
    $container.each(function() {
      var $container = $(this);
      var $items = $container.find('.highlight-carousel-item');
      var count = $items.length;
      var $nav = $('<nav class="highlight-carousel-nav" />');
      $container.append($nav);
      var view = function(i) {
        $items.hide();
        $nav.find('a').removeClass('active');
        $nav.find('a[data-count="' + i + '"]').addClass('active');
        $($items.get(i)).show();
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
