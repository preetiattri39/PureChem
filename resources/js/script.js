$(function () {
  const $scrollTopBtn = $('#scrollTopBtn');

  $(window).on('scroll', function () {
    if ($(window).scrollTop() > 200) {
      $scrollTopBtn.show();
    } else {
      $scrollTopBtn.hide();
    }
  });

  $scrollTopBtn.on('click', function () {
    $('html, body').animate({ scrollTop: 0 }, 'slow'); 
  });

  $('.user-logged-in').on('click', function (e) {
      e.preventDefault(); 
      
      const $menu = $('#user-menu-block');
      
      if ($menu.hasClass('d-none')) {
          $menu.removeClass('d-none').addClass('d-block');
      } else {
          $menu.removeClass('d-block').addClass('d-none');
      }
  });

  $(document).on('click', function (e) {
      if (
          !$(e.target).closest('#user-menu-block').length &&
          !$(e.target).closest('.user-logged-in').length
      ) {
          $('#user-menu-block').removeClass('d-block').addClass('d-none');
      }
  });

});
