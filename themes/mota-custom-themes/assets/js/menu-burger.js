(function($) {
    $(".navbar-open").click(function () {
      console.log("navbar-trigger cliqué");
      $(".menu-header").animate({ height: "toggle", opacity: "toggle" }, 1000);
      $(".menu-header").toggleClass("open");
      $(".navbar-burger").toggleClass("close");
    
      // Bloquer le défilement lorsque le menu burger est ouvert
      if ($(".menu-header").hasClass("open")) {
        $("html, body").css("overflow", "hidden");
      } else {
        $("html, body").css("overflow", "");
      }
    });
    
    $("a").click(function () {
      if ($(".menu-header").hasClass("open")) {
        $(".menu-header").animate({ height: "toggle", opacity: "toggle" }, 1000);
        $(".menu-header").removeClass("open");
        $(".navbar-burger").removeClass("close");
    
        // Activer à nouveau le défilement lorsque le menu burger est fermé
        $("html, body").css("overflow", "");
      }
    });
  })(jQuery);