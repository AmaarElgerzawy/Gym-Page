<?php
include "dbaname.php";
if (isset($_POST["logout"])) {
  session_unset();
  session_destroy();
  header("Location:loginpage.php");
}
if (isset($_POST['upload'])) {
  $cat = $_POST["cat"];

  $filenamepro = $_FILES["file"]["name"];
  $filetypepro = $_FILES["file"]["type"];
  $needdfile = file_get_contents($_FILES["file"]["tmp_name"]);

  $filename = $_POST["name"];
  $fileinfo = $_POST["info"];
  $fileprice = $_POST["price"];
  $fileamount = $_POST["amount"];
  $color = $_POST["color"];
  $specifications = $_POST["specifications"];
  $size = $_POST["size"];

  $theproduct = $contact2->prepare(
    "INSERT INTO $cat (`thetype` , `name_pro` , `info`, `price`, `amount` , `photo`, `type`, `name_photo` , `color`, `specifications` , `size`)
  VALUES (:thetype , :name_pro , :info , :price , :amount , :photo , :type , :name_photo , :color , :specifications , :size);"
  );

  $theproduct->bindParam("thetype", $cat);
  $theproduct->bindParam("name_pro", $filename);
  $theproduct->bindParam("info", $fileinfo);
  $theproduct->bindParam("price", $fileprice);
  $theproduct->bindParam("amount", $fileamount);
  $theproduct->bindParam("photo", $needdfile);
  $theproduct->bindParam("type", $filetypepro);
  $theproduct->bindParam("name_photo", $filenamepro);
  $theproduct->bindParam("color", $color);
  $theproduct->bindParam("specifications", $specifications);
  $theproduct->bindParam("size", $size);
  $theproduct->execute();

  $startid = $contact2->prepare("SELECT id FROM $cat WHERE name_pro = '$filename'");
  $startid->execute();
  $startid = $startid->fetchObject();

  $otherphototype = $_FILES["otherphoto"]["type"];
  $otherphoto = $_FILES["otherphoto"]["tmp_name"];

  for ($i = 0; $i < count($otherphoto); $i++) {
    $oter_p = file_get_contents($otherphoto[$i]);
    $up = $contact1->prepare("INSERT INTO `otherphoto` (id , infotype , photo , type) 
      VALUES (:id , :infotype , :photo , :type)");

    $up->bindParam("id", $startid->id);
    $up->bindParam("infotype", $cat);
    $up->bindParam("photo", $oter_p);
    $up->bindParam("type", $otherphototype[$i]);
    $up->execute();
  }
  header("Refresh:0");
} elseif (isset($_POST["name-cat"])) {
  $name = $_POST["name-cat"];
  $new = $contact2->prepare(
    "CREATE TABLE $name ( 
            id int(11) AUTO_INCREMENT,
            thetype varchar(30) NOT null,
            name_pro varchar(30) NOT null,
            info varchar(750) NOT null,
            price int(11) NOT null,
            amount int(11) NOT null,
            photo longblob NOT null,
            type varchar (11) NOT null,
            name_photo text NOT null,
            color text NOT null,
            specifications text NOT null,
            size text NOT null,
            PRIMARY KEY (id) 
          )ENGINE=INNODB;"
  );
  $new->execute();
  header("Refresh:0");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/marketadmin.css">
  <title>Admin Page</title>
</head>

<body>
  <form action="admin.php" method="POST">
    <button type="submit" name="Make New Cat" id="button-cat">Make New Cat</button>
    <button type="submit" name="Upload Product" id="button-up">Upload Product</button>
  </form>
  <form method="POST" enctype="multipart/form-data" class="form-up" id="form-up">
    category :
    <?php
    $show = $contact2->prepare("SHOW TABLES");
    $show->execute();
    echo "<section>";
    foreach ($show as $table) {
      $tableicon = $table["Tables_in_products"];
      echo "<span stley='display:flex;'>
        <input type='radio' name=' cat' value='" . $tableicon . "' /><span> " . $tableicon . " </span>
      </span>";
    }
    echo "</section>";
    ?>
    The Main Photo : <input type='file' name='file' id='file'>
    Other Photos :<input type='file' name='otherphoto[]' multiple>
    name :<input type='text' name='name' id='name'>
    info :<input type='text' name='info' id='info'>
    price :<input type='number' name='price' id='price'>
    amount :<input type='number' name='amount' id='amount'>
    color :<input type='text' name='color' id='color'>
    specifications:<input type='text' name='specifications' id='specifications'>
    size:<input type='text' name='size' id='size'>
    <button type='submit' name='upload'>رفع ملف</button>
  </form>
  <form method="POST" enctype="multipart/form-data" class="form-cat" id="form-cat">
    Name :<input type="text" name="name-cat" id="name-cat">
    <button type="submit" name="make">Make</button>
  </form>
  <form method="POST" class="logform">
    <button class="logout" name="logout">LogOut</button>
  </form>
  <script src='../js/admin.js'></script>
</body>

</html>