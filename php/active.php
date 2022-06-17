<?php
session_start();
include "dbaname.php";
if ($_GET["active"] == "do") {
  if (isset($_POST["final"])) {
    if ($_POST["active"] == $_SESSION["activecode"]) {
      $adduser = $contact1->prepare("INSERT INTO `member` (username , email , password)
        VALUES (:username , :email , :password)");
      $adduser->bindParam("username", $_SESSION["username"]);
      $adduser->bindParam("email", $_SESSION["email"]);
      $adduser->bindParam("password", $_SESSION["password"]);
      $adduser->execute();
      header("Location:loginpage.php");
    } else {
      echo "<div class='thediv'>Please Check The Active Code And Try Again</div>";
    }
  }
} else {
  header("Location:loginpage.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/all.css">
  <link rel="stylesheet" href="../css/all.min.css">
  <link rel="stylesheet" href="../css/active.css">
  <title>Document</title>
</head>

<body>
  <div class="header" id="header">
    <div>
      <span class="logo">GYM <i id="logo" class=" fas fa-dumbbell logo"></i> Academe</span>
    </div>
  </div>
  <div class="container" id="container">
    <div class="form" id="form">
      <form method="POST">
        <div>
          <span class="txt" id="txt">Enter The Active Code</span><br>
          <input type="number" name="active" id="active" class="active" required><br>
        </div>
        <button type="submit" name="final" id="final">Activation</button>
      </form>
    </div>
  </div>
  <script src="../js/active.js"></script>
</body>


</html>