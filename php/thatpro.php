<?php
include "dbaname.php";
// include "header.php";
$typee = $_GET["type"];
$id = $_GET["productid"];
$thatpro = $contact2->prepare("SELECT name_pro FROM $typee WHERE id = $id");
$thatpro->execute();
$thatpro = $thatpro->fetchObject();
$title = $thatpro->name_pro;
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
  <link rel="stylesheet" href="../css/thatpro.css">
  <title><?php echo "About : " . $title ?></title>
</head>

<body>
  <table class="table">
    <thead>
      <td> <?php echo "About : " . $title ?> </td>
    </thead>
    <tbody>
      <td>
        <div class="container">
          <div id="counter" class="counter"></div>
          <?php
          $photos = $contact1->prepare("SELECT * FROM otherphoto WHERE id = $id AND infotype = '$typee'");
          $photos->execute();
          foreach ($photos as $data) {
            $getdata = "data:" . $data["type"] . ";base64," . base64_encode($data["photo"]);
            echo "<img src='" . $getdata . "'/>";
          }
          ?>
          <div class="slider-control">
            <span id="Prev" class="Prev">Previous</span>
            <span id="bulits" class="bulits"></span>
            <span id="next" class="next">Next</span>
          </div>
        </div>
      </td>
      <tr>
        <td>
          <span>The rest of the product</span>
          <span>
            <?php
            $info = $contact2->prepare("SELECT amount FROM $typee WHERE id = $id");
            $info->execute();
            $info = $info->fetchObject();
            echo $info->amount;
            ?>
          </span>
        </td>
      </tr>
      <td class="tdcolor">
        <span>Avilable Color</span>
        <span>
          <ul class="color">
            <?php
            $info = $contact2->prepare("SELECT color FROM $typee WHERE id = $id");
            $info->execute();
            $info = $info->fetchObject();
            $ary = explode("-", $info->color);
            foreach ($ary as $color) {
              echo "<li><span style='color:" . $color . ";margin:0px 5px;'>" . $color . "</span></li>";
            }
            ?>
          </ul>
        </span>
      </td>
      <tr>
        <td style="display: flex;justify-content:start;padding:0px">
          <span>Avilable Size For Product</span>
          <span class="spanspecifications">
            <?php
            $info = $contact2->prepare("SELECT size FROM $typee WHERE id = $id");
            $info->execute();
            $info = $info->fetchObject();
            $ary = explode("-", $info->size);
            echo "<ul>";
            foreach ($ary as $data) {
              echo "<li style='list-style-type: disc;'>" . $data . "</li>";
            }
            echo "</ul";
            ?>
          </span>
        </td>
      </tr>
      <td style="display: flex;justify-content:start;padding:0px">
        <span>specifications</span>
        <span class="spanspecifications">
          <?php
          $info = $contact2->prepare("SELECT specifications FROM $typee WHERE id = $id");
          $info->execute();
          $info = $info->fetchObject();
          $ary = explode(".", $info->specifications);
          echo "<ul>";
          foreach ($ary as $specifications) {
            echo "<li  class='ulspanspecifications'>" . $specifications . "</li>";
          }
          echo "</ul>";
          ?>
        </span>
      </td>
      <tr>
        <td>
          <form action="" method="POST">
            <button type="submit" name="call" id="call">Call Saller</button>
            <button type="submit" name="sale" id="sale">Sale</button>
          </form>
        </td>
      </tr>
    </tbody>
  </table>
  <script src="../js/thatpro.js"></script>
</body>

</html>