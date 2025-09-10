/* ==============
 ========= js documentation ==========================
 
 *Template: FINVIEW 
 * Version: 1.0
 * Author: pixelaxis
 * Author URI: https://themeforest.net/user/pixelaxis
 * Description: Financial Loan Review and Comparison Website Theme
 
 * ==================================================
    
     01. preloader
     -------------------------------------------------
     02. on scroll actions
     -------------------------------------------------
     03. scroll top
     -------------------------------------------------
     04. navbar active color
     -------------------------------------------------
     05. magnificPopup
     -------------------------------------------------
     06. data background
     -------------------------------------------------
     07. reply
     -------------------------------------------------
     07. nav-right__search
     -------------------------------------------------
     08. sidebar_btn
     -------------------------------------------------
     09. faq
     -------------------------------------------------
     10. browse-spaces-filter__tab
     -------------------------------------------------
     11. contact ajax
     -------------------------------------------------
     12. btn_theme
     -------------------------------------------------
     13. price-range
     -------------------------------------------------
     13. calculator_submit
     -------------------------------------------------
     14. copyright year
     -------------------------------------------------
     
    ==================================================
============== */

jQuery(function ($) {
  "use strict";
  jQuery(document).ready(function () {
    // pre_loader
    $(".preloader")
      .delay(300)
      .animate(
        {
          opacity: "0",
        },
        800,
        function () {
          $(".preloader").css("display", "none");
        }
      );

    // // on scroll actions
    // var scroll_offset = 120;
    // $(window).scroll(function () {
    //   var $this = $(window);
    //   if ($(".header-sticky").length) {
    //     if ($this.scrollTop() > scroll_offset) {
    //       $(".header-sticky").addClass("header-active");
    //     } else {
    //       $(".header-sticky").removeClass("header-active");
    //     }
    //   }
    // });

    // scroll top
    $(window).scroll(function () {
      if ($(window).scrollTop() > 500) {
        $(".scrollToTop").addClass("topActive");
      } else {
        $(".scrollToTop").removeClass("topActive");
      }
    });

    // Navbar Active Class
    var curUrl = $(location).attr("href");
    var checkLink = $('.navbar-nav a[href="' + curUrl + '"]');
    var targetClass = checkLink.addClass("active");
    targetClass.parents(".navbar-nav li").find(" a").first().addClass("active");

    $(window).on("load resize", function () {
      var windowWidth = $(window).width();
      if (windowWidth < 1200) {
        $("li.menu-item-has-children > a").off("click").on("click", function (event) {
          event.preventDefault();
          var parentLi = $(this).parent();
          parentLi.toggleClass("active");
          parentLi.siblings().removeClass("active").find("ul.dropdown-menu").slideUp();
          $(this).next("ul.dropdown-menu").slideToggle();
        });
      } else {
        $("li.menu-item-has-children > a").off("click").parent().removeClass("active");
        $("ul.dropdown-menu").removeAttr("style");
      }
    });


    // magnificPopup
    $(".popup_img").magnificPopup({
      type: "image",
      gallery: {
        enabled: true,
      },
    });

    // data background
    $("[data-background]").each(function () {
      $(this).css(
        "background-image",
        "url(" + $(this).attr("data-background") + ")"
      );
    });

    // reply
    $(".reply").on("click", function () {
      $(this).toggleClass("reply-active");
      $(this).parent().next(".reply__content").slideToggle();
    });

    // nav-right__search
    $(".nav-right__search-icon").on("click", function () {
      $(this)
        .parents(".nav-right__search")
        .find(".nav-right__search-icon ")
        .toggleClass("active");
      $(this)
        .parents(".nav-right__search")
        .find(".nav-right__search-inner ")
        .slideToggle();
    });
    $(document).on("click", function (event) {
      if (
        !$(event.target).closest(".nav-right__search").length &&
        !$(event.target).is(".nav-right__search-icon")
      ) {
        $(".nav-right__search-icon.active").removeClass("active");
        $(".nav-right__search-inner ").slideUp();
      }
    });

    // sidebar_btn
    $(".sidebar_btn").on("click", function () {
      $(".cus_scrollbar").toggleClass("show");
    });

    // faq
    $(".accordion-header").on("click", function () {
      $(".accordion-item").removeClass("accordion_bg");
      $(".accordion .accordion-button:not(.collapsed)")
        .parent()
        .closest(".accordion-item")
        .toggleClass("accordion_bg");
    });

    // browse-spaces-filter__tab
    $("#browse-spaces-filter__tab li a").on("click", function () {
      // fetch the class of the clicked item
      var ourClass = $(this).attr("class");

      // reset the active class on all the buttons
      $("#browse-spaces-filter__tab li").removeClass("active");
      // update the active state on our clicked button
      $(this).parent().addClass("active");

      if (ourClass == "all") {
        // show all our items
        $("#browse-spaces-filter__content").children("div.item").show();
      } else {
        // hide all elements that don't share ourClass
        $("#browse-spaces-filter__content")
          .children("div:not(." + ourClass + ")")
          .hide();
        // show all elements that do share ourClass
        $("#browse-spaces-filter__content")
          .children("div." + ourClass)
          .show();
      }
      return false;
    });

    // contact form
    // ajax
    jQuery("#frmContactus").on("submit", function (e) {
      jQuery("#msg").html("");
      jQuery("#submit").html("Please wait....");
      jQuery("#submit").attr("disabled", true);
      jQuery.ajax({
        url: "mail.php",
        type: "POST",
        data: jQuery("#frmContactus").serialize(),
        success: function (result) {
          jQuery("#msg").html(result);
          jQuery("#submit").html("Send Message");
          jQuery("#submit").attr("disabled", false);
          jQuery("#frmContactus")[0].reset();

          setTimeout(function () {
            $(".alert-dismissible").fadeOut("slow", function () {
              $(this).remove();
            });
          }, 3000);
        },
      });
      e.preventDefault();
    });

    // Email Subscribe
    jQuery("#frmSubscribe").on("submit", function (e) {
      var emailSubscribe = jQuery("input[name='sMail']").val();
      jQuery("#subscribeMsg").html("");
      jQuery("#emailSubscribe").html("Please wait....");
      jQuery("#emailSubscribe").attr("disabled", true);
      jQuery.ajax({
        url: "mail.php",
        type: "POST",
        data: {
          subscribes: "",
          emailSubscribe: emailSubscribe,
        },
        success: function (result) {
          jQuery("#subscribeMsg").html(result);
          jQuery("#emailSubscribe").html("Subscribe");
          jQuery("#emailSubscribe").attr("disabled", false);
          jQuery("#frmSubscribe")[0].reset();

          setTimeout(function () {
            $(".alert-dismissible").fadeOut("slow", function () {
              $(this).remove();
            });
          }, 3000);
        },
      });
      e.preventDefault();
    });

    // sec-mar remove with elementor
    $(".elementor").parents(".sec-mar").removeClass("sec-mar");

    $(".main-menu > ul > li").slice(-3).addClass("last_nav");

    // copyright year
    $("#copyYear").text(new Date().getFullYear());
  });

  $(function () {
    $(
      ".btn_theme, .cus_blog_btn, .tagcloud a, .wc-block-checkout__actions_row .wc-block-components-checkout-place-order-button, li.product .button, li.product .added_to_cart, .woocommerce-message .button, .wp-block-product-new .wp-block-button__link, .wc-block-cart__submit-container a.components-button, .woocommerce button.button, .woocommerce-account .woocommerce-MyAccount-content .woocommerce-button, .woocommerce div.product form.cart .button,.bank_apply a, .wc-block-components-totals-coupon__button, .submit, .button, a.wc-block-components-button"
    ).on("mousemove", function (e) {
      var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
      $(this).css({ "--top": relY + "px", "--left": relX + "px" });
    });
  });


  // Qucik View Custom post type

  // calculator_submit
  $("#calc_submit").on("click", function () {
    $(".calc").addClass("calc_hide");
    $(".calculator-result").addClass("calc_show");
  });

  // Calculator
  // loan1
  const amount = document.getElementById("amount"),
    interest = document.getElementById("interest"),
    year = document.getElementById("year"),
    monthly_cost = document.getElementById("monthly_cost"),
    calculate = document.getElementById("calc_submit"),
    total_value = document.getElementById("total_value");

  // loan2
  const amount2 = document.getElementById("amount2"),
    interest2 = document.getElementById("interest2"),
    year2 = document.getElementById("year2"),
    monthly_cost2 = document.getElementById("monthly_cost2"),
    calculate2 = document.getElementById("calc_submit2"),
    total_value2 = document.getElementById("total_value2");

  if (calculate) {
    calculate.addEventListener("click", function (e) {
      e.preventDefault();
      let total =
        (amount.value / 100) * interest.value + parseInt(amount.value);
      total_value.innerHTML = total.toFixed(2);
      monthly_cost.innerHTML = (total / (year.value * 12)).toFixed(2);

      // loan2
      let total2 =
        (amount2.value / 100) * interest2.value + parseInt(amount2.value);
      total_value2.innerHTML = total2.toFixed(2);
      monthly_cost2.innerHTML = (total2 / (year2.value * 12)).toFixed(2);
    });
  }
});
