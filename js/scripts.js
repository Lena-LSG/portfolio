// Enhanced Portfolio JavaScript with Modern Features
$(document).ready(function() {
    console.log('✅ Scripts.js loaded');
    
    // Initialize AOS animations with enhanced settings
    AOS.init({
        duration: 1000,
        once: true,
        offset: 120,
        easing: 'ease-out-cubic'
    });
    
    // ROBUST DARK MODE FUNCTIONALITY
    function initializeDarkMode() {
        console.log('🌙 Initializing dark mode...');
        const savedMode = localStorage.getItem('darkMode');
        console.log('💾 Saved dark mode:', savedMode);
        
        if (savedMode === 'enabled') {
            $('body').addClass('dark-mode');
            updateDarkModeIcons(true);
            console.log('🌙 Dark mode enabled from localStorage');
        } else {
            $('body').removeClass('dark-mode');
            updateDarkModeIcons(false);
            console.log('☀️ Light mode enabled');
        }
    }
    
    function updateDarkModeIcons(isDark) {
        const desktopIcon = $('#darkModeToggle').find('i');
        const mobileIcon = $('#darkModeToggleMobile').find('i');
        
        if (isDark) {
            desktopIcon.removeClass('fa-moon').addClass('fa-sun');
            mobileIcon.removeClass('fa-moon').addClass('fa-sun');
        } else {
            desktopIcon.removeClass('fa-sun').addClass('fa-moon');
            mobileIcon.removeClass('fa-sun').addClass('fa-moon');
        }
    }
    
    function toggleDarkMode() {
        console.log('🔄 Toggling dark mode...');
        const $body = $('body');
        const isDark = $body.hasClass('dark-mode');
        
        if (isDark) {
            $body.removeClass('dark-mode');
            localStorage.setItem('darkMode', 'disabled');
            updateDarkModeIcons(false);
            console.log('☀️ Switched to light mode');
        } else {
            $body.addClass('dark-mode');
            localStorage.setItem('darkMode', 'enabled');
            updateDarkModeIcons(true);
            console.log('🌙 Switched to dark mode');
        }
    }
    
    // Initialize dark mode on page load
    initializeDarkMode();
    
    // Dark mode toggle event handler
    $(document).on('click', '#darkModeToggle, #darkModeToggleMobile', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('🔘 Dark mode button clicked:', this.id);
        toggleDarkMode();
    });
    
    // NAVBAR FUNCTIONALITY
    // Enhanced mobile navbar toggle
    $(document).on('click', '[data-bs-toggle="collapse"]', function(e) {
        e.preventDefault();
        const targetSelector = $(this).data('bs-target');
        const target = $(targetSelector);
        
        console.log('📱 Mobile menu toggle clicked, target:', targetSelector);
        
        if (target.hasClass('show')) {
            target.removeClass('show');
            console.log('📱 Mobile menu closed');
        } else {
            target.addClass('show');
            console.log('📱 Mobile menu opened');
        }
    });
    
    // Close mobile menu when clicking nav links
    $('#mobileNav .nav-link').on('click', function() {
        $('#mobileNav').removeClass('show');
        console.log('📱 Mobile menu closed via nav link');
    });
    
    // Enhanced header scroll effect
    let lastScrollTop = 0;
    $(window).scroll(function() {
        const scrollTop = $(this).scrollTop();
        const header = $('header');
        
        if (scrollTop > 50) {
            header.addClass('scrolled');
        } else {
            header.removeClass('scrolled');
        }
        
        lastScrollTop = scrollTop;
    });
    
    // Smooth scrolling for nav links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000);
            console.log('🔗 Smooth scroll to:', this.getAttribute('href'));
        }
    });
    
    // Terminal functionality (if terminal exists)
    if ($('#terminal-command').length) {
        const terminalContent = $('#terminal-content');
        const terminalCommand = $('#terminal-command');
        
        // Focus terminal input when terminal is clicked
        $('.terminal-window').click(function() {
            terminalCommand.focus();
        });
        
        // Process terminal commands
        terminalCommand.keypress(function(e) {
            if (e.which === 13) { // Enter key
                const command = $(this).val();
                
                // Add command to terminal
                terminalContent.append(`<div class="terminal-line"><span class="text-success">lena@security</span>:<span class="text-primary">~</span>$ ${command}</div>`);
                
                // Process command via AJAX
                $.ajax({
                    url: 'php/process_command.php',
                    method: 'POST',
                    data: { command: command },
                    dataType: 'json',
                    success: function(response) {
                        if (response.clear) {
                            terminalContent.html('');
                        } else {
                            // Add command output to terminal
                            $.each(response.output, function(i, line) {
                                terminalContent.append(`<div class="terminal-line">${line}</div>`);
                            });
                        }
                        
                        // Scroll to bottom
                        terminalContent.scrollTop(terminalContent[0].scrollHeight);
                        
                        // Clear command input
                        terminalCommand.val('');
                    },
                    error: function() {
                        terminalContent.append('<div class="terminal-line text-danger">Error: Command failed</div>');
                        terminalCommand.val('');
                    }
                });
            }
        });
    }
      // Enhanced progress bar animations
    $('.progress-bar').each(function() {
        const $this = $(this);
        const percent = $this.data('value') || $this.data('percent');
        if (percent) {
            $this.css('width', '0%');
            setTimeout(() => {
                $this.animate({width: percent + '%'}, 1500);
            }, 500);
        }
    });
    
    // Contact form handling
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        const $form = $(this);
        const $submitBtn = $form.find('button[type="submit"]');
        const originalText = $submitBtn.text();
        
        // Show loading state
        $submitBtn.text('Sending...').prop('disabled', true);
        
        $.ajax({
            url: 'php/contact.php',
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Show success message
                    $form.html('<div class="alert alert-success">Thank you! Your message has been sent successfully.</div>');
                } else {
                    // Show error message
                    $form.prepend('<div class="alert alert-danger">' + (response.error || 'An error occurred. Please try again.') + '</div>');
                    $submitBtn.text(originalText).prop('disabled', false);
                }
            },
            error: function() {
                $form.prepend('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                $submitBtn.text(originalText).prop('disabled', false);
            }
        });
    });
    
    console.log('✅ All scripts initialized successfully');
});
