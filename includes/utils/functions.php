<?php 
  // Redirects to another page
  function redirect($url) {
    ob_start();
    header("Location: $url");
    ob_end_flush();
    die();
  }

  function current_url() {
    return 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}";
  }

  function latest_path() {
    $current_url = explode("/", parse_url(current_url(), PHP_URL_PATH));
    $path = array_map('ucfirst', $current_url);
    $path = array_filter($path);
    $latest_path = end($path);

    return $latest_path;
  }

  function is_root() {
    return $_SERVER['REQUEST_URI'] === "/";
  }
?>