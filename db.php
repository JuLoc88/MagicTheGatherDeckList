<?php
  $username   = "db_user";
  $password   = "Ku6Hoo4MJ3";

  try {
      $pdo = new PDO('mysql:host=45.56.114.155:3306;dbname=db', $username, $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }  
?>