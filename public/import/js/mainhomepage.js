/**
* Template Name: Impact
* Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
* Updated: Jun 29 2024 with Bootstrap v5.3.3
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function () {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  mobileNavToggleBtn.addEventListener('click', mobileNavToogle);

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function (e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function (swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);


  /**
   * Init isotope layout and filters
   */
  document.querySelectorAll('.isotope-layout').forEach(function (isotopeItem) {
    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function () {
      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function (filters) {
      filters.addEventListener('click', function () {
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }
      }, false);
    });

  });

  /**
   * Frequently Asked Questions Toggle
   */
  document.querySelectorAll('.faq-item h3, .faq-item .faq-toggle').forEach((faqItem) => {
    faqItem.addEventListener('click', () => {
      faqItem.parentNode.classList.toggle('faq-active');
    });
  });

  /**
   * Correct scrolling position upon page load for URLs containing hash links.
   */
  window.addEventListener('load', function (e) {
    if (window.location.hash) {
      if (document.querySelector(window.location.hash)) {
        setTimeout(() => {
          let section = document.querySelector(window.location.hash);
          let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
          window.scrollTo({
            top: section.offsetTop - parseInt(scrollMarginTop),
            behavior: 'smooth'
          });
        }, 100);
      }
    }
  });

  /**
   * Navmenu Scrollspy
   */
  let navmenulinks = document.querySelectorAll('.navmenu a');

  function navmenuScrollspy() {
    navmenulinks.forEach(navmenulink => {
      if (!navmenulink.hash) return;
      let section = document.querySelector(navmenulink.hash);
      if (!section) return;
      let position = window.scrollY + 200;
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
        navmenulink.classList.add('active');
      } else {
        navmenulink.classList.remove('active');
      }
    })
  }
  window.addEventListener('load', navmenuScrollspy);
  document.addEventListener('scroll', navmenuScrollspy);

})();

//Homepage js
  document.addEventListener('DOMContentLoaded', function () {
    const currentDate = new Date();

    function formatDate(date) {
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        return new Intl.DateTimeFormat('en-US', options).format(date);
    }

    function getDayName(date) {
        const options = { weekday: 'long' };
        return new Intl.DateTimeFormat('en-US', options).format(date);
    }

    const formattedDate = formatDate(currentDate);
    const dayName = getDayName(currentDate);

    const currentDateElement = document.getElementById('current-date');
    const todaysDateElement = document.getElementById('todays-date');
    
    if (currentDateElement) {
        currentDateElement.textContent = dayName;
    }

    if (todaysDateElement) {
        todaysDateElement.textContent = formattedDate;
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var customEventContainer = document.getElementById('custom-event-container');
    var pillHeading = document.querySelector('.pill-heading');

    // Array of darker shades for background colors
    const colorPairs = [
        { background: '#63aee1' },
        { background: '#63aee1' },
        { background: '#63aee1' },
        { background: '#63aee1' },
        { background: '#63aee1' }
    ];

    var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'today',
            center: 'title',
            right: 'prev,next'
        },
        views: {
            dayGridMonth: { type: 'dayGridMonth' }
        },
        events: function (fetchInfo, successCallback, failureCallback) {
            fetch('/events')
                .then(response => response.json())
                .then(data => {
                    var audiences = ["all", "Barangay residents"];
                    var filteredEvents = data.events.filter(event => audiences.includes(event.audience));

                    var transformedEvents = filteredEvents.map(event => ({
                        id: event.id,
                        resourceId: event.resourceId || 'a',
                        title: event.title,
                        start: event.start,
                        end: event.end
                    }));

                    successCallback(transformedEvents);
                    updateMonthHeading(calendar.getDate());
                    displayEventsForMonth(calendar.getDate(), transformedEvents);
                })
                .catch(error => {
                    console.error('Error fetching events:', error);
                    failureCallback(error);
                });
        },
        eventDidMount: function(info) {
            // Randomly select a background color from the colorPairs array
            var randomColor = colorPairs[Math.floor(Math.random() * colorPairs.length)].background;
            info.el.style.backgroundColor = randomColor;
            info.el.style.border = 'none';
            info.el.style.color = '#333';
        },
        datesSet: function (info) {
            fetch('/events')
                .then(response => response.json())
                .then(data => {
                    var audiences = ["all", "Barangay residents"];
                    var filteredEvents = data.events.filter(event => audiences.includes(event.audience));
                    var transformedEvents = filteredEvents.map(event => ({
                        id: event.id,
                        resourceId: event.resourceId || 'a',
                        title: event.title,
                        start: event.start,
                        end: event.end
                    }));

                    updateMonthHeading(calendar.getDate());
                    displayEventsForMonth(calendar.getDate(), transformedEvents);
                })
                .catch(error => {
                    console.error('Error fetching events:', error);
                });
        }
    });

    calendar.render();

    function displayEventsForMonth(date, events) {
        var monthStart = new Date(date.getFullYear(), date.getMonth(), 1);
        var monthEnd = new Date(date.getFullYear(), date.getMonth() + 1, 0);

        var monthEvents = events.filter(event => {
            var eventDate = new Date(event.start);
            return eventDate >= monthStart && eventDate <= monthEnd;
        });

        // Limit to the first 5 events
        monthEvents = monthEvents.slice(0, 7);

        customEventContainer.innerHTML = '';

        if (monthEvents.length === 0) {
            customEventContainer.innerHTML = `
                <div class="col-lg-11 col-md-12 col-sm-12 mb-3 ms-3">
                    <div class="row align-items-stretch h-100">
                        <div class="col-sm-10 card text-center left-schedule me-2 card border-start-lg border-start-primary">
                            <div class="h5" style="margin-bottom: 0.20rem;">
                                <span class="h5">No events for this month.</span>
                            </div>
                        </div>
                    </div>
                </div>`;
        } else {
            monthEvents.forEach(event => {
                var eventDate = new Date(event.start);
                var formattedDate = eventDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric' });
                var [month, day] = formattedDate.split(' ');

                var eventHTML = `
                    <div class="col-lg-11 col-md-12 col-sm-12 mb-3 mt-2">
                        <div class="row justify-content-center">
                            <div class="col-sm-3 d-flex align-items-center justify-content-center card text-center left-schedule me-2 border-start-lg border-start-primary">
                                <div class="h5" style="margin-bottom: 0.20rem;">
                                    <span style="color: #3576CA">${day}</span>
                                </div>
                            </div>
                            <div class="col-sm-8 card d-flex flex-column p-2" style="border: none; background-color: #eaf4fd; height: 100%;">
                                <div class="d-flex flex-column justify-content-center" style="height: 100%;">
                                    <div class="h6" style="margin-bottom: 0.30rem;">${event.title}</div>
                                    <div class="text-muted">${eventDate.toLocaleTimeString()}</div>
                                </div>
                            </div>
                        </div>
                    </div>`;

                customEventContainer.insertAdjacentHTML('beforeend', eventHTML);
            });
        }
    }

    function updateMonthHeading(date) {
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var month = monthNames[date.getMonth()];
        var year = date.getFullYear();
        pillHeading.textContent = `${month} ${year}`;
    }
});
