!function($){var r=$(".masonry-grid #main");r.prepend('<div class="grid-sizer"></div>');var e=r.masonry({itemSelector:".hentry",columnWidth:".grid-sizer",percentPosition:!0,gutter:20});r.imagesLoaded().progress(function(){e.masonry("layout")})}(jQuery);