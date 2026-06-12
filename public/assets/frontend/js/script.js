  // Highlight active nav link based on current URL
  document.querySelectorAll('nav.navbar .nav-item.nav-link').forEach(function(link) {
      if (link.href === window.location.href) {
          link.classList.add('active');
      }
  });

//   Carousel / Slider section
  $(document).ready(function () {

    $(".header-carousel").owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        smartSpeed: 800,
        loop: true,
        nav: true,
        dots: true,
        items: 1,
        navText: [
            '<span>&#8592;</span>',
            '<span>&#8594;</span>'
        ],
        onInitialized: function (e) {
            resetProgress(e);
        },
        onTranslated: function (e) {
            resetProgress(e);
        }
    });

    function resetProgress(e) {
        // Reset all progress bars
        $('.owl-carousel-item').css('transition', 'none');
        $('.owl-carousel-item::after');

        // Re-trigger the active slide CSS animation
        var $active = $(e.target).find('.owl-item.active .owl-carousel-item');
        $active.css('animation', 'none');
        setTimeout(function () {
            $active.css('animation', '');
        }, 10);
    }

});

// IMPACT
$(document).ready(function () {

    var $impSection = $('.impact-section');

    if (!$impSection.length) {
        console.warn('Impact section not found');
        return;
    }

    var items = [];
    $impSection.find('.row.g-4 .col-lg-3').each(function () {
        var value = $(this).find('h1.display-3').text().trim();
        var label = $(this).find('h5.text-white').text().trim();
        if (value && label) {
            items.push({ value: value, label: label });
        }
    });

    if (!items.length) {
        console.warn('No impact items found to build ticker');
        return;
    }

    function buildCards(list) {
        return list.map(function (item) {
            return '<div class="imp-ticker-card">' +
                '<div class="imp-ticker-value">' + item.value + '</div>' +
                '<div class="imp-ticker-divider"></div>' +
                '<div class="imp-ticker-label">' + item.label + '</div>' +
                '</div>';
        }).join('');
    }

    var cardHTML = buildCards(items) + buildCards(items);

    var tickerHTML = '<div class="imp-ticker-wrap">' +
        '<div class="imp-ticker-track">' + cardHTML + '</div>' +
        '</div>';

    $impSection.find('.row.g-4').first().before(tickerHTML);
});

// SERVICES SLIDER JS
$(document).ready(function () {

    $('.services-carousel').owlCarousel({
        loop: true,
        margin: 22,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        smartSpeed: 600,
        navText: [
            '<span>&#8592;</span>',
            '<span>&#8594;</span>'
        ],
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            992: { items: 3 }
        }
    });

});

$(document).ready(function () {

    $('.services-carousel').owlCarousel({
        loop: true,
        margin: 22,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        smartSpeed: 600,
        navText: [
            '<span>&#8592;</span>',
            '<span>&#8594;</span>'
        ],
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            992: { items: 3 }
        }
    });

});

/**
 * projects-index.js
 * Isotope portfolio filtering with animated pill-tab switcher.
 * Requires: Isotope (already loaded via your theme or CDN)
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        var $grid = document.querySelector('.portfolio-container');
        if (!$grid) return;

        // --- Isotope init (wait for images) ---
        var iso;

        function initIsotope() {
            if (typeof Isotope === 'undefined') return;

            iso = new Isotope($grid, {
                itemSelector: '.portfolio-item',
                layoutMode: 'fitRows',
                transitionDuration: '0.45s'
            });
        }

        // imagesLoaded for proper layout after images resolve
        if (typeof imagesLoaded !== 'undefined') {
            imagesLoaded($grid, initIsotope);
        } else {
            initIsotope();
        }

        // --- Filter buttons ---
        var filters = document.querySelectorAll('#portfolio-flters li');

        filters.forEach(function (btn) {
            btn.addEventListener('click', function () {
                // Update active state
                filters.forEach(function (f) { f.classList.remove('active'); });
                this.classList.add('active');

                // Apply filter
                if (iso) {
                    var filterValue = this.dataset.filter;
                    iso.arrange({ filter: filterValue === '*' ? '*' : '.' + this.dataset.filter });
                }
            });
        });

    });
})();