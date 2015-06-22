<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $message = trim($_POST["message"]);

  if ($name == "" or $email == "" or $message == "") {
    $error_message = "You must specify a value for a name, email address and message.";
  }

  if (!isset($error_message)) {
    # Prevent PHP Email header injection SNIPPET
    foreach( $_POST as $value) {
      if ( stripos($value, 'Content-Type:') != FALSE) {
        $error_message = "There was a problem with the information you entered.";
      }
    }
  }

  # Prevent spam bots
  if (!isset($error_message) and $_POST['address'] != "") {
    $error_message = "Your form submission has an error.";
  }

  date_default_timezone_set('Europe/Paris');
  require_once('includes/phpmailer/PHPMailerAutoload.php');

  $mail = new PHPMailer();

  if (!isset($error_message) and !$mail->ValidateAddress($email)) {
    $error_message = "You must specify a valid email address.";
  }

  if (!isset($error_message)) {
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

    // send the message, check for errors
    // if ($mail->send()) {
    //   header("Location: contact.php?status=thanks");
    //   exit;
    // } else {
    //   $error_message = "Mailer Error: ". $mail->ErrorInfo;
    // }
  }
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

    <?php if (!isset($error_message)) {
      echo '<p>I&rsquo;d love to hear from you! Complete the form to send me an email.</p>';
    } else {
      echo '<p class="message">'. $error_message .'</p>';
      } ?>

    <form action="contact.php" method="POST">
      <label for="name">Name</label>
      <input id="name" type="text" name="name" value="<?php if (isset($name)) { echo htmlspecialchars($name); } ?>" placeholder="Enter your name"><br>
      <label for="email">Email</label>
      <input id="email" type="text" name="email" value="<?php if (isset($email)) { echo htmlspecialchars($email); } ?>" placeholder="Enter your email address"><br>
      <label for="message">Message</label>
      <textarea name="message" id="message" rows="10"><?php if (isset($message)) { echo htmlspecialchars($message); } ?></textarea><br>
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
