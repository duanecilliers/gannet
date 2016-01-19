(function ($) {

  var $grid = $('.masonry-grid #main');

  $grid.prepend('<div class="grid-sizer"></div>');
  $grid.prepend('<div class="gutter-sizer"></div>');

  var $masonry = $grid.masonry({
    itemSelector: '.hentry',
    columnWidth: '.grid-sizer',
    percentPosition: true,
    gutter: '.gutter-sizer'
  });

  $grid.imagesLoaded().progress(function () {
    $masonry.masonry('layout');
  });

} )(jQuery);
