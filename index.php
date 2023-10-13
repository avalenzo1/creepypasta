<?php
  include "./includes/calumet.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include "./includes/components/head.php" ?>
</head>

<body>
  <?php
  $query = $_GET["q"] ?? "";
  $query = htmlspecialchars($query);
  ?>

  <?php include "./includes/components/header.php" ?>

  <section>
    <?php
    if ($query != '') {
      echo "<h2>Results for <i>{$query}</i></h2>";
    }
    ?>

    <!-- <table>
      <tr>
        <th>Thread</th>
        <th>Replies</th>
        <th>Last Post</th>
      </tr>
      <tr>
        <td>Alfreds Futterkiste</td>
        <td>1</td>
        <td>12-26-2004 12:00 AM</td>
      </tr>
      <tr>
        <td>Centro comercial Moctezuma</td>
        <td>5</td>
        <td>12-26-2004 1:25 PM</td>
      </tr>
    </table> -->
  </section>
</body>

</html>