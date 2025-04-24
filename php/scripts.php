<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation Library -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true
    });
    
    // Dark mode toggle
    $(document).ready(function() {
        // Check for saved preference
        if (localStorage.getItem('darkMode') === 'enabled') {
            $('body').addClass('dark-mode');
            $('#darkModeToggle i').removeClass('fa-moon').addClass('fa-sun');
        }
        
        // Toggle dark mode
        $('#darkModeToggle').click(function() {
            $('body').toggleClass('dark-mode');
            if ($('body').hasClass('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                $('#darkModeToggle i').removeClass('fa-moon').addClass('fa-sun');
            } else {
                localStorage.setItem('darkMode', null);
                $('#darkModeToggle i').removeClass('fa-sun').addClass('fa-moon');
            }
        });
        
        // Fix for mobile menu
        $('.navbar-toggler').click(function() {
            $('#mobileNav').toggleClass('show');
        });
        
        // Close mobile menu when clicking a nav item
        $('#mobileNav .nav-link').click(function() {
            $('#mobileNav').removeClass('show');
        });
    });
</script>
