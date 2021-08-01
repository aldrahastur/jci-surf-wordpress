/* eslint-disable linebreak-style */
/* eslint-disable no-undef */
jQuery(document).ready(function () {
  /**
   * Global Vars
   */
  var body = jQuery('body');
  /**
   * Apply IE Styles
   */
  if (getInternetExplorerVersion() !== -1){
    jQuery('body').addClass('ie');
    if (jQuery(window).width() > 768) {
      var cards = jQuery('.card');
      cards.each(function(k, value) {
        value = jQuery(value);
        // eslint-disable-next-line no-undef
        imagesLoaded(value, function() {
          value = value.find('img');
          if (value.length > 0) {
            var valueParent = value.parent();
            if (value.outerWidth() / value.outerHeight() > valueParent.outerWidth() / valueParent.outerHeight()) {
              value.css('max-height', '100%');
            } else {
              value.css('max-width', '100%');
              valueParent.css('min-height', value.outerHeight());
            }
          }
        });
      });
    }
  }
  /**
   * Nav Menus
   */
  var mainNavItems = jQuery('.main-nav__item.menu-item-has-children');
  var subNav = jQuery('.header__sub-nav-wrapper');
  if (mainNavItems.length > 0) {
    mainNavItems.click(function(e) {
      e.preventDefault();
      var target = jQuery(e.target);
      var link = target.find('>a');
      var clickedIndex = target.index() + 1;
      if (link.hasClass('is-selected')) {
        //Only Collapse current Menu
        link.removeClass('is-selected');
        subNav.removeClass('is-open');
        subNav.find('.is-selected').removeClass('is-selected');
      } else {
        //Check if there is another menu open, if so close it
        if (mainNavItems.find('.is-selected').length > 0) {
          mainNavItems.find('.is-selected').removeClass('is-selected');
          subNav.find('.is-selected').removeClass('is-selected');
        }
        //Open current menu
        subNav.addClass('is-open');
        link.addClass('is-selected');
        subNav.find('.sub-nav:nth-child('+clickedIndex+')').addClass('is-selected');
      }
    });
    jQuery('.header__close').click(function() {
      mainNavItems.find('.is-selected').removeClass('is-selected');
      subNav.removeClass('is-open');
      subNav.find('.is-selected').removeClass('is-selected');
    });
  }
  var mobileNav = jQuery('.mobile-nav');
  if (mobileNav.length > 0) {
    var jsHeader = jQuery('.js-header');
    var headerToggle = jQuery('.header__toggle');
    headerToggle.click(function() {
      if (jsHeader.hasClass('is-open')) {
        jsHeader.removeClass('is-open');
        jsHeader.addClass('is-closed');
        headerToggle.removeClass('is-active');
      } else {
        jsHeader.removeClass('is-closed');
        jsHeader.addClass('is-open');
        headerToggle.addClass('is-active');
      }
    });
    var menuLinks = mobileNav.find('li.mobile-nav__item');
    menuLinks.each(function(k, value) {
      value = jQuery(value);
      var valueLink = value.find('>a');
      value.click(function(e) {
        var target = jQuery(e.target);
        e.stopPropagation();
        if (value.hasClass('is-not-selected')) {
          value.removeClass('is-not-selected');
          valueLink.removeClass('is-not-selected');
          value.addClass('is-selected');
          valueLink.addClass('is-selected');
          jQuery('body, html').animate({
            scrollTop: value.offset().top
          }, 400);
        } else {
          if (target.hasClass('is-selected')) {
            value.removeClass('is-selected');
            valueLink.removeClass('is-selected');
            value.addClass('is-not-selected');
            valueLink.addClass('is-not-selected');
          }
        }
      });
    });
  }
  /**
   * Hero Swiper
   */
  var heroSwiper = jQuery('.hero-swiper');
  if (heroSwiper.length > 0) {
    if (heroSwiper.find('.swiper-slide').length > 1) {
      new Swiper('.hero-swiper', {
        direction: 'horizontal',
        effect: 'slide',
        freeModeSticky: true,
        slidesPerView: 1,
        loop: true,
        centeredSlides: true,
        freeMode: false,
        pagination: {
          el: '.hero__pagination',
          clickable: true,
          renderBullet: function (index, className) {
            return '<li class="hero__pagination-item ' + className + '"></li>';
          }
        },
        autoplay: {
          delay: 5000,
          disableOnInteraction: false
        },
      });
    }
  }
  /**
   * Image Gallery Lightbox
   */
  var imageGallery = jQuery('.image-gallery.is-desktop');
  if (imageGallery.length > 0) {
    imageGallery.each(function(k, swiperValue) {
      swiperValue = jQuery(swiperValue);
      swiperValue.find('.gallery-swiper').addClass('gallery-swiper-'+k);
      var overlay = swiperValue.find('.image-gallery-overlay');
      var gallerySwiper = new Swiper('.gallery-swiper-'+k, {
        direction: 'horizontal',
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false
        },
      });
      swiperValue.find('.image-gallery__thumbnail').each(function(k, value) {
        value = jQuery(value);
        value.click(function() {
          var openIndex = value.data('index-image');
          gallerySwiper.slideTo(openIndex,0,false);
          overlay.removeClass('invis');
          body.addClass('is-modal-open');
        });
      });
      swiperValue.find('.image-gallery__thumbnail-redirect').click(function() {
        swiperValue.find('.image-gallery__thumbnail').first().trigger('click');
      });
      overlay.find('.image-gallery-overlay__close').click(function() {
        overlay.addClass('invis');
        body.removeClass('is-modal-open');
      });
      overlay.find('.image-gallery-overlay__next').click(function() {
        gallerySwiper.slideNext();
      });
      overlay.find('.image-gallery-overlay__prev').click(function() {
        gallerySwiper.slidePrev();
      });
    });
  }
  var mobileImageGallery = jQuery('.image-gallery.is-mobile');
  if (mobileImageGallery.length > 0) {
    mobileImageGallery.each(function(k, mobGalValue) {
      mobGalValue = jQuery(mobGalValue);
      mobGalValue.find('.swiper-container').addClass('gallery-swiper-'+k);
      mobGalValue.find('.toggle').click(function(e) {
        e.preventDefault();
        var slidesJSON = JSON.parse(mobGalValue.attr('data-images'));
        var swiperWrapper = mobGalValue.find('.swiper-wrapper');
        swiperWrapper.empty();
        jQuery.each(slidesJSON, function(k, JSONvalue) {
          if (JSONvalue.src) {
            swiperWrapper.append('<div class="image-gallery__slide swiper-slide"><div class="image-gallery__thumbnail"><figure class="figure"><div class="figure__image-wrapper is-highlighted"><img src="'+JSONvalue.src+'" class="figure__image"></div><figcaption class="figure__caption"><div class="image-gallery__caption caption"><div class="image-gallery__caption-meta caption__meta">'+JSONvalue.meta+'</div><div class="image-gallery__caption-title caption__title">'+JSONvalue.caption+'</div></div></figcaption></figure></div></div>');
          } else {
            swiperWrapper.append('<div class="image-gallery__slide swiper-slide"><div class="image-gallery__thumbnail"><figure class="figure"><div class="figure__image-wrapper is-highlighted"><div class="figure__image">'+JSONvalue.image+'</div></div><figcaption class="figure__caption"><div class="image-gallery__caption caption"><div class="image-gallery__caption-meta caption__meta">'+JSONvalue.meta+'</div><div class="image-gallery__caption-title caption__title">'+JSONvalue.caption+'</div></div></figcaption></figure></div></div>');
          }
        });
        new Swiper('.gallery-swiper-'+k, {
          direction: 'horizontal',
          loop: true,
          autoplay: {
            delay: 5000,
            disableOnInteraction: false
          },
        });
      });
    });
  }
  /**
   * JS Webforms
   */
  var jsWebform = jQuery('.js-webform, .wpcf7-form');
  if (jsWebform.length > 0) {
    jsWebform.each(function(k, formValue) {
      formValue = jQuery(formValue);
      var requiredInputsMap = [];
      formValue.find('input[required], input[aria-required="true"]').each(function(k, reqValue) {
        reqValue = jQuery(reqValue);
        requiredInputsMap.push({value: reqValue, name: reqValue.attr('name')});
        reqValue.removeAttr('required');
      });
      formValue.find('textarea[required], textarea[aria-required="true"]').each(function(k, reqValue) {
        reqValue = jQuery(reqValue);
        requiredInputsMap.push({value: reqValue, name: reqValue.attr('name')});
        reqValue.removeAttr('required');
      });
      formValue.submit(function(e) {
        e.preventDefault();
        var failedInputs = [];
        formValue.find('.is-invalid').removeClass('is-invalid');
        jQuery(requiredInputsMap).each(function(key) {
          if (requiredInputsMap[key].value.attr('type') === 'radio') {
            var sameNameFilter = requiredInputsMap.filter(function(x) {
              return x.name === requiredInputsMap[key].name;
            });
            var isChecked = false;
            jQuery(sameNameFilter).each(function(k, value) {
              if (value.value.is(':checked')) {
                isChecked = true;
                return false;
              }
            });
            if (!isChecked) {
              requiredInputsMap[key].value.closest('.form-item').addClass('is-invalid');
              requiredInputsMap[key].value.closest('.js-webform-radios').addClass('is-invalid');
              failedInputs.push(requiredInputsMap[key].value.closest('.webform-flex--container').data('error'));
            }
          } else if (requiredInputsMap[key].value.attr('type') === 'checkbox') {
            if (requiredInputsMap[key].value.is(':checked')) {
              return false;
            } else {
              requiredInputsMap[key].value.closest('.js-form-type-checkbox').addClass('is-invalid');
              failedInputs.push(requiredInputsMap[key].value.closest('.webform-flex--container').data('error'));
            }
          } else {
            if (requiredInputsMap[key].value.val().length <= 0) {
              requiredInputsMap[key].value.closest('.form-item').addClass('is-invalid');
              failedInputs.push(requiredInputsMap[key].value.closest('.webform-flex--container').data('error'));
            }
          }
        });
        failedInputs = jQuery.uniqueSort(failedInputs);
        jQuery('.error-list').remove();
        if (failedInputs.length > 0) {
          var errors = jQuery('<div>', {class: 'error-list'});
          var errorList = jQuery('<ul>', {class: 'item-list__comma-list'});
          if (failedInputs.length === 1) {
            errors.text('1 Fehler wurde gefunden');
          } else {
            errors.text(failedInputs.length+' Fehler wurden gefunden');
          }
          errors.append(errorList);
          jQuery.each(failedInputs, function(k, errorValue) {
            errorList.append(jQuery('<li>', {text: errorValue}));
          });
          formValue.prepend(errors);
          jQuery('body, html').animate({
            scrollTop: errors.offset().top
          }, 200);
        } else {
          formValue[0].submit();
        }
      });
    });
  }
  /**
   * Cookie Banner
   */
  var cookieBanner = jQuery('#cookie-banner');
  if (cookieBanner.length > 0) {
    if (!getCookie('cookie-consent')) {
      cookieBanner.show();
    }
    cookieBanner.find('.accept').click(function() {
      setCookie('cookie-consent', true, 365);
      cookieBanner.hide();
    });
    cookieBanner.find('.cookie-banner__close').click(function() {
      cookieBanner.hide();
    });
  }
  /**
   * Card Contets
   */
  var cardSections = jQuery('.section');
  if (cardSections.length > 0) {
    cardSections.each(function(k, value) {
      var cardContents = jQuery(value).find('.card.is-vertical .card__content');
      imagesLoaded(cardContents, function() {
        var maxHeight = 0;
        cardContents.each(function(k, value) {
          value = jQuery(value);
          var h = value.outerHeight();
          if (h > maxHeight) {
            maxHeight = h;
          }
        });
        cardContents.each(function(k, value) {
          value = jQuery(value);
          value.css('height', maxHeight);
        });
      });
    });
  }
  var clickCards = jQuery('.card');
  if (clickCards.length > 0) {
    clickCards.each(function(k, value) {
      value = jQuery(value);
      if (value.data('url')) {
        value.click(function(e) {
          e.preventDefault();
          window.location = value.data('url');
        });
      }
    });
  }
  var eventWidget = jQuery('.event-widget');
  if (eventWidget.length > 0) {
    var closestRow = eventWidget.closest('.row');
    if (closestRow.children().length > 1) {
      var maxHeight = 610;
      imagesLoaded(closestRow, function() {
        closestRow.children().each(function(k, value) {
          value = jQuery(value);
          var valueCard = value.find('.card');
          if (valueCard.length > 0) {
            valueCardHeight = valueCard.height();
            if (valueCardHeight > maxHeight) {
              maxHeight = valueCardHeight;
            }
          }
          eventWidget.closest('.row').children().each(function(k, value) {
            value = jQuery(value);
            var valueCard = value.find('.card');
            if (valueCard.length > 0) {
              valueCard.height(maxHeight+5);
            }
          });
        });
      });
    }
  }
  /**
   * Calender Filter Nav
   */
  var eventOverviewHeader = jQuery('.event-overview-header');
  if (eventOverviewHeader.length > 0) {
    var weekdaysPrev = jQuery('.weekdays.prev');
    var weekdaysCurrent = jQuery('.weekdays.current');
    var weekdaysNext = jQuery('.weekdays.next');
    eventOverviewHeader.find('.week-nav .prev-week').click(function(e) {
      e.preventDefault();
      weekdaysPrev.show();
      weekdaysCurrent.hide();
      weekdaysNext.hide();
    });
    eventOverviewHeader.find('.week-nav .current-week').click(function(e) {
      e.preventDefault();
      weekdaysPrev.hide();
      weekdaysCurrent.show();
      weekdaysNext.hide();
    });
    eventOverviewHeader.find('.week-nav .next-week').click(function(e) {
      e.preventDefault();
      weekdaysPrev.hide();
      weekdaysCurrent.hide();
      weekdaysNext.show();
    });
  }
  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = 'expires='+ d.toUTCString();
    cvalue = JSON.stringify(cvalue);
    document.cookie = cname + '=' + cvalue + ';' + expires + '; path=/';
  }
  function getCookie(cname) {
    var name = cname + '=';
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) === ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) === 0) {
        return c.substring(name.length, c.length);
      }
    }
    return '';
  }

  /**
   * Check for IE (Better to be done at PHP Level)
   */
  function getInternetExplorerVersion() {
    var rV = -1;
    if (navigator.appName === 'Microsoft Internet Explorer' || navigator.appName === 'Netscape') {
      var uA = navigator.userAgent;
      var rE = new RegExp('MSIE ([0-9]{1,}[.0-9]{0,})');

      if (rE.exec(uA) != null) {
        rV = parseFloat(RegExp.$1);
      } else if (navigator.userAgent.match(/Trident.*rv:11\./)) {
        rV = 11;
      }
    }
    return rV;
  }

  /**
   * Event Calender
   */
  function updateCalendar(calendarType, vars) {
    var eventCalendar = jQuery('.mc-main');
    if (eventCalendar.length > 0) {
      var date = new Date();
      if (calendarType === 'month') {
        jQuery('.single-event').remove();
        jQuery('.week-headline').remove();
        jQuery('.list-headline').remove();
        eventCalendar.removeClass('is-list');
        eventCalendar.removeClass('is-week');
        eventCalendar.addClass('is-month');
        eventCalendar.find('.my-calendar-nav .my-calendar-prev').after('<li class="current-month"><a href="'+window.location.origin+window.location.pathname+'?cid=my-calendar&month='+date.toJSON().slice(5,7)+'&yr='+date.toJSON().slice(0,4)+'">aktueller Monat</a></li>');
        eventCalendar.find('tbody .mc-row').each(function(k,row) {
          row = jQuery(row);
          var events = [];
          row.find('.calendar-event').map(function() {
            return jQuery(this).attr('class');
          }).each(function(i, str) {
            if (!~$.inArray(str, events)) {
              events.push(str);
            }
          });
          row.addClass('big-row-'+events.length);
          if (events.length > 0) {
            jQuery.each(events, function(k, value) {
              value = '.'+value.replace(/ /g,'.');
              var events = row.find(value);
              var firstEvent = row.find(value).first();
              var eventLength = row.find(value).length;
              events.slice(1).remove();
              firstEvent.addClass('days-'+eventLength);
              firstEvent.addClass('slot-'+(k+1));
              firstEvent.show();
            });
          }
        });
      }
      if (calendarType === 'week') {
        jQuery('.single-event').remove();
        jQuery('.list-headline').remove();
        jQuery('.week-headline').remove();
        eventCalendar.removeClass('is-list');
        eventCalendar.removeClass('is-month');
        eventCalendar.addClass('is-week');
        eventCalendar.find('.my-calendar-nav .my-calendar-prev').after('<li class="current-week"><a href="'+window.location.origin+window.location.pathname+'?cid=my-calendar&time=week&dy='+(date.getDate()-date.getDay()+1)+'&month='+date.toJSON().slice(5,7)+'&yr='+date.toJSON().slice(0,4)+'">aktuelle Woche</a></li>');
        var eventsRow = eventCalendar.find('tbody .mc-row');
        var events = [];
        eventsRow.find('.calendar-event').map(function() {
          return jQuery(this).attr('class');
        }).each(function(i, str) {
          if (!~$.inArray(str, events)) {
            events.push(str);
          }
        });
        var params = {};
        params.action = 'get_listing_calendar';
        if (vars) {
          if (!vars.yr) {
            params.vars = '{"day":'+vars.dy+',"month":'+vars.month+'}';
          } else {
            params.vars = '{"day":'+vars.dy+',"month":'+vars.month+',"year":'+vars.yr+'}';
          }
        }
        jQuery.ajax(
            '/wp-admin/admin-ajax.php',
            {
              method: 'GET',
              data: params,
              success: addEventList
            }
        );
      }
      var list = jQuery('<a>', {class:'button list-button', text:'Liste'});
      list.click(getCalendarList);
      eventCalendar.find('.mc-time').append(list);
    }
  }
  function addEventList(result) {
    result = JSON.parse(result);
    var append = '';
    if (result.length > 0) {
      append += '<div class="headline-section week-headline"><div class="headline-section__content text-center container"><h2 class="headline-section__headline is-highlighted">Events der Woche</h2></div></div>';
    }
    jQuery.each(result, function(k, value) {
      append += '<div class="section single-event">';
      append += '<div class="card v-card" data-url="'+value.event_link+'">';
      if (value.event_image.length > 0) {
        append += '<div class="card__image-wrapper">';
        append += '<figure class="figure">';
        append += '<div class="figure__image-wrapper is-highlighted">';
        append += '<div class="figure__image">';
        append += '<img src="'+value.event_image+'" alt="">';
        append += '</div>';
        append += '</div>';
        append += '</figure>';
        append += '</div>';
      }
      append += '<div class="card__content">';
      append += '<ul class="card__meta-data no-list-style">';
      append += '<li class="card__meta-data-item is-text">Event</li>';
      append += '</ul>';
      append += '<ul class="card__meta-data no-list-style">';
      if (value.event_city.length > 0) {
        append += '<li class="card__meta-data-item is-date"><span class="locality">'+value.event_city+'</span></li>';
      }
      if (value.event_begin.length > 0) {
        append += '<li class="card__meta-data-item is-date">'+value.event_begin.slice(8,10)+'.'+value.event_begin.slice(5,7)+'.'+value.event_begin.slice(0,4)+'</li>';
      }
      append += '</ul>';
      append += '<div class="card__main">';
      append += '<h3 class="card__headline">';
      if (value.event_title.length > 0) {
        append += '<span>'+value.event_title+'</span>';
      }
      append += '</h3>';
      append += '</div>';
      append += '<div class="card__footer">';
      append += '<a href="'+value.event_link+'" ref="cta" class="card__cta is-link e-link" target="_self">';
      append += 'Mehr lesen';
      append += '<i class="card__icon fas fa-chevron-right" aria-hidden="true"></i>';
      append += '</a>';
      append += '</div>';
      append += '</div>';
      append += '</div>';
      append += '</div>';
    });
    jQuery('.mc-main').after(append);
  }
  var eventCalendar = jQuery('.mc-main');
  if (eventCalendar.length > 0) {
    if (window.location.href.indexOf('=week') > 0) {
      updateCalendar('week');
    } else if (window.location.href.indexOf('?mc_id=') <= 0) {
      updateCalendar('month');
    } else if (window.location.href.indexOf('?mc_id=') > 0) {
      jQuery('.breadcrumbs__item.is-last').click(function() {
        window.location = window.location.origin+window.location.pathname;
      });
    }
    jQuery(document).ajaxComplete(function(e,xhr,settings) {
      if (settings.url.indexOf('wp-admin') > 0) {
        return;
      }
      if (settings.url.indexOf('=week') > 0) {
        updateCalendar('week', getUrlVars(settings.url));
      } else {
        updateCalendar('month');
      }
    });
  }
  function getUrlVars(input) {
    var vars = [], hash;
    var hashes = input.slice(input.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
      hash = hashes[i].split('=');
      vars[hash[0]] = hash[1];
    }
    return vars;
  }
  function getCalendarList() {
    var eventCalendar = jQuery('.mc-main');
    var date = new Date();
    jQuery('.my-calendar-table').empty();
    jQuery('.my-calendar-table').text('Lade...');
    eventCalendar.removeClass('is-week');
    eventCalendar.removeClass('is-month');
    eventCalendar.addClass('is-list');
    jQuery('.single-event').remove();
    jQuery('.week-headline').remove();
    jQuery('.mc-time').empty();
    jQuery('.my-calendar-nav').remove();
    jQuery('.mc-time').hide();
    jQuery('.mc-time').append('<a href="'+window.location.origin+window.location.pathname+'?cid=my-calendar&amp;time=month&amp;dy='+(date.getDate()-date.getDay()+1)+'&amp;month='+date.toJSON().slice(5,7)+'&amp;yr='+date.toJSON().slice(0,4)+'" class="month mcajax">Monat</a>');
    jQuery('.mc-time').append('<a href="'+window.location.origin+window.location.pathname+'?cid=my-calendar&amp;time=week&amp;dy='+(date.getDate()-date.getDay()+1)+'&amp;month='+date.toJSON().slice(5,7)+'&amp;yr='+date.toJSON().slice(0,4)+'" class="month mcajax">Woche</a>');
    jQuery('.mc-time').append('<span class="mc-active week">Liste</span>');
    jQuery.ajax(
        '/wp-admin/admin-ajax.php',
        {
          method: 'GET',
          data: {action: 'get_all_events'},
          success: displayFullList
        }
    );
  }
  function displayFullList(result) {
    result = JSON.parse(result);
    jQuery('.my-calendar-table').text('');
    jQuery('.mc-time').show();
    var append = '';
    jQuery.each(result, function(k, innerValue) {
      if (innerValue.length > 0) {
        if (k === 'future') {
          append += '<div class="headline-section list-headline"><div class="headline-section__content text-center container"><h2 class="headline-section__headline is-highlighted">Bevorstehende Events</h2></div></div>';
        }
        if (k === 'past') {
          append += '<div class="headline-section list-headline"><div class="headline-section__content text-center container"><h2 class="headline-section__headline is-highlighted">Vergangene Events</h2></div></div>';
        }
      }
      jQuery.each(innerValue, function(k, value) {
        append += '<div class="section single-event">';
        append += '<div class="card v-card" data-url="'+value.event_link+'">';
        if (value.event_image.length > 0) {
          append += '<div class="card__image-wrapper">';
          append += '<figure class="figure">';
          append += '<div class="figure__image-wrapper is-highlighted">';
          append += '<div class="figure__image">';
          append += '<img src="'+value.event_image+'" alt="">';
          append += '</div>';
          append += '</div>';
          append += '</figure>';
          append += '</div>';
        }
        append += '<div class="card__content">';
        append += '<ul class="card__meta-data no-list-style">';
        append += '<li class="card__meta-data-item is-text">Event</li>';
        append += '</ul>';
        append += '<ul class="card__meta-data no-list-style">';
        if (value.event_city.length > 0) {
          append += '<li class="card__meta-data-item is-date"><span class="locality">'+value.event_city+'</span></li>';
        }
        if (value.event_begin.length > 0) {
          append += '<li class="card__meta-data-item is-date">'+value.event_begin.slice(8,10)+'.'+value.event_begin.slice(5,7)+'.'+value.event_begin.slice(0,4)+'</li>';
        }
        append += '</ul>';
        append += '<div class="card__main">';
        append += '<h3 class="card__headline">';
        if (value.event_title.length > 0) {
          append += '<span>'+value.event_title+'</span>';
        }
        append += '</h3>';
        append += '</div>';
        append += '<div class="card__footer">';
        append += '<a href="'+value.event_link+'" ref="cta" class="card__cta is-link e-link" target="_self">';
        append += 'Mehr lesen';
        append += '<i class="card__icon fas fa-chevron-right" aria-hidden="true"></i>';
        append += '</a>';
        append += '</div>';
        append += '</div>';
        append += '</div>';
        append += '</div>';
      });
    });
    jQuery('.mc-main').after(append);
  }

  /** Card carousel */
  var carouselCards = jQuery('.page__cards');

  if (carouselCards.children().length > 0) {
    carouselCards.attr('id', 'card_carousel_indicators')
    carouselCards.addClass('carousel slide')
    carouselCards.attr('data-ride', 'carousel')

    var childs = carouselCards.children();
    
    carouselCards.prepend('<div class="carousel-inner"></div>');
    
    $('.carousel-inner').prepend(childs);
    var carouselInner = $('.carousel-inner');

    for (var i= 0; i <= carouselInner.children().length; i++) {
      if (i == 0) {
        carouselInner.children().eq(i).addClass('active')
      }

      carouselInner.children().eq(i).addClass('carousel-item')
    }

    carouselInner.after('<a class="carousel-control-prev" href="#card_carousel_indicators" role="button" data-slide="prev">\n' +
        '    <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
        '    <span class="sr-only">Previous</span>\n' +
        '  </a>\n' +
        '  <a class="carousel-control-next" href="#card_carousel_indicators" role="button" data-slide="next">\n' +
        '    <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
        '    <span class="sr-only">Next</span>\n' +
        '  </a>')
  }

  var eventCardss = jQuery('.event__cards');

  if ($('.event__cards .section__content ').children().length > 0) {
    var eventCardChildren = $('.event__cards .section__content ').children();

    var eventCardDate = eventCardChildren.eq(0).find('.card__content').find('.card__meta-data');


    eventCardChildren.eq(0).find('.rte-content').remove()

    //eventCardChildren.find('.card__content').prepend(eventCardDate);

    for (var i = 0; i <= eventCardChildren.length; i++) {
      var eventCardDate = eventCardChildren.eq(i).find('.card__content').find('.card__meta-data');

      eventCardChildren.eq(i).find('.rte-content').remove()

      eventCardChildren.eq(i).find('.card__content').prepend(eventCardDate);
    }
  }
});

var time = 0;

window.addEventListener('scroll', function () {
  var $toTop = $('#toTop');

  $toTop.toggleClass('is-visible', (window.scrollY || document.body.scrollTop) > 0);
});

function smoothScrolltoTop () {
  var $body = $('html, body');
  $body.stop().animate({ scrollTop: 0 }, 500);
}

/**
 * Wrap Card images with Links
 */
$(window).on('load', function () {
  var $card = $('.card');

  $card.each(function (index, item) {
    var $link = $(item).find('a.card__cta.is-link');
    var $image = $(item).find('.figure__image img');

    if ($link.length) {
      $image.wrap('<a class="card__image-link" href="' + $link.attr('href') + '"></a>');
    }
  });
});
