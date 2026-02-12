/**
 * Product Gallery Script
 * Prometheus4AIX Theme
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Product Gallery Lightbox
        initGalleryLightbox();
        
        // Gallery thumbnail click
        initGalleryThumbnails();
    });

    function initGalleryLightbox() {
        $('.product-gallery__link').on('click', function(e) {
            e.preventDefault();
            
            var $this = $(this);
            var imageUrl = $this.attr('href');
            
            // Create lightbox
            var lightbox = $('<div class="prometheus-lightbox">' +
                '<div class="prometheus-lightbox__overlay"></div>' +
                '<div class="prometheus-lightbox__content">' +
                    '<button class="prometheus-lightbox__close">&times;</button>' +
                    '<img src="' + imageUrl + '" class="prometheus-lightbox__image" />' +
                '</div>' +
            '</div>');
            
            $('body').append(lightbox).addClass('lightbox-open');
            
            // Close lightbox
            lightbox.find('.prometheus-lightbox__overlay, .prometheus-lightbox__close').on('click', function() {
                lightbox.remove();
                $('body').removeClass('lightbox-open');
            });
            
            // Close on escape key
            $(document).on('keyup.lightbox', function(e) {
                if (e.keyCode === 27) {
                    lightbox.remove();
                    $('body').removeClass('lightbox-open');
                    $(document).off('keyup.lightbox');
                }
            });
        });
    }

    function initGalleryThumbnails() {
        var $gallery = $('.product-gallery__grid');
        var $items = $gallery.find('.product-gallery__item');
        var $mainImage = $gallery.find('.product-gallery__item--main img');
        
        $items.not('.product-gallery__item--main').on('click', function(e) {
            if (!$(e.target).closest('a').length) {
                var $this = $(this);
                var newSrc = $this.find('img').attr('src');
                var oldSrc = $mainImage.attr('src');
                
                // Swap images
                $mainImage.attr('src', newSrc);
                $this.find('img').attr('src', oldSrc);
            }
        });
    }

})(jQuery);
