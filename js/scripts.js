$(document).ready(function() {
    // Smooth scrolling with easing effect
    $('a.nav-link').on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 1000, 'easeInOutExpo');
        }
    });

    var nav = $('#nav');
    var overlay = $('#overlay');

    function toggleSidebar() {
        nav.toggleClass('open');
        overlay.toggleClass('open');
        $('body').toggleClass('sidebar-open');
    }

    $('#hamburger').on('click', toggleSidebar);
    overlay.on('click', toggleSidebar);

    // Close the menu when a link is clicked
    $('.nav.sidebar ul li a').on('click', function() {
        if (nav.hasClass('open')) {
            toggleSidebar();
        }
    });


    // Animate progress bars when they come into view
    function animateProgressBars() {
        $('.progress-bar').each(function() {
            var bar = $(this);
            var width = bar.css('width');
            bar.width(0).animate({width: width}, 1000);
        });
    }

    // Trigger animation when skills section enters viewport
    var skillsSection = $('#skills');
    $(window).scroll(function() {
        var top_of_element = skillsSection.offset().top;
        var bottom_of_element = skillsSection.offset().top + skillsSection.outerHeight();
        var bottom_of_screen = $(window).scrollTop() + $(window).height();
        var top_of_screen = $(window).scrollTop();

        if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)){
            animateProgressBars();
        }
    });

    // Contact Form AJAX Submission
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var $formMessage = $('#formMessage');
        
        $submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sending...');
        
        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function(response) {
                $formMessage.removeClass('alert-danger').addClass('alert alert-success')
                    .html('Message sent successfully!');
                $form[0].reset();
            },
            error: function(xhr, status, error) {
                $formMessage.removeClass('alert-success').addClass('alert alert-danger')
                    .html('Error sending message. Please try again.');
            },
            complete: function() {
                $submitBtn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> Send Message');
            }
        });
    });
});