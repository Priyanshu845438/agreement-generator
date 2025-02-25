<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = realpath($file); // Get the absolute path

    // Debugging: Print the file path
    echo "File Path: " . $filePath . "<br>";

    // Check if file exists and prevent directory traversal
    if (file_exists($filePath) && strpos($filePath, realpath(__DIR__ . '/uploads')) === 0) {
        // Set headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush();
        readfile($filePath);
        exit;
    } else {
        echo "File not found: " . $filePath; // Debugging output
        http_response_code(404);
        exit;
    }
} else {
    echo "No file specified!";
}
