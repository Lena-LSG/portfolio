<?php
// Get certification data
$certifications = isset($certifications) ? $certifications : get_certifications_data();
?>
<section id="about" class="py-5">
    <div class="container" data-aos="fade-up">
        <h2 class="text-center mb-5 fw-bold position-relative">About Me</h2>
        <div class="row about-container g-4 align-items-center">
            <div class="col-lg-4 profile-image text-center" data-aos="fade-right" data-aos-delay="200">
                <div class="position-relative d-inline-block">
                    <img src="./media/images/profile.jpg" alt="Lena Gibson - Cybersecurity Engineer" class="img-fluid rounded-circle shadow-lg" style="max-width: 280px;">
                    <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 shadow">
                        <i class="fas fa-shield-alt text-white fs-4"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 about-content ps-4 py-3" data-aos="fade-left" data-aos-delay="300">
                <h3 class="mb-3 text-primary">Lena Gibson</h3>
                <p class="lead fw-bold mb-4">Cyber Security Infrastructure Specialist with Microsoft Incident Response</p>
                <p class="mb-4">As a Cyber Security Infrastructure Specialist at Microsoft Incident Response, I work with advanced security tools to analyze and respond to security incidents across Microsoft's global platforms. Prior to joining Microsoft, I spent 2.5 years as a security engineer at a regulatory organization where I focused on implementing and scaling Microsoft security solutions including Sentinel, Defender, Entra ID, and Azure Security. My expertise includes SIEM implementation, cloud security architecture, DevOps security integration, and developing automated security response frameworks.</p>
                
                <div class="certifications mt-4">
                    <h3 class="h5 fw-bold"><i class="fas fa-award me-2 text-primary"></i>Certifications</h3>
                    <div class="row mt-3">
                        <?php foreach ($certifications as $cert): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="certification-icon mb-3">
                                        <i class="<?php echo $cert['icon']; ?> fa-2x text-primary"></i>
                                    </div>
                                    <h4 class="h6 fw-bold"><?php echo $cert['name']; ?></h4>
                                    <small><?php echo $cert['full_name']; ?></small>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
