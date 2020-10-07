/**
 * Add scroll related classes to the header
 */

(function ($) {
  // Define basic variables
  var didScroll, headerClass, lastScrollTop;
  var delta = 10;
  var headerHeight = $("#header").outerHeight();

  // Scroll event
  $(window).scroll(function (event) {
    didScroll = true;
  });

  // Check scroll with a short delay
  setInterval(function () {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 250);

  // Toggle classes to define if the header is on top, is "hidden up" or if it should show when scrolling up
  function hasScrolled() {
    var st = $(this).scrollTop();

    // To avoid jumps on a short scroll, avoid changes if scroll is less than delta
    if (Math.abs(lastScrollTop - st) <= delta) return;

    if ($(window).height() < $(document).height()) {
      // Class according to position
      headerClass =
        st == 0
          ? "on-top"
          : st > lastScrollTop && st > headerHeight
          ? "nav-up"
          : st < lastScrollTop
          ? "nav-down"
          : "on-top";
    }

    // Add the class to the header
    $("#header").attr("class", headerClass);

    lastScrollTop = st;
  }
})(jQuery);

/**
 * Toggle elements
 */
(function ($) {
  $(".toggle").on("click", function () {
    var target = $(this).data("target");
    $(this)
      .add("#" + target)
      .toggleClass("active");
    $("body").toggleClass(target + "-open");
  });
})(jQuery);
