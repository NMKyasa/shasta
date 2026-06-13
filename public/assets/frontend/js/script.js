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
    if (!$impSection.length) return;

    // Prevent duplicate injection
    if ($impSection.find('.imp-ticker-wrap').length > 0) return;

    var items = [];
    $impSection.find('.row.g-4 .col-lg-3').each(function () {
        var value = $(this).find('h1.display-3').text().trim();
        var label = $(this).find('h5.text-white').text().trim();
        if (value && label) items.push({ value: value, label: label });
    });

    if (!items.length) return;

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
    var tickerHTML = '<div class="imp-ticker-wrap"><div class="imp-ticker-track">' + cardHTML + '</div></div>';

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
 * Isotope portfolio filtering + lightbox button handler.
 * The entire .portfolio-inner card is an <a> tag, so the lightbox
 * eye button uses stopPropagation to prevent navigating to the project page.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        var $grid = document.querySelector('.portfolio-container');
        if (!$grid) return;

        // --- Isotope init ---
        var iso;

        function initIsotope() {
            if (typeof Isotope === 'undefined') return;
            iso = new Isotope($grid, {
                itemSelector: '.portfolio-item',
                layoutMode: 'fitRows',
                transitionDuration: '0.45s'
            });
        }

        if (typeof imagesLoaded !== 'undefined') {
            imagesLoaded($grid, initIsotope);
        } else {
            initIsotope();
        }

        // --- Filter buttons ---
        var filters = document.querySelectorAll('#portfolio-flters li');

        filters.forEach(function (btn) {
            btn.addEventListener('click', function () {
                filters.forEach(function (f) { f.classList.remove('active'); });
                this.classList.add('active');

                if (iso) {
                    var filterValue = this.dataset.filter;
                    iso.arrange({ filter: filterValue === '*' ? '*' : '.' + filterValue });
                }
            });
        });

        // --- Lightbox buttons ---
        // These are <span> elements inside the <a> card.
        // We stop propagation so the parent anchor doesn't also navigate.
        document.querySelectorAll('.portfolio-lightbox-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();   // don't bubble up to the <a> card link
                e.preventDefault();

                var src = this.dataset.lightboxSrc;
                if (!src) return;

                // If using Lightbox2
                if (typeof lightbox !== 'undefined') {
                    lightbox.start({ href: src, type: 'image' });
                    return;
                }

                // Fallback: open image in new tab
                window.open(src, '_blank');
            });
        });

    });
})();

// TESTIMONIALS JS
document.addEventListener('DOMContentLoaded', function () {
    // Let the template's own Owl init run.
    // We only nudge the dot sizes after each slide change
    // so active vs inactive photo sizes animate correctly.
    $(document).on('changed.owl.carousel', '.testimonial-carousel', function () {
        // Nothing needed — CSS handles active state automatically
    });
});

// TEAM READMORE JS
document.addEventListener('DOMContentLoaded', function () {

    // Build modal container once
    var modalHTML = `
        <div class="team-modal-overlay" id="teamModal">
            <div class="team-modal">
                <div class="team-modal-inner">
                    <button class="team-modal-close" id="teamModalClose" aria-label="Close">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <div id="teamModalPhoto"></div>
                    <div class="team-modal-body">
                        <h3 class="team-modal-name" id="teamModalName"></h3>
                        <span class="team-modal-position" id="teamModalPosition"></span>
                        <hr class="team-modal-divider">
                        <p class="team-modal-bio" id="teamModalBio"></p>
                        <div class="team-modal-social" id="teamModalSocial"></div>
                    </div>
                </div>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', modalHTML);

    var overlay  = document.getElementById('teamModal');
    var closeBtn = document.getElementById('teamModalClose');

    // Inject "Read more" button into each card that has a bio
    document.querySelectorAll('.team-item').forEach(function (card) {
        var bioEl = card.querySelector('p.small.text-muted');
        if (!bioEl) return;

        var btn = document.createElement('button');
        btn.className = 'team-readmore';
        btn.innerHTML = 'Read more <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M1 6h10M6 1l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        bioEl.insertAdjacentElement('afterend', btn);

        btn.addEventListener('click', function () {
            // Gather data from card
            var imgEl      = card.querySelector('img.img-fluid');
            var nameEl     = card.querySelector('h5');
            var positionEl = card.querySelector('span.text-primary');
            var socials    = card.querySelectorAll('.team-social a');

            // Full bio — stored in data attribute (we set it below)
            var fullBio = bioEl.getAttribute('data-full-bio') || bioEl.textContent.trim();

            // Photo
            var photoWrap = document.getElementById('teamModalPhoto');
            if (imgEl && imgEl.src) {
                photoWrap.innerHTML = '<img class="team-modal-photo" src="' + imgEl.src + '" alt="' + (nameEl ? nameEl.textContent.trim() : '') + '">';
            } else {
                photoWrap.innerHTML = '<div class="team-modal-photo-placeholder"><svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg></div>';
            }

            // Name, position, bio
            document.getElementById('teamModalName').textContent     = nameEl     ? nameEl.textContent.trim()     : '';
            document.getElementById('teamModalPosition').textContent = positionEl ? positionEl.textContent.trim() : '';
            document.getElementById('teamModalBio').textContent      = fullBio;

            // Social links
            var socialWrap = document.getElementById('teamModalSocial');
            socialWrap.innerHTML = '';
            socials.forEach(function (a) {
                var clone = a.cloneNode(true);
                clone.style.cssText = '';
                clone.style.opacity = '1';
                clone.style.transform = 'none';
                socialWrap.appendChild(clone);
            });

            // Open
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close on button or overlay click
    closeBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeModal();
    });

    // Close on Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    function closeModal() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
});