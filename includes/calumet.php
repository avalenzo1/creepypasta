<?php
  session_start();

  /**
   * These are the main utilities used for the website
   */
  require "./includes/db/connect.php";
  require "./includes/utils/functions.php";
  require "./includes/utils/components.php";
  require "./includes/utils/error.php";
  require "./includes/utils/rulesets.php";
  require "./includes/utils/session.php";

  $components = new Components;
  $passport = new Passport;
?>