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