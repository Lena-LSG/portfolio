<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cybersecurity Engineer Portfolio | Lena Gibson</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta Description -->
    <meta name="description" content="Lena Gibson's Portfolio - Cybersecurity Engineer specializing in penetration testing, security architecture, and vulnerability management. Explore projects, skills, and connect with Lena for innovative cybersecurity solutions.">

    <!-- Meta Keywords -->
    <meta name="keywords" content="Cybersecurity Engineer, Penetration Testing, Security Architecture, Vulnerability Management, SIEM, SOAR, Cloud Security, Azure Security, Terraform, Python, Ethical Hacker">

    <!-- Canonical Link -->
    <link rel="canonical" href="https://www.yourdomain.com/">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Lena Gibson - Cybersecurity Engineer Portfolio">
    <meta property="og:description" content="Explore the professional portfolio of Lena Gibson, a passionate Cybersecurity Engineer with expertise in penetration testing, security architecture, and more.">
    <meta property="og:image" content="https://www.yourdomain.com/media/images/og-image.jpg">
    <meta property="og:url" content="https://www.yourdomain.com/">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Lena Gibson - Cybersecurity Engineer Portfolio">
    <meta name="twitter:description" content="Discover the professional portfolio of Lena Gibson, specializing in cybersecurity, penetration testing, and security architecture.">
    <meta name="twitter:image" content="https://www.yourdomain.com/media/images/twitter-card-image.jpg">

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "Lena Gibson",
      "jobTitle": "Cybersecurity Engineer",
      "url": "https://www.yourdomain.com/",
      "sameAs": [
        "https://www.linkedin.com/in/lenagibson/",
        "https://twitter.com/yourtwitterhandle",
        "https://github.com/yourgithubprofile"
      ],
      "image": "https://www.yourdomain.com/media/images/profile.jpg",
      "description": "Passionate Cybersecurity Engineer with expertise in penetration testing, security architecture, and vulnerability management.",
      "alumniOf": {
        "@type": "EducationalOrganization",
        "name": "Your University Name"
      }
    }
    </script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cardo:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <?php include './php/header.php'; ?>

    <!-- About Section -->
    <section id="about">
        <h2>About Me</h2>
        <div class="about-container">
            <div class="profile-image">
                <img src="./media/images/profile.jpg" alt="Lena Gibson - Cybersecurity Engineer">
            </div>
            <div class="about-content">
                <p class="lead">Passionate Cybersecurity Engineer with expertise in penetration testing and security architecture.</p>
                <p>With over 2 years of experience in cybersecurity, I specialize in identifying and mitigating security vulnerabilities across complex systems. My background includes both offensive and defensive security practices, allowing me to approach security challenges from multiple perspectives.</p>
                <div class="certifications">
                    <h3>Certifications</h3>
                    <ul>
                        <li>Certified Information Systems Security Professional (CISSP)</li>
                        <li>Certified Ethical Hacker (CEH)</li>
                        <li>GIAC Security Essentials (GSEC)</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills">
        <h2>Skills</h2>
        <div class="skills-container">
            <!-- Cloud Security & Infrastructure -->
            <div class="skill-category">
                <h3><i class="fas fa-cloud"></i> Cloud Security & Infrastructure</h3>
                <div class="skills-grid">
                    <div class="skill-item">
                        <i class="fab fa-microsoft"></i>
                        <h4>Azure Security</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <i class="fas fa-code-branch"></i>
                        <h4>Infrastructure as Code (Terraform)</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Operations -->
            <div class="skill-category">
                <h3><i class="fas fa-shield-alt"></i> Security Operations</h3>
                <div class="skills-grid">
                    <div class="skill-item">
                        <i class="fas fa-search"></i>
                        <h4>SIEM Implementation</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 90%"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <i class="fas fa-bug"></i>
                        <h4>Vulnerability Management</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <i class="fas fa-shield-virus"></i>
                        <h4>Incident Response</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Automation & Development -->
            <div class="skill-category">
                <h3><i class="fas fa-code"></i> Automation & Development</h3>
                <div class="skills-grid">
                    <div class="skill-item">
                        <i class="fas fa-terminal"></i>
                        <h4>KQL Query Development</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 90%"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <i class="fas fa-robot"></i>
                        <h4>SOAR Implementation</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Tools & Platforms -->
            <div class="skill-category">
                <h3><i class="fas fa-tools"></i> Security Tools & Platforms</h3>
                <div class="skills-grid">
                    <div class="skill-item">
                        <i class="fas fa-chart-line"></i>
                        <h4>Power BI & Azure Workbooks</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <i class="fas fa-network-wired"></i>
                        <h4>Security Integration (Salesforce, Zscaler, Delinea)</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="projects">
        <h2>Professional Achievements</h2>
        <div class="projects-container">
            <?php
                $projects = [
                    [
                        "title" => "SIEM Platform Enhancement",
                        "description" => "Led integration of multiple enterprise security tools into centralized SIEM platform. Improved incident response time by 40% through automated alerting.",
                        "tech" => ["Azure Sentinel", "KQL", "Power BI"],
                        "icon" => "fas fa-shield-alt"
                    ],
                    [
                        "title" => "Security Automation Framework",
                        "description" => "Developed automated security monitoring system using cloud-native tools. Reduced manual intervention in routine security checks by 60%.",
                        "tech" => ["Terraform", "Azure", "PowerShell"],
                        "icon" => "fas fa-robot"
                    ],
                    [
                        "title" => "Vulnerability Management System",
                        "description" => "Implemented enterprise-wide vulnerability scanning and reporting system. Achieved 95% coverage across network infrastructure.",
                        "tech" => ["Azure", "Power BI", "Python"],
                        "icon" => "fas fa-bug"
                    ]
                ];

                foreach ($projects as $project) {
                    echo '<div class="project-card">';
                    echo '<div class="project-icon"><i class="' . $project['icon'] . '"></i></div>';
                    echo '<h3>' . htmlspecialchars($project['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($project['description']) . '</p>';
                    echo '<div class="tech-stack">';
                    foreach ($project['tech'] as $tech) {
                        echo '<span class="tech-badge">' . htmlspecialchars($tech) . '</span>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </section>

    <section id="contact">
        <h2>Contact</h2>
        <div class="contact-container">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-md-5">
                    <div class="contact-info">
                        <h3>Let's Connect</h3>
                        <p class="lead">I'm always interested in discussing cyber security opportunities and innovations.</p>
                        
                        <div class="contact-details">
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:lenalouisegibson@gmail.com">lenalouisegibson@gmail.com</a>
                            </div>
                            <div class="contact-item">
                                <i class="fab fa-linkedin"></i>
                                <a href="https://www.linkedin.com/in/lenagibson/" target="_blank">LinkedIn Profile</a>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>London, United Kingdom</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-md-7">
                    <div class="contact-form">
                        <form id="contactForm" action="php/contact.php" method="POST" aria-labelledby="contactFormLabel">
                            <div class="form-group">
                                <label for="name" id="nameLabel">Name</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="email" id="emailLabel">Email</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="message" id="messageLabel">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" aria-describedby="messageHelp" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" aria-label="Send Message">
                                <i class="fas fa-paper-plane"></i> Send Message
                            </button>
                        </form>
                        <div id="formMessage" class="mt-3" role="alert" aria-live="polite"></div>
                    </div>
                </div>

    <?php include './php/footer.php'; ?>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Scripts -->
    <script src="./js/scripts.js"></script>
</body>
</html>