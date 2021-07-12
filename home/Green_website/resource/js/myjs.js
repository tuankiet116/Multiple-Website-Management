$(document).ready(function () {
  /********** Menu **********/

  var getHeight = $("#navbar").height();
  var getMenu = $("#menu ul#navbar").css("display");

  if (getHeight > 100 && getMenu != "none") {
    $("#menu").css("min-height", "130px");
    $("#menu #logo").css("border-bottom", "80px solid transparent");
  } else {
    $("#menu").css("min-height", "80px");
    $("#menu #logo").css("border-bottom", "80px solid white");
  }

  /********** Sub menu **********/
  var n = 0;

  $("#sub-icon").click(function () {
    if (n == 0) {
      $("#sub-menu").css("left", "0");
      $("#sub-menu-close").css("display", "block");
      n++;
    } else {
      $("#sub-menu").css("left", "-300px");
      $("#sub-menu-close").css("display", "none");
      $("#menu").css("opacity", "1");
      n--;
    }
  });

  $("#sub-menu-close").click(function () {
    $("#sub-menu").css("left", "-300px");
    $("#sub-menu-close").css("display", "none");
    n--;
  });

  /********** Modal **********/

  $("#user").click(function () {
    $(".modal-login").addClass("modal-effect");
  });

  $(".modal-signup").click(function () {
    // $(".modal-login").removeClass("modal-effect");
    // $(".modal-login").addClass("modal-login-effect");
    $("#close-login").click();
    $(".modal-account-content input").val("");
    $("#modal-account-phone").remove();
    $("#modal-account-name small").remove();
    $("#modal-account-password small").remove();
    $("#modal-account-password-main small").remove();
    $("#modal-account-email small").remove();
    $("#modal-account-address small").remove();
  });

  $("#userModal").click(function () {
    $(".modal-login").removeClass("modal-login-effect");
  });

  // $("#signupModal").click(function() {
  //   $(".modal-login").addClass("modal-effect");
  // });

  $(".modal-back-login").click(function () {
    $("#close-signup").click();
    $(".modal-login").removeClass("modal-effect");
    $(".modal-login").addClass("modal-login-effect");
  });

  /********** Chevron icon **********/

  var m = 0;

  $("#sub_1").click(function () {
    $("#sub_content_1").slideToggle("slow");
  });

  $("#sub_1").click(function () {
    if (m == 0) {
      $("#sub-menu #sub-menu-container a#sub_1 div i").css(
        "transform",
        "rotate(180deg)"
      );
      m++;
    } else {
      $("#sub-menu #sub-menu-container a#sub_1 div i").css(
        "transform",
        "rotate(0deg)"
      );
      m--;
    }
  });

  /********** Window resize sub menu **********/

  $(window).resize(function () {
    if ($(window).width() > 890 && n == 1) {
      $("#sub-menu").css("left", "-300px");
      $("#sub-menu-close").css("display", "none");
      n--;
    }
  });

  /********** Window scroll **********/

  window.onload = function () {
    $(window).scroll(function () {
      if ($(window).scrollTop() > 100) {
        $("#menu-top").css("position", "fixed");
        $("#menu-top").addClass("show_navbar");
      }
      if ($(window).scrollTop() == 0) {
        $("#menu-top").css("position", "relative");
        $("#menu-top").removeClass("show_navbar");
      }
    });
  };

  $("#myCarousel").carousel({
    interval: 5000,
    target: "+=1",
  });

  $(".carousel .carousel-item").each(function () {
    var minPerSlide = 4;
    var next = $(this).next();
    if (!next.length) {
      next = $(this).siblings(":first");
    }
    next.children(":first-child").clone().appendTo($(this));

    for (var i = 0; i < minPerSlide; i++) {
      next = next.next();
      if (!next.length) {
        next = $(this).siblings(":first");
      }

      next.children(":first-child").clone().appendTo($(this));
    }
  });

  /********** Scroll to top  **********/

  $("#func_btn #scroll-top a .func_icon").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 500);
    return false;
  });

  /********** Carousel  **********/

  $("#myCarousel .carousel-inner .carousel-item:first-child").addClass(
    "active"
  );

  /********** Shop **********/

  $.fn.digits = function () {
    return this.each(function () {
      $(this).text(
        $(this)
          .text()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
      );
    });
  };

  $("span.price-numbers").digits();

  /********** Slick **********/

  $(".slide-product-post").slick({
    autoplay: true,
    autoplaySpeed: 4000,
    infinite: true,
    dots: true,
    arrows: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    prevArrow:
      "<button type='button' class='mission-prev-arrow' style='outline: none'></button>",
    nextArrow:
      "<button type='button' class='mission-next-arrow' style='outline: none'></button>",
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
        },
      },
    ],
  });

  $(".slide-other-product").slick({
    autoplay: true,
    autoplaySpeed: 4000,
    infinite: true,
    dots: true,
    arrows: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    prevArrow:
      "<button type='button' class='mission-prev-arrow' style='outline: none'></button>",
    nextArrow:
      "<button type='button' class='mission-next-arrow' style='outline: none'></button>",
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
        },
      },
    ],
  });

  $(".main-slide").slick({
    autoplay: true,
    autoplaySpeed: 4000,
    infinite: true,
    dots: true,
    arrows: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow:
      "<button type='button' class='main-slide-prev' style='outline: none'> &lsaquo; </button>",
    nextArrow:
      "<button type='button' class='main-slide-next' style='outline: none'> &rsaquo; </button>",
  });

  $(".btn-plus, .btn-minus").on("click", function (e) {
    const isNegative = $(e.target).closest(".btn-minus").is(".btn-minus");
    const input = $(e.target).closest(".input-group").find("input");
    if (input.is("input")) {
      input[0][isNegative ? "stepDown" : "stepUp"]();
    }
  });

  $("#user").click(function (e) {
    e.preventDefault();
  });
});

base_url = "http://www.webmultiple.com:8080/";
