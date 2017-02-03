/**
 * Created by rznasa on 01.10.16.
 */

(function ($) {

  /*Set menu on scroll*/
  Drupal.behaviors.menuOnScrool = {
    attach: function (context, settings) {



      var nav = $('.top-menu');

      $(window).scroll(function () {
        if ($(this).scrollTop() > 1 && $(window).width() > 1199) {
          if (!nav.hasClass('f-nav')) {
            $('body').addClass("f-nav");
            nav.addClass("f-nav");
          }
        }
        else {
          nav.removeClass("f-nav");
          $('body').removeClass("f-nav");
        }
      });

    }
  };


})(jQuery);
