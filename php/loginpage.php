<?php
include "dbaname.php";
if (isset($_POST["login"])) {
  $getinfo = $contact1->prepare("SELECT username , email  , password FROM member WHERE email = :email AND password = :pass");
  $getinfo->bindParam("email", $_POST["email"]);
  $getinfo->bindParam("pass", $_POST["pass"]);
  $getinfo->execute();
  if ($getinfo->rowCount() == 1) {
    foreach ($getinfo as $needdata) {
      if ($needdata["email"] != "admin@admin.com") {
        session_start();
        $_SESSION["username"] = $needdata["username"];
        $_SESSION["email"] = $needdata["email"];
        $_SESSION["loged"] = 1;
        header("Location:home.php");
      } else {
        session_start();
        $_SESSION["username"] = $needdata["username"];
        $_SESSION["email"] = $needdata["email"];
        $_SESSION["loged"] = 1;
        setcookie("test" , $_SESSION["loged"] , time() + 3600);
        header("Location:admin.php");
      }
    }
  } else {
    echo "<div class='thediv' id='used'>The Email Or Password Is Incorrect</div>";
  }
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
  <link rel="stylesheet" href="../css/loginpage.css">
  <title>Login Page</title>
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
          <span class="txt" id="txt">Email</span><br>
          <input type="email" name="email" id="email" class="email"><br>
        </div>
        <div>
          <span class="pass" id="pass">Password</span><br>
          <input type="password" name="pass" id="pass" class="pass"><br>
        </div>
        <div>
          <button type="submit" id="login" name="login">Login in</button>
          <button type="submit" id="sign">
            <a href="signpage.php?sign=new">Sign in</a>
          </button>
        </div>
      </form>
    </div>
  </div>
  <footer class="footer" id="footer">
    <div class="right" id="right">COPY RIGHT BY <span style="color:var(--color4)"> Amaar Mohamed </span><i
        class="far fa-copyright"></i><i class="fas fa-registered"></i></div>
    <ul class="contact" id="contact">
      <li><i class="fab fa-facebook"></i></li>
      <li><i class="fab fa-facebook-messenger"></i></li>
      <li><i class="fab fa-whatsapp"></i></li>
    </ul>
  </footer>
  <script src="../js/loginpage.js"></script>
</body>

</html>