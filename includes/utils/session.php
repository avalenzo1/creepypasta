<?php

/**
 * User class
 * @param {string} username
 * @param {string} password
 * 
 * @return void
 */
class User
{
  function __construct($username, $password)
  {
    $this->username = $username;
    $this->password = $password;
    $this->initialize();
  }

  public function initialize()
  {
    global $conn;

    // Finds matching usernamee
    $statement = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $statement->bind_param("s", $this->username);
    $statement->execute();
    $query = $statement->get_result();
    $statement->close();

    $account = mysqli_fetch_all($query, MYSQLI_ASSOC);

    // Checks that both username exists and password matches.
    if (mysqli_num_rows($query) === 1 && password_verify($this->password, $account[0]["password"])) {
      $this->id = $account[0]["id"];
      $this->token = bin2hex(random_bytes(12));

      $this->username = $account[0]["username"];

      $this->last_online = date('Y-m-d H:i:s');
      $this->is_online = true;

      $this->verified = $account[0]["verified"];

      echo gettype($this->is_online);

      // Updates account information
      $statement = $conn->prepare("UPDATE user SET token = ?, is_online = ?, last_online = ? WHERE id = ?");
      $statement->bind_param("siss", $this->token, $this->is_online, $this->last_online, $this->id);
      $statement->execute();
      $query = $statement->get_result();
      $statement->close();

      unset($this->password);
    } else {
      throw new Exception("Incorrect username or password");
    }
  }

  public function getDetails()
  {
    return (object) array(
      "id" => $this->id,
      "username" => $this->username,
      "last_online" => $this->last_online,
      "is_online" => $this->is_online,
      "verified" => $this->verified,
      "token" => $this->token,
    );
  }
}
class Passport
{
  private $user;
  function __construct()
  {
    $this->listen();
    $this->validate();
  }

  private function listen()
  {
    if (isset($_GET["logout"])) {
      $this->destructRegisteredUser();
    }
  }

  private function panic()
  {
    // if (!is_root()) {
    //   redirect("/");
    // }
  }

  public function validate()
  {
    if ($this->hasRegisteredUser()) {
      // If user is logged in, passport retrieves user session.
      $this->user = $_SESSION["user"];
    } else {
      $this->panic();
    }
  }

  public function hasRegisteredUser()
  {
    if (isset($_SESSION['user'])) {
      return true;
    }

    return false;
  }

  public function destructRegisteredUser()
  {
    unset($this->user);
    unset($_SESSION['user']);
    session_destroy();
  }

  public function getRegisteredUser()
  {
    return $this->user;
  }

  public function setRegisteredUser($user)
  {
    if ($user instanceof User) {
      $_SESSION["user"] = $user->getDetails();
      $this->validate();
    }
  }
}
