/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        // Enhance Bootstrap toggling
        $('#tuckerNav li.menu-item-has-children > a').attr({
          "data-toggle": "dropdown",
          "role": "button",
          "aria-haspopup": "true",
          "aria-expanded": "false"
        });

        if ($('.gallery').length) {
          var galleries = document.querySelectorAll('.gallery');
          for (g = 0; g < galleries.length; g++) {
            var slider = "siemaSlider-" + g;
            galleries[g].classList.add('siema');
            galleries[g].classList.add(slider);
          }
        }

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired

        if ($('.gallery').length) {
          var siemas = document.querySelectorAll('.siema');

          Siema.prototype.addArrows = function() {
            var _this = this; // ES5 workaround
            // make buttons & append them inside Siema's container
            this.prevArrow = document.createElement('p');
            this.nextArrow = document.createElement('p');
            this.prevArrow.innerHTML = '<span>\uf104</span>';
            this.nextArrow.innerHTML = '<span>\uf105</span>';
            this.prevArrow.classList.add('prevArrow');
            this.nextArrow.classList.add('nextArrow');
            this.selector.appendChild(this.prevArrow);
            this.selector.appendChild(this.nextArrow);

            this.prevArrow.addEventListener('click', function() {
              return _this.prev();
            });
            this.nextArrow.addEventListener('click', function() {
              return _this.next();
            });
          };

          Siema.prototype.autoPlay = function() {
            var _this = this;

            this.autoPlay = setInterval(function() {
              return _this.next();
            }, 5000);

            this.selector.addEventListener('mouseover', function() {
              clearInterval(_this.autoPlay);
            });
            this.selector.addEventListener('mouseout', function() {
              _this.autoPlay = setInterval(function() {
                return _this.next();
              }, 5000);
            });
          };

          for (i = 0; i < siemas.length; i++) {
            var instance = new Siema({
              selector: siemas[i],
              loop: true,
              duration: 300
            });
            instance.addArrows();
            instance.autoPlay();
          }

          var sliderHeight = $('.siema').height();
          $('.siema .gallery-item figcaption').each(function() {
            var slideHeight = $(this).parent().height();
            var captionBottom = (slideHeight / 2) - (sliderHeight / 2);
            $(this).css('bottom', captionBottom);
          });
        } // endif ($('.gallery').length)


      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    },
    'newsletter': {
      init: function() {
        $("#ctct_signup").submit(function(event) {
          // stop the form from submitting the normal way and refreshing the page
          event.preventDefault();
          // get the form data
          var formData = $("#ctct_signup").serialize();
          // process the form
          $.ajax({
            type: 'POST',
            url: 'https://visitor2.constantcontact.com/api/signup',
            data: formData,
            dataType: 'json',
            success: function(data) {
              $("#ctct_signup").replaceWith("<p>Subscribed! Thanks for joining our mailing list!</p>");
            },
            error: function(response) {
              $("#ctct_signup").replaceWith("<p>The server returned an error: Status " + response.status + ": " + response.responseText + "</p><p>Please <a href=\"mailto:programs@maisontuckerhouse.ca\">contact our webmaster</a> and they will subscribe you manually and fix this error. Thanks!");
            }
          });
        });
      },
      finalize: function() {

      }
    },
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
