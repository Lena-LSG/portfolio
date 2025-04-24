<?php
/**
 * Common functions for the portfolio site
 */

/**
 * Get body classes based on current page and mode
 */
function get_body_classes() {
    $classes = ['bg-light'];
    
    // Check for dark mode cookie
    if (isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled') {
        $classes[] = 'dark-mode';
    }
    
    return implode(' ', $classes);
}

/**
 * Load skills data
 */
function get_skills_data() {
    return [
        'Cloud Security' => [
            'icon' => 'fas fa-cloud-shield-alt',
            'items' => [
                [
                    'name' => 'Azure Security Center',
                    'fa_icon' => 'fab fa-microsoft',
                    'level' => 95
                ],
                [
                    'name' => 'AWS Security',
                    'fa_icon' => 'fab fa-aws',
                    'level' => 85
                ],
                [
                    'name' => 'GCP Security',
                    'fa_icon' => 'fab fa-google',
                    'level' => 80
                ],
                [
                    'name' => 'Cloud Compliance',
                    'fa_icon' => 'fas fa-check-square',
                    'level' => 90
                ]
            ]
        ],
        'Threat Detection' => [
            'icon' => 'fas fa-shield-alt',
            'items' => [
                [
                    'name' => 'SIEM Tools',
                    'fa_icon' => 'fas fa-chart-line',
                    'level' => 90
                ],
                [
                    'name' => 'Threat Hunting',
                    'fa_icon' => 'fas fa-search',
                    'level' => 85
                ],
                [
                    'name' => 'Malware Analysis',
                    'fa_icon' => 'fas fa-bug',
                    'level' => 80
                ],
                [
                    'name' => 'Intrusion Detection',
                    'fa_icon' => 'fas fa-radar',
                    'level' => 90
                ]
            ]
        ],
        // Add more skill categories as needed
    ];
}

/**
 * Load projects data
 */
function get_projects_data() {
    return [
        [
            'title' => 'Enterprise SIEM Platform',
            'icon' => 'fas fa-search',
            'description' => 'Led the design and implementation of a scalable SIEM platform using Azure Sentinel for a regulatory organization. This solution centralized security monitoring across multiple environments and improved threat detection capabilities.',
            'technologies' => ['Azure Sentinel', 'KQL', 'Log Analytics', 'Security Automation']
        ],
        [
            'title' => 'Secure DevOps Pipeline',
            'icon' => 'fas fa-code-branch',
            'description' => 'Developed a comprehensive DevOps pipeline with integrated security controls for Azure infrastructure deployments. This included implementing infrastructure as code practices, automated security testing, and continuous compliance monitoring.',
            'technologies' => ['Azure DevOps', 'IaC', 'Policy as Code', 'Compliance Automation']
        ]
    ];
}

/**
 * Load certifications data
 */
function get_certifications_data() {
    return [
        [
            'name' => 'SC-200',
            'full_name' => 'Microsoft Security Operations Analyst',
            'icon' => 'fab fa-microsoft'
        ],
        [
            'name' => 'CISMP',
            'full_name' => 'Certificate in Information Security Management Principles',
            'icon' => 'fas fa-shield-alt'
        ],
        [
            'name' => 'Agile',
            'full_name' => 'Agile Fundamentals Certification',
            'icon' => 'fas fa-project-diagram'
        ]
    ];
}

/**
 * Process contact form submission
 */
function process_contact_form() {
    if (!isset($_POST['submit'])) return false;
    
    // Validate form inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    $errors = [];
    
    if (empty($name)) $errors[] = 'Name is required';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
    if (empty($message)) $errors[] = 'Message is required';
    
    if (empty($errors)) {
        // Send email
        $subject = EMAIL_SUBJECT_PREFIX . 'Message from ' . $name;
        $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";
        
        if (mail(CONTACT_EMAIL, $subject, $email_body, $headers)) {
            return [
                'success' => true,
                'message' => 'Your message has been sent successfully!'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to send message. Please try again later.'
            ];
        }
    }
    
    return [
        'success' => false,
        'errors' => $errors
    ];
}

/**
 * Get blog posts data
 * 
 * @param int $limit Number of posts to return
 * @return array Array of blog posts
 */
function get_blog_posts($limit = 0) {
    $posts = [
        [
            'id' => 1,
            'title' => 'Securing Azure Infrastructure with Defense in Depth',
            'excerpt' => 'Explore how to implement a comprehensive defense in depth strategy for your Azure cloud resources...',
            'content' => 'Full post content here...',
            'date' => '2023-05-15',
            'category' => 'Azure Security',
            'image' => './media/images/blog/azure-security.jpg'
        ],
        [
            'id' => 2,
            'title' => 'Advanced KQL for Security Analysts',
            'excerpt' => 'Discover advanced KQL techniques to improve your threat hunting capabilities in Azure Sentinel...',
            'content' => 'Full post content here...',
            'date' => '2023-06-22',
            'category' => 'SIEM',
            'image' => './media/images/blog/kql-analytics.jpg'
        ],
        [
            'id' => 3,
            'title' => 'Automating Security with Azure Logic Apps',
            'excerpt' => 'Learn how to build powerful security automation workflows using Azure Logic Apps and Microsoft Sentinel...',
            'content' => 'Full post content here...',
            'date' => '2023-07-10',
            'category' => 'Automation',
            'image' => './media/images/blog/security-automation.jpg'
        ]
    ];
    
    if ($limit > 0) {
        return array_slice($posts, 0, $limit);
    }
    
    return $posts;
}

/**
 * Get security resources data
 * 
 * @return array Array of security resources by category
 */
function get_resources_data() {
    return [
        'Microsoft Security' => [
            [
                'name' => 'Microsoft Security Blog',
                'url' => 'https://www.microsoft.com/security/blog/',
                'icon' => 'fab fa-microsoft',
                'description' => 'Official security blog with latest updates and insights'
            ],
            [
                'name' => 'Azure Security Documentation',
                'url' => 'https://docs.microsoft.com/en-us/azure/security/',
                'icon' => 'fas fa-cloud',
                'description' => 'Comprehensive documentation for Azure security'
            ],
            [
                'name' => 'Microsoft Security Community',
                'url' => 'https://techcommunity.microsoft.com/t5/security-compliance-and-identity/ct-p/SecurityComplianceandIdentity',
                'icon' => 'fas fa-users',
                'description' => 'Community forums and discussions on Microsoft security'
            ]
        ],
        'Security Tools' => [
            [
                'name' => 'OWASP Top 10',
                'url' => 'https://owasp.org/www-project-top-ten/',
                'icon' => 'fas fa-list-ol',
                'description' => 'Top 10 web application security risks'
            ],
            [
                'name' => 'Have I Been Pwned',
                'url' => 'https://haveibeenpwned.com/',
                'icon' => 'fas fa-user-shield',
                'description' => 'Check if your accounts have been compromised'
            ],
            [
                'name' => 'VirusTotal',
                'url' => 'https://www.virustotal.com/',
                'icon' => 'fas fa-virus',
                'description' => 'Analyze suspicious files and URLs'
            ]
        ],
        'Learning Resources' => [
            [
                'name' => 'Microsoft Learn - Security',
                'url' => 'https://docs.microsoft.com/en-us/learn/paths/security-fundamentals/',
                'icon' => 'fas fa-graduation-cap',
                'description' => 'Free learning paths for security professionals'
            ],
            [
                'name' => 'MITRE ATT&CK Framework',
                'url' => 'https://attack.mitre.org/',
                'icon' => 'fas fa-sitemap',
                'description' => 'Knowledge base of adversary tactics and techniques'
            ],
            [
                'name' => 'Azure Sentinel Ninja Training',
                'url' => 'https://techcommunity.microsoft.com/t5/azure-sentinel/become-an-azure-sentinel-ninja-the-complete-level-400-training/ba-p/1246310',
                'icon' => 'fas fa-user-ninja',
                'badge' => 'Recommended',
                'description' => 'Comprehensive training for Azure Sentinel'
            ]
        ]
    ];
}

/**
 * Process terminal commands
 * 
 * @param string $command User entered command
 * @return array Command response data
 */
function process_terminal_command($command) {
    $command = strtolower(trim($command));
    
    switch ($command) {
        case 'help':
            return [
                'success' => true,
                'output' => [
                    "Available commands:",
                    "  help       - Display this help message",
                    "  about      - Display information about me",
                    "  skills     - List my technical skills",
                    "  projects   - Show my key projects",
                    "  contact    - Display contact information",
                    "  clear      - Clear the terminal screen"
                ]
            ];
            
        case 'about':
            return [
                'success' => true,
                'output' => [
                    "Lena Gibson",
                    "---------------------",
                    "Cyber Security Infrastructure Specialist at Microsoft Incident Response",
                    "Specializing in Azure security, SIEM implementation, and incident response.",
                    "",
                    "Experience:",
                    "- Microsoft Incident Response - Security Infrastructure Specialist",
                    "- Previous: 2.5 years as security engineer at a regulatory organization"
                ]
            ];
            
        case 'skills':
            return [
                'success' => true,
                'output' => [
                    "Technical Skills:",
                    "---------------------",
                    "• Azure Security (95%)",
                    "• Azure Sentinel (90%)",
                    "• Microsoft Defender (92%)",
                    "• Entra ID Security (88%)",
                    "• Azure DevOps (90%)",
                    "• Infrastructure as Code (85%)",
                    "• Microsoft Purview (75%)",
                    "• KQL & Security Analytics (88%)"
                ]
            ];
            
        // Add more command handlers here
            
        case 'clear':
            return [
                'success' => true,
                'clear' => true
            ];
            
        default:
            if (empty($command)) {
                return [
                    'success' => true,
                    'output' => []
                ];
            }
            
            return [
                'success' => false,
                'output' => ["Command not found: {$command}", "Type 'help' for available commands."]
            ];
    }
}

// Debug function to check data structure
function debug_data_structure() {
    echo '<pre class="bg-dark text-white p-3 mt-3 mb-3">';
    echo "Skills data structure:\n";
    print_r(get_skills_data());
    echo "\nProjects data structure:\n";
    print_r(get_projects_data());
    echo '</pre>';
}

// Add this temporarily to the main page to see the data structure
