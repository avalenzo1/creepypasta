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
          <label for="password" class="col-form-label">Email</label>
        </div>
        <div class="col-auto">
          <input name="email" type="email" placeholder="(e.g. 'avalenzo@cps.edu')" class="form-control" id="email" min="1" max="45" />
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

      <button class="btn btn-primary" type="submit">Register</button>
    </form>

    <?php
      $username = $_POST["username"] ?? NULL;
      $email = $_POST["email"] ?? NULL;
      $password = $_POST["password"] ?? NULL;

      /**
       * Registers account 
       * @param {string} username
       * @param {string} email
       * @param {string} password
       * 
       * @return void
       */
      function register($username, $email, $password)
      {
        global $conn;

        if (strlen($password) < 8)
        {
          throw "Password must be more than 8 characters in length";
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        echo $password;
        echo strlen($password);

        $statement = $conn->prepare("INSERT INTO user (id, username, email, password) VALUES (UUID(), ?, ?, ?)");
        $statement->bind_param("sss", $username, $email, $password); // "sss" means that $username, $email and $password are all bound as strings
        
        $statement->execute();
        $statement->close();
      }

      if (is_string($username) && is_string($email) && is_string($password))
      {
        register($username, $email, $password);

        echo "Success!";
      }
    ?>
  </div>
</body>

</html>