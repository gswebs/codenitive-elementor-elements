(function ($) {
    const initWidgetReviewsCarousel = function ($scope) {
       
        const $swiperContainer = $scope.find('.codenit-swiper');
        
        if (!$swiperContainer.length) {
            return;
        }
        
        $swiperContainer.each(function () {
        
            const $el = $(this);
        
            // Prevent duplicate init
            if ($el.hasClass('swiper-initialized')) {
                return;
            }
            
            console.log($el.data('centered_slides'));
            
            const settings = {
                slidesPerView: parseFloat($el.data('desktop')) || 3,
                spaceBetween: parseInt($el.data('space-desktop')) || 0,
                loop: $el.data('loop') === true || $el.data('loop') === 'true',
                centeredSlides: $el.data('centered_slides') === true || $el.data('centered_slides') === 'true',
                watchSlidesProgress: true,
        
                autoplay: $el.data('autoplay') === true || $el.data('autoplay') === 'true'
                    ? {
                        delay: 3000,
                        disableOnInteraction: true,
                    }
                    : false,
        
                pagination: {
                    el: $el.find('.swiper-pagination')[0],
                    clickable: true,
                },
        
                navigation: {
                    nextEl: $el.find('.swiper-button-next')[0],
                    prevEl: $el.find('.swiper-button-prev')[0],
                },
        
                breakpoints: {
                    320: {
                        slidesPerView: parseFloat($el.data('mobile')) || 1,
                        spaceBetween: parseInt($el.data('space-mobile')) || 0,
                    },
                
                    768: {
                        slidesPerView: parseFloat($el.data('tablet')) || 2,
                        spaceBetween: parseInt($el.data('space-tablet')) || 0,
                    },
                
                    1024: {
                        slidesPerView: parseFloat($el.data('desktop')) || 3,
                        spaceBetween: parseInt($el.data('space-desktop')) || 0,
                    }
                }
            };
        
            new Swiper($el[0], settings);
        });
    };
    
    const initWidgetAllReviews = function ($scope) {
        $scope.find('.cdescription-toggle').off('click').on('click', function (e) {
            e.preventDefault();
            const $btn = $(this);
            const $wrap = $btn.closest('.cdescription');
            const $text = $wrap.find('.cdescription-text');
            const $full = $wrap.find('.cdescription-full');
            
            const expanded = $wrap.toggleClass('expanded').hasClass('expanded');
            
            if (expanded) {
                $text.html($full.html());
                $btn.text($btn.data('less'));
            } else {
                // Ensure we wrap the short text in a paragraph if it was originally
                $text.html('<p>' + $text.attr('data-short') + '</p>');
                $btn.text($btn.data('more'));
            }
        });
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/codenit_all_reviews.default',
            initWidgetAllReviews
        );
        
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/codenit_all_reviews_carousel.default',
            initWidgetReviewsCarousel
        );

    });
})(jQuery);