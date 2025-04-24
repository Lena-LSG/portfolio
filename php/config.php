<?php
/**
 * Site configuration
 */

// Basic site information
define('SITE_TITLE', 'Lena Gibson - Cyber Security Professional');
define('SITE_DESCRIPTION', 'Cyber Security Infrastructure Specialist with Microsoft Incident Response');
define('SITE_DOMAIN', 'www.yourdomain.com');
define('SITE_URL', 'https://'.SITE_DOMAIN);

// Email configuration for contact form
define('CONTACT_EMAIL', 'your-email@example.com');
define('EMAIL_SUBJECT_PREFIX', '[Portfolio Contact] ');

// Debug mode (set to false in production)
define('DEBUG_MODE', true);

// Set timezone
date_default_timezone_set('UTC');

// Error reporting based on environment
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Social media links
$social_links = [
    'linkedin' => 'https://www.linkedin.com/in/lenagibson',
    'github' => 'https://github.com/yourgithubprofile',
    'twitter' => 'https://twitter.com/yourtwitterhandle'
];
