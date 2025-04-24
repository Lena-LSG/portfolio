<?php
// Process contact form if submitted
$form_result = process_contact_form();
?>
<section id="contact" class="py-5 bg-light">
    <div class="container" data-aos="fade-up">
        <h2 class="text-center mb-5 fw-bold position-relative">
            <span class="position-relative">Contact Me
                <span class="position-absolute w-50 h-2 bg-primary" style="bottom: -8px; left: 25%; height: 3px;"></span>
            </span>
        </h2>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if (isset($form_result['success']) && $form_result['success']): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $form_result['message']; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($form_result['success']) && !$form_result['success']): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php 
                        if (isset($form_result['message'])) {
                            echo $form_result['message'];
                        } else {
                            echo 'Please correct the following errors:';
                            echo '<ul class="mb-0 mt-2">';
                            foreach ($form_result['errors'] as $error) {
                                echo '<li>' . $error . '</li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                    </div>
                <?php endif; ?>
                
                <form id="contactForm" method="post" action="#contact" class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" name="submit" class="btn btn-primary px-4">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
