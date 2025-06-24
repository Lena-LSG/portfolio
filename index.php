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
    });    </script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Montserrat:wght@400;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- AOS Animation CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Main Styles -->
    <link rel="stylesheet" href="./css/styles.css?v=<?php echo time(); ?>">
    
    <!-- Dark Mode Toggle -->
    <link rel="stylesheet" href="./css/dark-mode.css?v=<?php echo time(); ?>">    <style>
        :root {
            --trans-blue: #55CDFC;
            --trans-pink: #F7A8B8;
            --trans-white: #FFFFFF;
            --primary-color: #2a2a72;
            --secondary-color: #5e72e4;
            --accent-color: #b8c2cc;
            --dark-bg: #0d1117;
            --dark-bg-secondary: #161b22;
            --light-text: #f0f6fc;
        }

        .trans-gradient-border {
            border-left: 4px solid transparent;
            background-image: linear-gradient(var(--dark-bg), var(--dark-bg)), 
                              linear-gradient(to bottom, var(--trans-blue), var(--trans-white), var(--trans-pink));
            background-origin: border-box;
            background-clip: content-box, border-box;
        }

        /* COMPLETE DARK MODE FIX - Override all white areas */
        body.dark-mode {
            background-color: var(--dark-bg) !important;
            color: var(--light-text) !important;
        }

        .dark-mode section,
        .dark-mode section.bg-light,
        .dark-mode .bg-light,
        .dark-mode .container,
        .dark-mode .container-fluid,
        .dark-mode .row,
        .dark-mode [class*="col-"] {
            background-color: var(--dark-bg-secondary) !important;
            color: var(--light-text) !important;
        }

        .dark-mode h1, .dark-mode h2, .dark-mode h3, .dark-mode h4, .dark-mode h5, .dark-mode h6 {
            color: var(--light-text) !important;
        }

        .dark-mode .skill-card, 
        .dark-mode .project-card {
            background-color: #21262d !important;
            border: 1px solid #30363d !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3) !important;
            border-radius: 12px !important;
            padding: 2rem 1.5rem !important;
        }

        .dark-mode .progress {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        .dark-mode .progress-bar {
            background-color: var(--trans-blue) !important;
        }

        .dark-mode .badge.bg-primary {
            background-color: var(--trans-pink) !important;
            color: var(--dark-bg) !important;
        }

        .dark-mode .text-muted {
            color: #8b949e !important;
        }

        /* Professional spacing and layout */
        .dark-mode section {
            margin-bottom: 3rem !important;
            padding: 3rem 0 !important;
            border-radius: 0 !important;
        }

        .dark-mode .container {
            padding: 2rem !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 32px rgba(0, 0, 0, 0.25) !important;
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
        <div class="container my-5">
            <h2 class="text-center mb-5 fw-bold">Skills</h2>
            <?php foreach ($skills as $category => $skill_data): ?>
            <div class="mb-5">
                <h4 class="mb-4"><?php echo $category; ?> <small class="text-muted">(<?php echo count($skill_data['items']); ?> skills)</small></h4>
                <div class="row g-4">
                    <?php foreach ($skill_data['items'] as $skill): ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="skill-card text-center">
                            <div class="mb-3">
                                <i class="<?php echo $skill['fa_icon']; ?> skill-icon"></i>
                            </div>
                            <h5 class="mb-3"><?php echo $skill['name']; ?></h5>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Proficiency</span>
                                <span class="badge bg-primary"><?php echo $skill['level']; ?>%</span>
                            </div>                            <div class="progress">
                                <div class="progress-bar" style="width: <?php echo $skill['level']; ?>%"></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Key Projects Section -->
    <section id="projects" class="py-5 bg-light">
        <div class="container my-5">
            <h2 class="text-center mb-5 fw-bold">Key Projects</h2>
            <div class="row g-4">
                <?php foreach ($projects as $project): ?>
                <div class="col-md-6">
                    <div class="project-card text-center">
                        <div class="mb-3">
                            <i class="<?php echo $project['icon']; ?> project-icon"></i>
                        </div>
                        <h5 class="mb-3"><?php echo $project['title']; ?></h5>
                        <p class="mb-3"><?php echo $project['description']; ?></p>
                        <div>
                            <?php foreach ($project['technologies'] as $tech): ?>
                            <span class="badge bg-primary me-1 mb-1"><?php echo $tech; ?></span>
                            <?php endforeach; ?>
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