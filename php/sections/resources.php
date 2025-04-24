<?php
// Get resources data
$resources = get_resources_data();
?>
<section id="resources" class="py-5">
    <div class="container" data-aos="fade-up">
        <h2 class="text-center mb-5 fw-bold position-relative">
            <span class="position-relative">Security Resources
                <span class="position-absolute w-50 h-2 bg-primary" style="bottom: -8px; left: 25%; height: 3px;"></span>
            </span>
        </h2>
        
        <div class="row g-4">
            <?php foreach ($resources as $category => $items): ?>
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h5 mb-0"><?php echo $category; ?></h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php foreach ($items as $item): ?>
                            <li class="list-group-item px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?php echo $item['url']; ?>" target="_blank" rel="noopener" class="text-decoration-none">
                                        <i class="<?php echo $item['icon']; ?> me-2 text-primary"></i>
                                        <?php echo $item['name']; ?>
                                    </a>
                                    <?php if (!empty($item['badge'])): ?>
                                    <span class="badge bg-secondary"><?php echo $item['badge']; ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($item['description'])): ?>
                                <small class="text-muted d-block mt-1"><?php echo $item['description']; ?></small>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
