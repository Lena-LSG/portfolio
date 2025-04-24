<?php
// Security tips array
$security_tips = [
    "Always enable multi-factor authentication on your accounts",
    "Use a password manager to generate and store strong, unique passwords",
    "Keep your operating system and applications updated",
    "Be cautious of unsolicited emails and never click suspicious links",
    "Regularly back up your important data",
    "Use a VPN when connecting to public Wi-Fi networks",
    "Enable encryption on your devices and sensitive data",
    "Review app permissions regularly and limit access to only what's necessary",
    "Use separate email accounts for different purposes",
    "Enable logging and monitoring for critical systems",
    "Implement the principle of least privilege for all accounts",
    "Use passkeys where available instead of traditional passwords",
    "Enable automatic updates for security patches",
    "Monitor your online accounts for suspicious activity",
    "Disable unused services and protocols on your devices"
];

// Get random tip
$tip = $security_tips[array_rand($security_tips)];

// Return plain text response
header('Content-Type: text/plain');
echo $tip;
