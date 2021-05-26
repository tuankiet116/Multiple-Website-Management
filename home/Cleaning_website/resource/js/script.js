$(document).ready(function () {
  var $slider = $(".slider"),
    $slideBGs = $(".slide__bg"),
    diff = 0,
    curSlide = 0,
    numOfSlides = $(".slide").length - 1,
    animating = false,
    animTime = 500,
    autoSlideTimeout,
    autoSlideDelay = 6000,
    $pagination = $(".slider-pagi");

  function createBullets() {
    for (var i = 0; i < numOfSlides + 1; i++) {
      var $li = $("<li class='slider-pagi__elem'></li>");
      $li.addClass("slider-pagi__elem-" + i).data("page", i);
      if (!i) $li.addClass("active");
      $pagination.append($li);
    }

<<<<<<< HEAD
  $('.slider-slick').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true,
    arrows: false, 
  });

}
=======
    $(".slider-slick").slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true,
      arrows: false,
    });
  }
>>>>>>> 28bbfe3e248ec3763561acb5a77c16af15543567

  createBullets();

  function manageControls() {
    $(".slider-control").removeClass("inactive");
    if (!curSlide) $(".slider-control.left").addClass("inactive");
    if (curSlide === numOfSlides)
      $(".slider-control.right").addClass("inactive");
  }

  function autoSlide() {
    autoSlideTimeout = setTimeout(function () {
      curSlide++;
      if (curSlide > numOfSlides) curSlide = 0;
      changeSlides();
    }, autoSlideDelay);
  }

  autoSlide();

  function changeSlides(instant) {
    if (!instant) {
      animating = true;
      manageControls();
      $slider.addClass("animating");
      $slider.css("top");
      $(".slide").removeClass("active");
      $(".slide-" + curSlide).addClass("active");
      setTimeout(function () {
        $slider.removeClass("animating");
        animating = false;
      }, animTime);
    }
    window.clearTimeout(autoSlideTimeout);
    $(".slider-pagi__elem").removeClass("active");
    $(".slider-pagi__elem-" + curSlide).addClass("active");
    $slider.css("transform", "translate3d(" + -curSlide * 100 + "%,0,0)");
    $slideBGs.css("transform", "translate3d(" + curSlide * 50 + "%,0,0)");
    diff = 0;
    autoSlide();
  }

  function navigateLeft() {
    if (animating) return;
    if (curSlide > 0) curSlide--;
    changeSlides();
  }

  function navigateRight() {
    if (animating) return;
    if (curSlide < numOfSlides) curSlide++;
    changeSlides();
  }

  // $(document).on("mousedown touchstart", ".slider", function (e) {
  //   if (animating) return;
  //   window.clearTimeout(autoSlideTimeout);
  //   var startX = e.pageX || e.originalEvent.touches[0].pageX,
  //     winW = $(window).width();
  //   diff = 0;

  //   $(document).on("mousemove touchmove", function (e) {
  //     var x = e.pageX || e.originalEvent.touches[0].pageX;
  //     diff = ((startX - x) / winW) * 70;
  //     if ((!curSlide && diff < 0) || (curSlide === numOfSlides && diff > 0))
  //       diff /= 2;
  //     $slider.css(
  //       "transform",
  //       "translate3d(" + (-curSlide * 100 - diff) + "%,0,0)"
  //     );
  //     $slideBGs.css(
  //       "transform",
  //       "translate3d(" + (curSlide * 50 + diff / 2) + "%,0,0)"
  //     );
  //   });
  // });

  // $(document).on("mouseup touchend", function (e) {
  //   $(document).off("mousemove touchmove");
  //   if (animating) return;
  //   if (!diff) {
  //     changeSlides(true);
  //     return;
  //   }
  //   if (diff > -8 && diff < 8) {
  //     changeSlides();
  //     return;
  //   }
  //   if (diff <= -8) {
  //     navigateLeft();
  //   }
  //   if (diff >= 8) {
  //     navigateRight();
  //   }
  // });

  $(document).on("click", ".slider-control", function () {
    if ($(this).hasClass("left")) {
      navigateLeft();
    } else {
      navigateRight();
    }
  });

  $(document).on("click", ".slider-pagi__elem", function () {
    curSlide = $(this).data("page");
    changeSlides();
  });

  /**************** Responsive bar ****************/

  var x = 0;

  $("#btn-navbar").click(function () {
    if (x == 0) {
      $("#submenu-container").fadeIn("fast");
      $(".close-navbar").fadeIn("fast");
      x++;
    } else {
      $("#submenu-container").fadeOut("fast");
      $(".close-navbar").fadeOut("fast");
      x--;
    }
  });

  $(".close-navbar").click(function () {
    $("#submenu-container").fadeOut("fast");
    $(".close-navbar").fadeOut("fast");
    x--;
  });

  $(window).resize(function () {
    if ($(window).width() > 1160 && x == 1) {
      $("#submenu-container").css("display", "none");
      $(".close-navbar").fadeOut("fast");
      x = 0;
    }
  });

<<<<<<< HEAD
  $('.submenu-content').click(function(){
    $(this).children('.sub-link').slideToggle('slow');
    $(this).toggleClass('roteta-icon');
  })
=======
  $(".submenu-content").click(function () {
    $(this).children(".sub-link").slideToggle("slow");
    $(this).toggleClass("roteta-icon");
  });
>>>>>>> 28bbfe3e248ec3763561acb5a77c16af15543567

  // $(window).scroll(function(){
  //   $(window).scrollTop()> 300 ? $('#menu').css("position", "fixed"): $('#menu').css("position", "sticky");
  // })

  window.onload = function () {
    $(window).scroll(function () {
      if ($(window).scrollTop() > 100) {
        $("#menu").css("position", "fixed");
        $("#menu").addClass("menu-fixed");
      }
      if ($(window).scrollTop() == 0) {
        $("#menu").css("position", "relative");
        $("#menu").removeClass("menu-fixed");
      }
    });
<<<<<<< HEAD
  }); 

  var slide_left = 0;
  var slide_bgLeft = 0;
  $('.slide').each(function() {
    slide_left += 100;
    $(this).css("left", slide_left + '%');
  });
  $('.slide .slide__bg').each(function() {
    slide_bgLeft += -50;
    $(this).css("left", slide_bgLeft + '%');
=======
  };

  var slide_left = 0;
  var slide_bgLeft = 0;
  $(".slide").each(function () {
    slide_left += 100;
    $(this).css("left", slide_left + "%");
  });
  $(".slide .slide__bg").each(function () {
    slide_bgLeft += -50;
    $(this).css("left", slide_bgLeft + "%");
  });

  /********** Scroll to top  **********/

  $("#scroll-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 500);
    return false;
>>>>>>> 28bbfe3e248ec3763561acb5a77c16af15543567
  });
});

$('.slider .slide:first-child').addClass('active');

function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  
  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}




<<<<<<< HEAD
=======

>>>>>>> 28bbfe3e248ec3763561acb5a77c16af15543567
