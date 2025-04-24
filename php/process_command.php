<?php
require_once 'config.php';
require_once 'functions.php';

// Check for AJAX request
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Process command
    $command = isset($_POST['command']) ? $_POST['command'] : '';
    $result = process_terminal_command($command);
    
    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}

// Redirect to home page if accessed directly
header('Location: ../index.php');
exit;
