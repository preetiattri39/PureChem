$(function () {
  const $scrollTopBtn = $('#scrollTopBtn');

  // Show button after scrolling down 200px
  $(window).on('scroll', function () {
    if ($(window).scrollTop() > 200) {
      $scrollTopBtn.show();
    } else {
      $scrollTopBtn.hide();
    }
  });

  // Smooth scroll to top on click
  $scrollTopBtn.on('click', function () {
    $('html, body').animate({ scrollTop: 0 }, 'slow'); 
  });
});
