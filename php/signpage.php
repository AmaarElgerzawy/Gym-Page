<?php
include "dbaname.php";
if ($_GET["sign"] == "new") {

  $getemail = $contact1->prepare("SELECT email FROM member WHERE email = :email");
  $getemail->bindParam("email", $_POST["email"]);
  $getemail->execute();
  
  $getusername = $contact1->prepare("SELECT username FROM member WHERE username = :user");
  $getusername->bindParam("user", $_POST["username"]);
  $getusername->execute();
  
  if ($getemail->rowCount() == 0 && $getusername->rowCount() == 0) {
    if (isset($_POST["sign"])) {
      if ($_POST["pass"] === $_POST["repass"]) {
        session_start();
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["password"] = $_POST["pass"];
        $randomactive = floor(random_int(1000000, 9999999));
        setcookie("activecode", $randomactive, time() + 360);
        require_once "mailer.php";
        $mail->setFrom('snipergolden1234@gmail.com', 'Amaar');
        $mail->addAddress($_POST["email"]);
        $mail->Subject = 'Welcome To Gym Academe';
        $mail->Body    = 'The Active Code For Your Email Is <p style="font-weight:600;font-size:
          60px;color:red;">' . $randomactive . '</p>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        if ($mail->send()) {
          setcookie("therasnd", $randomactive, time() + 3600);
          $_SESSION["activecode"] = $randomactive;
          header("Location:active.php?active=do");
        }
      }
    }
  } else {
    echo "<div class='thediv' id='used'> UnAvailable Email , Used  Or User Name</div>";
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
  <link rel="stylesheet" href="../css/signpage.css">
  <title>Sign In</title>
</head>

<body>
  <div class="shad"></div>
  <div class="header" id="header">
    <div>
      <span class="logo">GYM <i id="logo" class=" fas fa-dumbbell logo"></i> Academe</span>
    </div>
  </div>
  <div class="container" id="container">
    <div class="form" id="form">
      <form method="POST">
        <div>
          <span class="txt" id="txt">User Name</span><br>
          <input type="text" name="username" id="username" class="username" required><br>
        </div>
        <div>
          <span class="txt" id="txt">Email</span><br>
          <input type="email" name="email" id="email" class="email" required><br>
        </div>
        <div>
          <span class="pass" id="pass">Password</span><br>
          <input type="password" name="pass" id="passs" class="pass" required><br>
        </div>
        <div>
          <span class="password" id="pass">RE Password</span><br>
          <input type="password" name="repass" id="repasss" class="repass" required><br>
        </div>
        <div>
          <button type="submit" id="sign" name="sign">Sign in</button>
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
  <script src="../js/signpage.js"></script>
</body>

</html>

</html>