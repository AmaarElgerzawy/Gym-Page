<?php
  $username1 = "root";
  $pass1 = "";
  $contact1 = new PDO("mysql:host=localhost;dbname=users;" , $username1 , $pass1);
  $contact2 = new PDO("mysql:host=localhost;dbname=products;" , $username1 , $pass1);
?>