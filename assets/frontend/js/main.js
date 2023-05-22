(function ($) {
  "user strict";
  $(window).on('load', function () {
    $('.preloader').fadeOut(1000);
    var img = $('.bg_img');
    img.css('background-image', function () {
      var bg = ('url(' + $(this).data('background') + ')');
      return bg;
    });
    dashboardPageHeader();
    footerBgMatch();
    sidebarFooterSpace();
    getdate();
    fixedFooter();
    contactHero();
  });
  function dashboardPageHeader() {
    var dashboardPageHeader = $('.dashboard__page__header');
    var dashboardPageHeaderControl = $('.dashboard__page__header').next('*');
    if(dashboardPageHeaderControl.hasClass('mt--120')) {
      dashboardPageHeader.removeClass('h-auto');
    } else {
      dashboardPageHeaderControl.find('*').first().addClass('pt-50');
    }
  }
  function contactHero() {
    var contactHeroSpace = $('.hero-section');
    var contactHeroSpaceForm = $('.hero-section').next('*');
    if(contactHeroSpaceForm.hasClass('transform--top')) {
      contactHeroSpace.addClass('contact--hero');
    }
  }
  function footerBgMatch() {
    var sectionBg = $('.newsletter-section').prev();
    var newsletter = $('.newsletter-section');
    if(sectionBg.hasClass('bg--section')){
      newsletter.addClass('bg--section');
    }
  }
  function sidebarFooterSpace() {
    var height = $('.sidebar__footer').height();
    $('.dashboard__sidebar, .main__sidebar').css(`padding-bottom`, function(){
      var heightTwo = 1.5 * height;
      return heightTwo;
    })
  }
  function getdate() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      m = m < 10 ? '0'+m : m;
      if(h > 12) {
        h = h % 12;
      }
      if(h == 0) {
        h = h+1;
      }
      h = h < 10 ? '0'+h : h;
      $(".hours").text(h);
      $(".clone").text(" : ");
      $(".miniutes").text(m);
      setTimeout(function(){getdate()}, 100);
  }
  function fixedFooter() {
    var dashboardFooterHeight = $('.dashboard__footer').height();
    $('.dashboard__body').css(`padding-bottom`, function(){
      return dashboardFooterHeight;
    })
  }
  $(document).ready(function () {
    //Menu Dropdown Icon Adding
    $("ul>li>.submenu").parent("li").addClass("menu-item-has-children");
    // drop down menu width overflow problem fix
    $('ul').parent('li').hover(function () {
      var menu = $(this).find("ul");
      var menupos = $(menu).offset();
      if (menupos.left + menu.width() > $(window).width()) {
        var newpos = -$(menu).width();
        menu.css({
          left: newpos
        });
      }
    }); 
    $('.menu li a').on('click', function (e) {
      var element = $(this).parent('li');
      if (element.hasClass('open')) {
        element.removeClass('open');
        element.find('li').removeClass('open');
        element.find('ul').slideUp(300, "swing");
      } else {
        element.addClass('open');
        element.children('ul').slideDown(300, "swing");
        element.siblings('li').children('ul').slideUp(300, "swing");
        element.siblings('li').removeClass('open');
        element.siblings('li').find('li').removeClass('open');
        element.siblings('li').find('ul').slideUp(300, "swing");
      }
    })
    $('.client__item__thumb').on('mouseover', function(){
      var feature = $(this).parent('.client__item');
      feature.siblings('.client__item').removeClass('active');
      feature.addClass('active');
    })
    // Scroll To Top
    var scrollTop = $(".scrollToTop");
    $(window).on('scroll', function () {
      if ($(this).scrollTop() < 500) {
        scrollTop.removeClass("active");
      } else {
        scrollTop.addClass("active");
      }
    });
    //header
    // var header = $("header");
    // $(window).on('scroll', function () {
    //   if ($(this).scrollTop() < 1) {
    //     header.removeClass("active");
    //   } else {
    //     header.addClass("active");
    //   }
    // });
    //Click event to scroll to top
    $('.scrollToTop').on('click', function () {
      $('html, body').animate({
        scrollTop: 0
      }, 500);
      return false;
    });
    //Header Bar
    $('.header-bar').on('click', function () {
      $(this).toggleClass('active');
      $('.overlay').toggleClass('active');
      $('.menu').toggleClass('active');
    })
    $('.overlay').on('click', function () {
      $('.menu, .overlay, .header-bar, .dashboard__sidebar').removeClass('active');
    });
    $('.faq__wrapper .faq__title').on('click', function (e) {
      var element = $(this).parent('.faq__item');
      if (element.hasClass('open')) {
        element.removeClass('open');
        element.find('.faq__content').removeClass('open');
        element.find('.faq__content').slideUp(200, "swing");
      } else {
        element.addClass('open');
        element.children('.faq__content').slideDown(200, "swing");
        element.siblings('.faq__item').children('.faq__content').slideUp(200, "swing");
        element.siblings('.faq__item').removeClass('open');
        element.siblings('.faq__item').find('.faq__title').removeClass('open');
        element.siblings('.faq__item').find('.faq__content').slideUp(200, "swing");
      }
    });
    $('.sidebar__bar').on('click', function(){
      $('.dashboard-section').toggleClass('sidebar__collapse');
    })
    $('.user__icon__thumb').on('click', function(){
      $('.user__menu').toggleClass('active');
    })
    $('.dashboard__sidebar__toggle').on('click', function(){
      $('.dashboard__sidebar').addClass('active');
      $('.overlay').addClass('active');
    })
    //partner__contact
    $('.referral__partner__item .contact--control').on('click', function(){
        var elem = $(this).parent('.referral__partner___content').parent('.referral__partner__left').parent('.referral__partner__item');
        if(elem.hasClass('open')){
          elem.removeClass('open');
          elem.find('.partner__contact').slideUp(300);
        }else {
          elem.addClass('open');
          elem.find('.partner__contact').slideDown(300);
        }
    })
    $('.crypto__history__header').on('click', function(){
		var cryptoOpen = $(this).parent('.crypto__history__item');
		if(cryptoOpen.hasClass('open')) {
			cryptoOpen.removeClass('open');
			cryptoOpen.children('.crypto__history__body').slideUp(500);
		}else {
			cryptoOpen.addClass('open');
			cryptoOpen.children('.crypto__history__body').slideDown(500);
		}
    })
  });
})(jQuery);