$(document).ready(function() {
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
        $("#menu").css("position", "fixed");
        $("#menu").addClass("show_navbar");
      }
      if ($(window).scrollTop() == 0) {
        $("#menu").css("position", "relative");
        $("#menu").removeClass("show_navbar");
      }
    });
  };

  $("#myCarousel").carousel({
    interval: 5000, 
    target: '+=1'
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

  $("#func_btn #scroll-top a .func_icon").click(function() {
    $("html, body").animate({ scrollTop: 0}, 500);
    return false;
  });

  /********** Carousel  **********/

  $("#myCarousel .carousel-inner .carousel-item:first-child").addClass("active");
});

