// Document Ready Function
$(document).ready(function() {
    // Initialize AOS animations
    AOS.init({
        duration: 1000,
        once: true,
        disable: 'mobile'
    });
    
    // Check for saved dark mode preference
    if (localStorage.getItem('darkMode') === 'enabled') {
        $('body').addClass('dark-mode');
        $('#darkModeToggle').prop('checked', true);
    }
    
    // Dark Mode Toggle
    $('.dark-mode-toggle, #darkModeToggle').click(function() {
        $('body').toggleClass('dark-mode');
        
        if ($('body').hasClass('dark-mode')) {
            localStorage.setItem('darkMode', 'enabled');
        } else {
            localStorage.setItem('darkMode', null);
        }
    });
    
    // Terminal functionality
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
                        
                        // Add new prompt
                        terminalContent.append(`<div class="terminal-line"><span class="text-success">lena@security</span>:<span class="text-primary">~</span>$ <span id="terminal-cursor">_</span></div>`);
                        
                        // Scroll to bottom of terminal
                        terminalContent.scrollTop(terminalContent[0].scrollHeight);
                    }
                });
                
                // Clear input
                $(this).val('');
            }
        });
        
        // Blinking cursor effect
        setInterval(function() {
            $('#terminal-cursor').toggleClass('invisible');
        }, 500);
    }
    
    // Security tip rotation
    setInterval(function() {
        $.ajax({
            url: 'php/get_security_tip.php',
            success: function(tip) {
                $('#securityTip').fadeOut(500, function() {
                    $(this).html(tip).fadeIn(500);
                });
            }
        });
    }, 30000); // Change every 30 seconds
});