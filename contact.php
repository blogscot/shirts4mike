<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $message = trim($_POST["message"]);

  if ($name == "" or $email == "" or $message == "") {
    echo "You must specify a value for a name, email address and message.";
    exit;
  }

  # Prevent PHP Email header injection SNIPPET
  foreach( $_POST as $value) {
    if ( stripos($value, 'Content-Type:') != FALSE) {
      echo "There was a problem with the information you entered.";
      exit;
    }
  }

  # Prevent spam bots
  if ($_POST['address'] != "") {
    echo "Your form submission has an error.";
    exit;
  }

  date_default_timezone_set('Europe/Paris');
  require_once('includes/phpmailer/PHPMailerAutoload.php');

  $mail = new PHPMailer();

  if (!$mail->ValidateAddress($email)) {
    echo "You must specify a valid email address.";
    exit;
  }

$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "iainDOTdiamondATgmailDOTcom";
//Password to use for SMTP authentication
$mail->Password = "thisisnotmypasswordnoreallyimnotjoking";
//Set who the message is to be sent from
$mail->setFrom($email, $name);
//Set who the message is to be sent to
$mail->addAddress('iainDOTdiamondATgmailDOTcom', 'Iain Diamond');
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($message);

//send the message, check for errors
// if (!$mail->send()) {
//     echo "Mailer Error: " . $mail->ErrorInfo;
//     exit;
// }

  # We'll learn to send an email in the future!

  header("Location: contact.php?status=thanks");
  exit;
}

$pageTitle = "Contact";
$siteName = "Shirts 4 Mike";
$section = "contact";
include('includes/header.php'); ?>

<div class="section page">

  <div class="wrapper">
  <h1>Contact</h1>

  <?php if (isset($_GET["status"]) and $_GET["status"] == "thanks") { ?>
      <p>Thanks for the email I&rsquo;ll be in touch shortly.</p>
  <?php } else { ?>
    <p>I&rsquo;d love to hear from you! Complete the form to send me an email.</p>
    
    <form action="contact.php" method="POST">
      <label for="name">Name</label>
      <input id="name" type="text" name="name" placeholder="Enter your name"><br>
      <label for="email">Email</label>
      <input id="email" type="text" name="email" placeholder="Enter your email address"><br>
      <label for="message">Message</label>
      <textarea name="message" id="message" rows="10"></textarea><br>
      <input type="submit" value="Send">
      <div style="display: none;">
        <label for="address">Address</label>
        <input id="address" type="text" name="address" placeholder="Please leave blank"><br>
      </div>
    </form>
  <?php } ?>
  </div>
    
</div>

<?php include('includes/footer.php'); ?>
