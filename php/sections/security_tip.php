<?php
// Array of security tips
$security_tips = [
    "Use a password manager to generate and store strong, unique passwords",
    "Enable multi-factor authentication on all important accounts",
    "Keep your operating system and software updated regularly",
    "Use encrypted connections (HTTPS) when browsing websites",
    "Be cautious of phishing attempts in emails and messages",
    "Regularly back up important data to secure locations",
    "Use a VPN when connecting to public Wi-Fi networks",
    "Regularly audit third-party app permissions on your accounts",
    "Consider using a privacy-focused browser or extensions",
    "Encrypt sensitive files before storing them in the cloud"
];

// Select a random tip
$random_tip = $security_tips[array_rand($security_tips)];
?>

<div class="security-tip">
    <i class="fas fa-shield-alt"></i>
    <div>
        <h5>Security Tip</h5>
        <p><?php echo $random_tip; ?></p>
    </div>
</div>
