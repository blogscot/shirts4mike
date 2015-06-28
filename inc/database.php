<?php 

try {
  $db = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME, DB_USER, DB_PASSWORD);
  $db->exec("'SET NAMES 'utf8'");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo 'Problem connection to database: ' . $e->getMessage();  
  exit;
}

