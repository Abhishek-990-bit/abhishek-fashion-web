<?php
/**
 * CONTACT FORM PROCESSOR (Save to File Version)
 * This version skips SMTP to avoid authentication errors and 
 * saves all messages to a local file on the server.
 */

// 1. Capture and sanitize form data
$visitor_email   = isset($_POST['email'])   ? htmlspecialchars($_POST['email'])   : '';
$visitor_name    = isset($_POST['name'])    ? htmlspecialchars($_POST['name'])    : 'No Name Provided';
$email_subject   = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : 'No Subject';
$visitor_message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

// 2. Prepare the data string with a timestamp
$time = date('Y-m-d H:i:s');
$data = "[$time] Name: $visitor_name | Email: $visitor_email | Subject: $email_subject | Message: $visitor_message" . PHP_EOL;

// 3. Define the log file name
$log_file = 'contact_logs.txt';

// 4. Save the data to the file
// FILE_APPEND ensures we don't overwrite previous messages
if (file_put_contents($log_file, $data, FILE_APPEND)) {
    // Success: Show alert and redirect back to contact page
    echo "<script>
            alert('Success! Your message has been saved to the server.');
            window.location.href='contact.html';
          </script>";
} else {
    // Failure: Likely a folder permission issue in Docker
    echo "<script>
            alert('Error: Could not save data. Please check server permissions.');
            window.location.href='contact.html';
          </script>";
}
?>