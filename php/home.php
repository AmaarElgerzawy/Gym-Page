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
if (isset($_POST["send"])) {
  $sql = $contact1->prepare("INSERT INTO comments (username , email , coment , date ) VALUES (:username , :email , :comment , :date );");
  $sql->bindParam("username", $_SESSION["username"]);
  $sql->bindParam("email", $_SESSION["email"]);
  $sql->bindParam("comment", $_POST["comnt"]);
  $needtime = date("Y-m-d h:i:s", time());
  $sql->bindParam("date", $needtime);
  $sql->execute();
  header("Refresh:0");
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
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/footer.css">
  <title>Home Page : <?php echo $_SESSION["username"]; ?> </title>
</head>

<body>
  <?php include_once "header.html"; ?>
  <form method="POST" class="logform">
    <button class="logout" name="logout">LogOut</button>
  </form>
  <div class="landing" id="home">
    <div class="aboutus">
      <h2 class="whoare"> Academe Gym</h2>
      <h4 class="motivation">Motivation Welcome
        <span class="username">
          <?php echo $_SESSION["username"]; ?>
        </span>
      </h4>
      <p class="thewhoare"> “The mind is the limit.
        As long as the mind can envision the fact that you can do something,
        you can do it, as long as you really believe 100 percent.”
        <span>Arnold Schwarzenegger</span>
      </p>
    </div>
  </div>
  <div class="about">
    <h1 class="abouthead">Service</h1>
    <p class="underservhead">Our Site Afford Many Services</p>
    <div class="free">
      <h3 class="freehead">Free Services</h3>
      <section class="container1">
        <div class="progrss">
          <img src="../data/image-asset.jpeg">
          <p class="info">You Can Assign Your Progress In A weekly schedule TO Know Your progres In Weight And Rips</p>
        </div>
        <div class="traintable">
          <img src="../data/16784018b7db9293c6e7661affcde37b.jpg">
          <p class="info">We Create A Proffishional Training Table Mabe By Best Coachs</p>
        </div>
        <div class="market">
          <img src="../data/Best-all-in-one-home-gym-1 (1).jpg">
          <p class="info">We Have A Market Machine Gym , We Afford A huge Colection And Most Devlobed Machine</p>
          <button type="submit" id="machinemarket">Go</button>
        </div>
      </section>
    </div>
    <div class="pro">
      <h3 class="paidhead">Paid Services</h3>
      <section class="container2">
        <div class="doctor">
          <img src="../data/download.jfif">
          <p class="info">Contact With Best Doctor In Training Field , They Will Be Avalible 24 Hours For You</p>
        </div>
        <div class=" coach">
          <img src="../data/download (1).jfif">
          <p class="info">Contact With Global Coach To Get Information About What You Need And Modern Training</p>
        </div>
        <div class="diet">
          <img src="../data/download (2).jfif">
          <p class="info">Get The Diet Made By Proffishional Coach In Training Field</p>
        </div>
        <div class="private">
          <img src="../data/download (3).jfif">
          <p class="info">Take Your Place With Best Online Coach</p>
        </div>
      </section>
    </div>
  </div>
  <div class="sport" id="sport">
    <h1 class="sporthead">Sports</h1>
    <section class="sportscontainer">
      <div class="gym">
        <img src="../data/gym.jfif" alt="">
        <p class="gyminfo">Take A look In Our Gym.</p>
      </div>
      <div class="workout">
        <img src="../data/images (3).jfif" alt="">
        <p class="gyminfo">Take A look In Our Workout Gym.</p>
      </div>
      <div class="swim">
        <img src="../data/images (4).jfif" alt="">
        <p class="gyminfo">Check Our Swim Bool and Learnin Technique.</p>
      </div>
      <div class="parkor">
        <img src="../data/images (5).jfif" alt="">
        <p class="gyminfo">Check Our Parkour Style.</p>
      </div>
      <div class="box">
        <img src="../data/download (5).jfif" alt="">
        <p class="gyminfo">Check Our Boxing Gym And Tools.</p>
      </div>
    </section>
  </div>
  <div class="coomentshow">
    <h1 class="comenthead">Comment</h1>
    <?php
    foreach ($data as $comment) {
      echo '
      <div class="orgcoment">
        <div class="name">' . $comment["username"] . ' </div>
        <div class="email">' . $comment["email"] . ' </div>
        <div class="comment">' . $comment["coment"] . ' </div>
        <div class="time">' . $comment["date"] . ' </div>
      </div> ';
    }
    ?>
  </div>
  <div class="comments">
    <form method="post" class="formcomment">
      <textarea type="text" name="comnt" class="comnt" placeholder="Leave Comment For Us And For Outher"
        maxlength="750"></textarea>
      <button type="submit" name="send" id="btn">Send</button>
    </form>
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
  <script src="../js/home.js"></script>
  <script src="../js/header.js"></script>
  <script src="../js/footer.js"></script>
</body>

</html>