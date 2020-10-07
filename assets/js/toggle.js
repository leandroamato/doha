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
