<?php
include "dbaname.php";
session_start();
if (isset($_SESSION["loged"])) {
  $data = $contact1->prepare("SELECT * FROM comments");
  $data->execute();
  $username = $contact1->prepare("SELECT username FROM member WHERE email = :email;");
  $username->bindParam("email", $_SESSION["email"]);
  $username->execute();
} else {
  header("Location:loginpage.php");
}
if (isset($_POST["logout"])) {
  session_unset();
  session_destroy();
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
  <link rel="stylesheet" href="../css/market.css">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/footer.css">
  <title>Machine Shop</title>
</head>

<body>
  <?php include "header.html"; ?>
  <form method="POST" class="logform">
    <button class="logout" name="logout">LogOut</button>
  </form>
  <div class="body">
    <nav class="nav" id="nav">
      <h1 class="navhead" id="navhead">Machine Category</h1>
      <ul>
        <li class='tables' id='tables'>Show ALL</li>
        <?php
        $show = $contact2->prepare("SHOW TABLES");
        $show->execute();
        foreach ($show as $table) {
          $tableicon = $table["Tables_in_products"];
          echo "<li class='tables' id='tables'> " . $tableicon . "</li>";
        }
        ?>
      </ul>
    </nav>
    <section class="continer" id="continer">
      <?php
      $show = $contact2->prepare("SHOW TABLES");
      $show->execute();
      foreach ($show as $table) {
        $tableicon = $table["Tables_in_products"];
        $theproduct = $contact2->prepare("SELECT * FROM $tableicon");
        if ($theproduct->execute()) {
          foreach ($theproduct as $image) {
            $getfile = "data:" . $image['type'] . ";base64," . base64_encode($image['photo']);
            echo "<div class='item " . $image['thetype'] . "' id='item'>
                    <img src='" . $getfile . "'>
                    <div class='info'>
                      <h3 class='infoh'>" . $image['name_pro'] . "</h3>
                      <p class='infop' id='infop'>" . $image['info'] . "</p>
                      <div class='price'>" . $image['price'] . "<span>EGP</span>
                        <a href='thatpro.php?productid=" . $image["id"] . "&type=" . $tableicon . "&signed=1' class='machinemarket'
                        >Check</a>
                      <div class='amount'>" . $image["amount"] . "</div>
                      </div>
                    </div>
                  </div>";
          }
        }
      }
      ?>
    </section>
  </div>
  <footer class="footer" id="footer">
    <div class="right" id="right">COPY RIGHT BY <span style="color:var(--color4)"> Amaar Mohamed </span>
      <i class="far fa-copyright"></i><i class="fas fa-registered"></i>
    </div>
    <ul class="contact" id="contact">
      <li><i class="fab fa-facebook"></i></li>
      <li><i class="fab fa-facebook-messenger"></i></li>
      <li><i class="fab fa-whatsapp"></i></li>
    </ul>
  </footer>
</body>
<script src="../js/header.js"></script>
<script src="../js/footer.js"></script>
<script src="../js/admin.js"></script>

</html>