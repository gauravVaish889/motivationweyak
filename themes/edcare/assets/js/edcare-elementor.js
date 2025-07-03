(function($) {
    "use strict";

    function heroBanner() {

        $(".odometer").waypoint(
            function() {
                var odo = $(".odometer");
                odo.each(function() {
                    var countNumber = $(this).attr("data-count");
                    $(this).html(countNumber);
                });
            }, {
                offset: "80%",
                triggerOnce: true,
            }
        );

        // Venobox Video
        new VenoBox({
            selector: ".video-popup, .img-popup",
            bgcolor: "transparent",
            numeration: true,
            infinigall: true,
            spinner: "plane",
        });
    }

    function aboutSection() {
        $(".odometer").waypoint(
            function() {
                var odo = $(".odometer");
                odo.each(function() {
                    var countNumber = $(this).attr("data-count");
                    $(this).html(countNumber);
                });
            }, {
                offset: "80%",
                triggerOnce: true,
            }
        );
    }

    function funFact() {
        $(".odometer").waypoint(
            function() {
                var odo = $(".odometer");
                odo.each(function() {
                    var countNumber = $(this).attr("data-count");
                    $(this).html(countNumber);
                });
            }, {
                offset: "80%",
                triggerOnce: true,
            }
        );
    }

    function testimonialSlider() {
        $('.testi-review').each(function() {
            let rate = $(this).data('rate'); // Get the rating from data-rate
            let stars = $(this).find('.star-container');

            stars.each(function(index) {
                let starFill = $('<i class="fa-solid fa-star starfill"></i>'); // Create filled star overlay
                $(this).append(starFill);

                if (rate > index) {
                    if (rate < index + 1) {
                        // Fractional star
                        starFill.css('width', `${(rate - index) * 100}%`);
                    } else {
                        // Full star
                        starFill.css('width', '100%');
                    }
                } else {
                    // No star fill
                    starFill.css('width', '0%');
                }
            });
        });
        // Testi Carousel
        var swiperTesti = new Swiper(".testi-carousel", {
            slidesPerView: 2,
            spaceBetween: 24,
            slidesPerGroup: 1,
            loop: true,
            autoplay: true,
            grabcursor: true,
            speed: 600,
            navigation: {
                nextEl: ".course-feature .swiper-prev",
                prevEl: ".course-feature .swiper-next",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 24,
                },
                767: {
                    slidesPerView: 2,
                    slidesPerGroup: 1,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 2,
                    slidesPerGroup: 1,
                },
            },
        });

        // Testi Carousel
        var swiperTesti = new Swiper(".testi-carousel-2", {
            slidesPerView: 1,
            spaceBetween: 24,
            slidesPerGroup: 1,
            loop: true,
            autoplay: true,
            grabcursor: true,
            speed: 600,
            navigation: {
                nextEl: ".testi-carousel-wrap-2 .swiper-prev",
                prevEl: ".testi-carousel-wrap-2 .swiper-next",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 24,
                },
                767: {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                },
            },
        });

        // Testi Carousel
        var swiperTesti = new Swiper(".testi-carousel-3", {
            slidesPerView: 3,
            spaceBetween: 24,
            slidesPerGroup: 1,
            loop: true,
            autoplay: true,
            grabcursor: true,
            speed: 600,
            navigation: {
                nextEl: ".testi-carousel-wrap-2 .swiper-prev",
                prevEl: ".testi-carousel-wrap-2 .swiper-next",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 24,
                },
                767: {
                    slidesPerView: 2,
                    slidesPerGroup: 1,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 3,
                    slidesPerGroup: 1,
                },
            },
        });
    }

    function courseFeaturesSlider() {
        var swiperCourse = new Swiper(".course-feature-carosuel", {
            slidesPerView: 4,
            spaceBetween: 24,
            slidesPerGroup: 1,
            loop: true,
            autoplay: true,
            grabcursor: true,
            speed: 600,
            navigation: {
                nextEl: ".course-feature .swiper-prev",
                prevEl: ".course-feature .swiper-next",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 24,
                },
                767: {
                    slidesPerView: 2,
                    slidesPerGroup: 1,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 3,
                    slidesPerGroup: 1,
                },
                1200: {
                    slidesPerView: 4,
                    slidesPerGroup: 1,
                },
            },
        });
    }

    function subscribeForm() {
        $("[data-background").each(function() {
            $(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
        });
    }

    function eventSlider() {
        var swiperEvent = new Swiper(".event-carousel", {
            slidesPerView: 3,
            spaceBetween: 24,
            slidesPerGroup: 1,
            loop: true,
            autoplay: true,
            grabcursor: true,
            speed: 600,
            navigation: {
                nextEl: ".event-section .swiper-prev",
                prevEl: ".event-section .swiper-next",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 24,
                },
                767: {
                    slidesPerView: 2,
                    slidesPerGroup: 1,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 2,
                    slidesPerGroup: 1,
                },
                1200: {
                    slidesPerView: 2,
                    slidesPerGroup: 1,
                },
            },
        });
    }

    function brandSlider() {
        var swiperSponsor = new Swiper(".sponsor-carousel", {
            slidesPerView: 4,
            spaceBetween: 24,
            slidesPerGroup: 1,
            loop: true,
            autoplay: false,
            grabcursor: true,
            speed: 600,
            breakpoints: {
                320: {
                    slidesPerView: 2,
                    slidesPerGroup: 1,
                    spaceBetween: 25,
                },
                767: {
                    slidesPerView: 3,
                    slidesPerGroup: 1,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    slidesPerGroup: 1,
                },
            },
        });
    }

    function ctaSection() {
        $("[data-background").each(function() {
            $(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
        });
    }

    function counterSection() {

        $(".odometer").waypoint(
            function() {
                var odo = $(".odometer");
                odo.each(function() {
                    var countNumber = $(this).attr("data-count");
                    $(this).html(countNumber);
                });
            }, {
                offset: "80%",
                triggerOnce: true,
            }
        );
    }

    function courseSlider() {

        var swiperCourse = new Swiper(".course-carousel-2", {
            slidesPerView: 3,
            spaceBetween: 24,
            grabcursor: true,
            speed: 600,
            navigation: {
                nextEl: '.course-carousel-top .swiper-prev',
                prevEl: '.course-carousel-top .swiper-next',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 3,
                }
            },
        });
    }

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_hero_banner.default', heroBanner);
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_about.default', aboutSection);
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_fun_fact.default', funFact);
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_testimonial_slider.default', testimonialSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_features_slider.default', courseFeaturesSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_subscribe_form.default', subscribeForm);
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_event_post.default', eventSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_brand_slider.default', brandSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_cta.default', ctaSection);
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_counter.default', counterSection);
        elementorFrontend.hooks.addAction('frontend/element_ready/edcare_course_slider.default', courseSlider);
    });

})(jQuery);