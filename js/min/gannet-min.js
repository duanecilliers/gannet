!function($){var r=$(".masonry-grid #main");r.prepend('<div class="grid-sizer"></div>'),r.prepend('<div class="gutter-sizer"></div>');var e=r.masonry({itemSelector:".hentry",columnWidth:".grid-sizer",percentPosition:!0,gutter:".gutter-sizer"});r.imagesLoaded().progress(function(){e.masonry("layout")})}(jQuery);