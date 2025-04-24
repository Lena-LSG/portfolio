<?php
// Get blog posts data
$posts = get_blog_posts(3); // Get latest 3 posts
?>
<section id="blog" class="py-5 bg-light">
    <div class="container" data-aos="fade-up">
        <h2 class="text-center mb-5 fw-bold position-relative">
            <span class="position-relative">Security Insights
                <span class="position-absolute w-50 h-2 bg-primary" style="bottom: -8px; left: 25%; height: 3px;"></span>
            </span>
        </h2>
        
        <div class="row g-4">
            <?php foreach ($posts as $post): ?>
            <div class="col-lg-4 mb-4" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm">
                    <?php if (!empty($post['image'])): ?>
                    <img src="<?php echo $post['image']; ?>" class="card-img-top" alt="<?php echo $post['title']; ?>">
                    <?php endif; ?>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary"><?php echo $post['category']; ?></span>
                            <small class="text-muted"><?php echo date('M d, Y', strtotime($post['date'])); ?></small>
                        </div>
                        <h3 class="h5"><?php echo $post['title']; ?></h3>
                        <p class="card-text"><?php echo $post['excerpt']; ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-0 p-4 pt-0">
                        <a href="blog.php?id=<?php echo $post['id']; ?>" class="btn btn-outline-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="blog.php" class="btn btn-primary">View All Posts</a>
        </div>
    </div>
</section>
