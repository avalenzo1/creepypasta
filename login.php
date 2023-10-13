<?php
  include "./includes/calumet.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <?php include "./includes/components/head.php" ?>
</head>

<body>
  <?php include "./includes/components/header.php" ?>

  <div class="container">
    <form class="bg-light p-4 rounded shadow" method="post">
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="username" class="col-form-label">Username</label>
        </div>
        <div class="col-auto">
          <input name="username" placeholder="(e.g. 'avalenzo')" class="form-control" id="username" min="1" max="45" />
        </div>
      </div>

      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="password" class="col-form-label">Password</label>
        </div>

        <div class="col-auto">
          <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpInline">
        </div>

        <div class="col-auto">
          <span id="passwordHelpInline" class="form-text">
            Must be 8-20 characters long.
          </span>
        </div>
      </div>

      <button class="btn btn-primary" type="submit">Login</button>
    </form>

    <?php
      if(isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        try {
          $user = new User($username, $password);
          $passport->setRegisteredUser($user);
        } catch (Exception $e) {
          $components->alert("Error", $e->getMessage(), true, true, "warning");
        }
      }
    ?>
  </div>
</body>

</html>