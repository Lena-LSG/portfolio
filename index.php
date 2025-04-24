<?php
// Initialize configuration and common functions
require_once './php/config.php';
require_once './php/functions.php';

// Page-specific variables
$page_title = "Cyber Security Infrastructure Specialist | Lena Gibson";
$meta_description = "Lena Gibson's Portfolio - Cyber Security Infrastructure Specialist with Microsoft Incident Response, specializing in threat detection, incident management, and cloud security architecture.";
$is_home_page = true;

// Load dynamic content
$skills = get_skills_data();
$projects = get_projects_data();
$certifications = get_certifications_data();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Security Headers -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' https://cdn.jsdelivr.net https://code.jquery.com https://cdnjs.cloudflare.com 'unsafe-inline'; style-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.googleapis.com 'unsafe-inline'; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; img-src 'self' data: https:; connect-src 'self';">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="Permissions-Policy" content="camera=(), microphone=(), geolocation=()">
    
    <!-- Meta Description -->
    <meta name="description" content="<?php echo $meta_description; ?>">

    <!-- Meta Keywords -->
    <meta name="keywords" content="Cyber Security Infrastructure Specialist, Microsoft Incident Response, Azure Security, Cloud Security, Threat Detection, Incident Management, Security Architecture, SIEM, SOAR, Azure Sentinel, Defender for Cloud">

    <!-- Canonical Link -->
    <link rel="canonical" href="https://www.yourdomain.com/">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Lena Gibson - Cyber Security Infrastructure Specialist">
    <meta property="og:description" content="Explore the professional portfolio of Lena Gibson, a Cyber Security Infrastructure Specialist with Microsoft Incident Response specializing in threat detection, incident management, and cloud security architecture.">
    <meta property="og:image" content="https://www.yourdomain.com/media/images/og-image.jpg">
    <meta property="og:url" content="https://www.yourdomain.com/">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Lena Gibson - Cyber Security Infrastructure Specialist">
    <meta name="twitter:description" content="Discover the professional portfolio of Lena Gibson, a Cyber Security Infrastructure Specialist with Microsoft Incident Response.">
    <meta name="twitter:image" content="https://www.yourdomain.com/media/images/twitter-card-image.jpg">

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "Lena Gibson",
      "jobTitle": "Cyber Security Infrastructure Specialist",
      "worksFor": {
        "@type": "Organization",
        "name": "Microsoft Incident Response"
      },
      "url": "https://www.yourdomain.com/",
      "sameAs": [
        "https://www.linkedin.com/in/lenagibson/"
      ],
      "image": "https://www.yourdomain.com/media/images/profile.jpg",
      "description": "Cyber Security Infrastructure Specialist with Microsoft Incident Response, focusing on Azure security, threat detection, and cloud infrastructure security architecture.",
      "alumniOf": {
        "@type": "EducationalOrganization",
        "name": "Your University Name"
      }
    }
    </script>

    <!-- Updated Bootstrap to latest version -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Fallback for Font Awesome -->
    <script>
    // Function to check if Font Awesome loaded properly
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            // Test if Font Awesome is working
            var testIcon = document.createElement('i');
            testIcon.className = 'fas fa-user';
            testIcon.style.visibility = 'hidden';
            document.body.appendChild(testIcon);
            
            var styles = window.getComputedStyle(testIcon);
            if (styles.width === '0px') {
                console.warn('Font Awesome failed to load. Loading fallback...');
                // Try loading from another CDN
                var link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = 'https://use.fontawesome.com/releases/v6.5.1/css/all.css';
                document.head.appendChild(link);
            }
            document.body.removeChild(testIcon);
        }, 500);
    });
    </script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Montserrat:wght@400;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Dark Mode Toggle -->
    <link rel="stylesheet" href="./css/dark-mode.css">
    <style>
        :root {
            --trans-blue: #55CDFC;
            --trans-pink: #F7A8B8;
            --trans-white: #FFFFFF;
            --primary-color: #2a2a72;
            --secondary-color: #5e72e4;
            --accent-color: #b8c2cc;
            --dark-bg: #1a1a2e;
            --light-text: #f8f9fa;
        }

        .trans-gradient-border {
            border-left: 4px solid transparent;
            background-image: linear-gradient(var(--dark-bg), var(--dark-bg)), 
                              linear-gradient(to bottom, var(--trans-blue), var(--trans-white), var(--trans-pink));
            background-origin: border-box;
            background-clip: content-box, border-box;
        }
    </style>
</head>

<body class="<?php echo get_body_classes(); ?>">
    <?php include './php/header.php'; ?>

    <!-- Security Tip Widget -->
    <div class="container mt-3">
        <?php include './php/sections/security_tip.php'; ?>
    </div>

    <!-- About Section -->
    <?php include './php/sections/about.php'; ?>

    <!-- Terminal Section -->
    <?php include './php/sections/terminal.php'; ?>    

    <!-- Skills Section -->
    <section id="skills" class="py-5 bg-light">
        <div class="container" data-aos="fade-up">
            <h2 class="text-center mb-5 fw-bold position-relative">
                <span class="position-relative">Skills
                    <span class="position-absolute w-50 h-2 bg-primary" style="bottom: -8px; left: 25%; height: 3px;"></span>
                </span>
            </h2>
            <div class="skills-container">
                <?php foreach ($skills as $category => $skill_data): ?>
                <div class="skill-category mb-5" data-aos="fade-up">
                    <h3 class="d-flex align-items-center mb-4">
                        <span class="skill-icon-container me-3 rounded-circle bg-primary p-2">
                            <i class="<?php echo !empty($skill_data['icon']) ? $skill_data['icon'] : 'fas fa-laptop-code'; ?> text-white"></i>
                        </span>
                        <?php echo $category; ?>
                    </h3>
                    
                    <div class="row g-4">
                        <?php foreach ($skill_data['items'] as $skill): ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="skill-card p-3 border rounded shadow-sm">
                                <div class="fa-icon-container mb-3">
                                    <?php 
                                    // Simplified icon selection with direct fallback, 
                                    $cybersecurity_icons = [
                                        'Azure' => 'fa-brands fa-microsoft',
                                        'AWS' => 'fa-brands fa-aws',
                                        'GCP' => 'fa-brands fa-google',
                                        'Google' => 'fa-brands fa-google',
                                        'Cloud' => 'fa-solid fa-cloud',
                                        'Security' => 'fa-solid fa-shield-halved',
                                        'Compliance' => 'fa-solid fa-check-circle',
                                        'Python' => 'fa-brands fa-python',
                                        'Java' => 'fa-brands fa-java',
                                        'PHP' => 'fa-brands fa-php',
                                        'Network' => 'fa-solid fa-network-wired',
                                        'Encryption' => 'fa-solid fa-lock',
                                        'Firewall' => 'fa-solid fa-fire',
                                        'Monitoring' => 'fa-solid fa-chart-line',
                                        'Threat' => 'fa-solid fa-virus',
                                        'Analysis' => 'fa-solid fa-magnifying-glass-chart',
                                        'DevOps' => 'fa-solid fa-gears',
                                        'Docker' => 'fa-brands fa-docker',
                                        'Linux' => 'fa-brands fa-linux',
                                        'Windows' => 'fa-brands fa-windows',
                                        'Kubernetes' => 'fa-solid fa-dharmachakra'
                                    ]; 
                                    
                                    // Default icon
                                    $icon = 'fa-solid fa-code';
                                    // Try to find a matching icon
                                    foreach ($cybersecurity_icons as $key => $value) {
                                        if (stripos($skill['name'], $key) !== false) {
                                            $icon = $value;
                                            break;
                                        }
                                    }
                                    // Use provided icon if available
                                    if (isset($skill['fa_icon']) && !empty($skill['fa_icon'])) {
                                        $icon = $skill['fa_icon'];
                                    }
                                    ?>
                                    <i class="<?php echo $icon; ?> skill-icon"></i>
                                </div>
                                <h4 class="h6 text-center"><?php echo $skill['name']; ?></h4>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar skill-progress" data-value="<?php echo isset($skill['level']) ? $skill['level'] : 0; ?>" style="width: <?php echo isset($skill['level']) ? $skill['level'] : 0; ?>%"></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-5">
        <div class="container" data-aos="fade-up">
            <h2 class="text-center mb-5 fw-bold position-relative">
                <span class="position-relative">Key Projects
                    <span class="position-absolute w-50 h-2 bg-primary" style="bottom: -8px; left: 25%; height: 3px;"></span>
                </span>
            </h2>
            <div class="row g-4">
                <?php foreach ($projects as $index => $project): ?>
                <div class="col-lg-6 mb-4" data-aos="fade-up" <?php echo ($index > 0) ? 'data-aos-delay="' . $index*100 . '"' : ''; ?>>
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="project-icon me-3 rounded-circle bg-primary p-2">
                                    <?php 
                                    // Ensure project icon is valid or use default
                                    $project_icon = !empty($project['icon']) ? $project['icon'] : 'fa-solid fa-diagram-project';
                                    ?>
                                    <i class="<?php echo $project_icon; ?> text-white"></i>
                                </div>
                                <h3 class="h5 mb-0"><?php echo $project['title']; ?></h3>
                            </div>
                            <p><?php echo $project['description']; ?></p>
                            <div class="mt-3">
                                <?php foreach ($project['technologies'] as $tech): ?>
                                <span class="badge bg-primary me-2 mb-2"><?php echo $tech; ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Blog Section -->
    <?php include './php/sections/blog.php'; ?>
    
    <!-- Resources Section -->
    <?php include './php/sections/resources.php'; ?>
    
    <!-- Contact Section -->
    <?php include './php/sections/contact.php'; ?>
    
    <!-- Footer -->
    <?php include './php/footer.php'; ?>

    <!-- Scripts -->
    <?php include './php/scripts.php'; ?>
</body>
</html>