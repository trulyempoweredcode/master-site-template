<?php
/**
 * FORM HANDLER — 20i SMTP
 *
 * Deploy this file to the 20i hosting account.
 * Set the form action in contact.html to point at this file:
 *   action="https://editmy.site/form-handler.php"
 *
 * The form POSTs: name, email, phone, message
 * This script sends the enquiry email and returns JSON.
 */

// CORS — allow the client site origin
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// --- Configuration (set per client site) ---
$to_email   = '{{NOTIFICATION_EMAIL}}';  // Where enquiries are sent
$site_name  = '{{BUSINESS_NAME}}';
$from_email = 'noreply@{{DOMAIN}}';      // Must be on the 20i domain

// --- Collect & sanitise fields ---
$name    = trim(strip_tags($_POST['name'] ?? ''));
$email   = trim(strip_tags($_POST['email'] ?? ''));
$phone   = trim(strip_tags($_POST['phone'] ?? ''));
$message = trim(strip_tags($_POST['message'] ?? ''));

// --- Validate required fields ---
if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo json_encode(['error' => 'Please fill in all required fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Please enter a valid email address.']);
    exit;
}

// --- Build notification email ---
$subject = "New enquiry from $name — $site_name";

$body  = "New enquiry from your website contact form:\n\n";
$body .= "Name:    $name\n";
$body .= "Email:   $email\n";
$body .= "Phone:   $phone\n\n";
$body .= "Message:\n$message\n";

$headers  = "From: $site_name <$from_email>\r\n";
$headers .= "Reply-To: $name <$email>\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

$sent = mail($to_email, $subject, $body, $headers);

if (!$sent) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to send email. Please try again.']);
    exit;
}

// --- Auto-reply to enquirer ---
$reply_subject = "Thank you for your message — $site_name";
$reply_body  = "Hi $name,\n\n";
$reply_body .= "Thank you for getting in touch. I've received your message and will reply within 24 hours.\n\n";
$reply_body .= "Best wishes,\n";
$reply_body .= "$site_name\n";

$reply_headers  = "From: $site_name <$from_email>\r\n";
$reply_headers .= "X-Mailer: PHP/" . phpversion();

mail($email, $reply_subject, $reply_body, $reply_headers);

// --- Success ---
http_response_code(200);
echo json_encode(['success' => true, 'message' => 'Message sent successfully.']);
