<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation Library -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<!-- Custom Scripts -->
<script src="./js/scripts.js?v=<?php echo time(); ?>"></script>

<!-- CLEAN SCRIPTS - Dark mode handled in scripts.js -->
<script>
    console.log('=== PORTFOLIO SCRIPTS LOADING ===');
    
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true
    });
    
    // Wait for DOM to be ready
    $(document).ready(function() {
        console.log('jQuery ready - scripts.php');
        
        // Bootstrap navbar toggle support
        $('[data-bs-toggle="collapse"]').on('click', function() {
            const target = $(this).data('bs-target');
            $(target).toggleClass('show');
            console.log('Mobile menu toggled');
        });
        
        // Close mobile menu when clicking nav links
        $('#mobileNav .nav-link').on('click', function() {
            $('#mobileNav').removeClass('show');
        });
          // Smooth scrolling for nav links
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            const target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
            }
        });
        
        // Animate progress bars
        $('.progress-bar').each(function(index) {
            const $this = $(this);
            const percent = $this.data('value');
            if (percent) {
                setTimeout(() => {
                    $this.css('width', percent + '%');
                    console.log('Animating progress bar to:', percent + '%');
                }, 500 + (index * 100));
            }
        });
        
        console.log('Scripts initialized');
    });
</script>
