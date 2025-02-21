$(document).ready(function() {
    // Tabs functionality
    $('.code-tab-btn').click(function() {
        const tabId = $(this).data('tab');
        
        // Remove active class from all buttons and tabs
        $('.code-tab-btn').removeClass('active');
        $('.code-tab').removeClass('active').hide();
        
        // Add active class to clicked button and show corresponding tab
        $(this).addClass('active');
        $(`#${tabId}-code`).addClass('active').show();
    });

    // Activar la primera pestaña por defecto
    $('.code-tab-btn[data-tab="php"]').click();

    // Smooth scroll
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $($(this).attr('href'));
        
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 500);
        }
    });

    // Scroll animations
    $(window).scroll(function() {
        $('.feature-card, .pricing-card').each(function() {
            const elementTop = $(this).offset().top;
            const viewportTop = $(window).scrollTop();
            const windowHeight = $(window).height();

            if (elementTop < (viewportTop + windowHeight - 100)) {
                $(this).addClass('fade-in');
            }
        });
    });

    // Active nav link
    $(window).scroll(function() {
        const scrollPosition = $(window).scrollTop();
        const navHeight = $('.border-b').outerHeight();
        
        if (scrollPosition > navHeight) {
            $('.nav-link').addClass('text-blue-300');
        } else {
            $('.nav-link').removeClass('text-blue-300');
        }
    });
}); 