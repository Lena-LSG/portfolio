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
                ],
                [
                    'name' => 'Azure Sentinel',
                    'fa_icon' => 'fas fa-shield-alt',
                    'level' => 92
                ],
                [
                    'name' => 'Microsoft Defender',
                    'fa_icon' => 'fas fa-shield-virus',
                    'level' => 88
                ],
                [
                    'name' => 'Azure Key Vault',
                    'fa_icon' => 'fas fa-key',
                    'level' => 85
                ],
                [
                    'name' => 'Identity Management',
                    'fa_icon' => 'fas fa-user-shield',
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
                ],
                [
                    'name' => 'KQL Queries',
                    'fa_icon' => 'fas fa-terminal',
                    'level' => 92
                ],
                [
                    'name' => 'Log Analytics',
                    'fa_icon' => 'fas fa-chart-bar',
                    'level' => 88
                ],
                [
                    'name' => 'Security Automation',
                    'fa_icon' => 'fas fa-robot',
                    'level' => 85
                ],
                [
                    'name' => 'Incident Response',
                    'fa_icon' => 'fas fa-exclamation-triangle',
                    'level' => 93
                ]
            ]
        ],
        'Programming & Scripting' => [
            'icon' => 'fas fa-code',
            'items' => [
                [
                    'name' => 'PowerShell',
                    'fa_icon' => 'fas fa-terminal',
                    'level' => 90
                ],
                [
                    'name' => 'Python',
                    'fa_icon' => 'fab fa-python',
                    'level' => 85
                ],
                [
                    'name' => 'ARM Templates',
                    'fa_icon' => 'fas fa-file-code',
                    'level' => 88
                ],
                [
                    'name' => 'Bicep',
                    'fa_icon' => 'fas fa-code-branch',
                    'level' => 82
                ],
                [
                    'name' => 'REST APIs',
                    'fa_icon' => 'fas fa-plug',
                    'level' => 87
                ],
                [
                    'name' => 'Azure CLI',
                    'fa_icon' => 'fas fa-command',
                    'level' => 90
                ],
                [
                    'name' => 'Graph API',
                    'fa_icon' => 'fas fa-project-diagram',
                    'level' => 83
                ],
                [
                    'name' => 'Logic Apps',
                    'fa_icon' => 'fas fa-sitemap',
                    'level' => 85
                ]
            ]
        ],
        'Infrastructure & DevOps' => [
            'icon' => 'fas fa-server',
            'items' => [
                [
                    'name' => 'Azure DevOps',
                    'fa_icon' => 'fab fa-microsoft',
                    'level' => 88
                ],
                [
                    'name' => 'Infrastructure as Code',
                    'fa_icon' => 'fas fa-code',
                    'level' => 85
                ],
                [
                    'name' => 'CI/CD Pipelines',
                    'fa_icon' => 'fas fa-code-branch',
                    'level' => 82
                ],
                [
                    'name' => 'Container Security',
                    'fa_icon' => 'fab fa-docker',
                    'level' => 80
                ],
                [
                    'name' => 'Kubernetes Security',
                    'fa_icon' => 'fas fa-dharmachakra',
                    'level' => 78
                ],
                [
                    'name' => 'Network Security',
                    'fa_icon' => 'fas fa-network-wired',
                    'level' => 87
                ],
                [
                    'name' => 'Policy as Code',
                    'fa_icon' => 'fas fa-balance-scale',
                    'level' => 85
                ],
                [
                    'name' => 'Monitoring & Alerting',
                    'fa_icon' => 'fas fa-bell',
                    'level' => 90
                ]
            ]
        ]
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
            'description' => 'Led the design and implementation of a scalable SIEM platform using Azure Sentinel for a multinational corporation. This solution centralized security monitoring across 50+ environments, improved threat detection by 300%, and reduced incident response time by 60%. Integrated with existing tools including Splunk, QRadar, and custom APIs.',
            'technologies' => ['Azure Sentinel', 'KQL', 'Log Analytics', 'Security Automation', 'PowerBI', 'Logic Apps']
        ],
        [
            'title' => 'Secure DevOps Pipeline',
            'icon' => 'fas fa-code-branch',
            'description' => 'Developed a comprehensive DevSecOps pipeline with integrated security controls for Azure infrastructure deployments. This included implementing infrastructure as code practices, automated security testing, and continuous compliance monitoring. Resulted in 90% reduction in security vulnerabilities in production.',
            'technologies' => ['Azure DevOps', 'Infrastructure as Code', 'Policy as Code', 'Compliance Automation', 'ARM Templates', 'Bicep']
        ],
        [
            'title' => 'Zero Trust Architecture Implementation',
            'icon' => 'fas fa-shield-alt',
            'description' => 'Architected and implemented a comprehensive Zero Trust security model for a financial services organization. This project involved redesigning identity management, network segmentation, and access controls. Achieved 99.9% reduction in lateral movement attacks and improved compliance scores by 85%.',
            'technologies' => ['Azure AD', 'Conditional Access', 'Privileged Identity Management', 'Network Security Groups', 'Application Gateway', 'Key Vault']
        ],
        [
            'title' => 'Automated Threat Hunting Platform',
            'icon' => 'fas fa-robot',
            'description' => 'Created an AI-powered threat hunting platform that automatically identifies and investigates security anomalies across cloud and on-premises environments. The system processes over 1TB of log data daily and has identified 200+ previously unknown threats. Features custom ML models and automated response capabilities.',
            'technologies' => ['Azure Machine Learning', 'Python', 'KQL', 'Logic Apps', 'Power Automate', 'Custom APIs', 'Jupyter Notebooks']
        ],
        [
            'title' => 'Cloud Security Assessment Framework',
            'icon' => 'fas fa-clipboard-check',
            'description' => 'Developed a comprehensive security assessment framework for cloud environments that automatically evaluates security posture across Azure, AWS, and GCP. The framework includes 500+ security controls, automated remediation scripts, and detailed compliance reporting. Used by security teams across 15+ organizations.',
            'technologies' => ['Azure Policy', 'AWS Config', 'GCP Security Command Center', 'PowerShell', 'Python', 'Terraform', 'ARM Templates']
        ],
        [
            'title' => 'Incident Response Automation',
            'icon' => 'fas fa-bolt',
            'description' => 'Built an intelligent incident response automation system that integrates with multiple security tools and platforms. The system automatically triages, enriches, and responds to security incidents based on predefined playbooks. Reduced mean time to response (MTTR) from 4 hours to 15 minutes.',
            'technologies' => ['Azure Sentinel', 'Logic Apps', 'Power Automate', 'Microsoft Graph API', 'Custom Connectors', 'Webhook Integration']
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
