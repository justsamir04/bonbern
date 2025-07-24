<?php
header('Content-Type: application/json');

$to = "aakashraj@bonbern.com";

$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'msg' => 'Please fill out all fields.']);
    exit;
}

$headers  = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$sent = mail($to, $subject, $message, $headers);

echo json_encode([
    'status' => $sent ? 'success' : 'error',
    'msg'    => $sent ? 'Your message has been sent. Thank you!' : 'Mail failed, please try again.'
]);
?>