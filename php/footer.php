<?php
// Get social links from config
global $social_links;
?>
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; <?php echo date('Y'); ?> Lena Gibson. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <?php if (isset($social_links['linkedin'])): ?>
                <a href="<?php echo $social_links['linkedin']; ?>" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
                <?php endif; ?>
                
                <?php if (isset($social_links['github'])): ?>
                <a href="<?php echo $social_links['github']; ?>" class="text-white me-3"><i class="fab fa-github"></i></a>
                <?php endif; ?>
                
                <?php if (isset($social_links['twitter'])): ?>
                <a href="<?php echo $social_links['twitter']; ?>" class="text-white"><i class="fab fa-twitter"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>