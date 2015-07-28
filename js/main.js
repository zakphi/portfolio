jQuery('#menu-mobile').click(function() {
  jQuery('#primary-menu').toggleClass("open");
});

jQuery('.menu-item').click(function() {
  jQuery('#primary-menu').removeClass("open");
});
