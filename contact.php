<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  $email_body = "";
  $email_body = "Name: ".$name;
  $email_body = $email_body . "\nEmail: ".$email;
  $email_body = $email_body . "\nMessage: ".$message;
  echo $email_body;

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
    </form>
  <?php } ?>
  </div>
    
</div>

<?php include('includes/footer.php'); ?>
