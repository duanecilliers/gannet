(function ($) {

  var $grid = $('.masonry-grid #main');

  $grid.prepend('<div class="grid-sizer"></div>');

  var $masonry = $grid.masonry({
    itemSelector: '.hentry',
    columnWidth: '.grid-sizer',
    percentPosition: true,
    gutter: 20
  });

  $grid.imagesLoaded().progress(function () {
    $masonry.masonry('layout');
  });

} )(jQuery);
