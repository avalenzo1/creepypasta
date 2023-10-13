<?php
  class Components {
    public function alert($title, $msg, $dismissible = false, $fixed = false, $type = "primary") {
      $fixed_attr = $fixed ? "data-mdb-fixed" : "";
      $dismiss_btn = $dismissible ? <<<HTML
      <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
      HTML : "";

      echo <<<HTML
        <div class="alert alert-dismissible fade show alert-$type" role="alert" data-mdb-color="$type" $fixed_attr>
        <h4 class="alert-heading">$title</h4>
          $msg
          $dismiss_btn
        </div>
      HTML;
    }

    public function bread_crumbs() {
      $crumbs = explode("/", parse_url(current_url(), PHP_URL_PATH));
      $crumbs = array_map('ucfirst', $crumbs);
      $crumbs = array_filter($crumbs);
      
      $list = "";

      foreach($crumbs as $crumb){
        $list .= <<<HTML
          <a href="" class="text-reset">$crumb</a>
        HTML;

        if ($crumb !== end($crumbs)) {
          $list .= <<<HTML
            <span>/</span>
          HTML;
        }
      }

      $current_path = end($crumbs);

      echo <<<HTML
        <div>
          <h1 class="">$current_path</h1>
          <nav class="d-flex">
            <h6 class="mb-0">
              $list
            </h6>
          </nav>
        </div>
        <hr>
      HTML;
    }

    public function toast($title, $time, $text) {
      echo <<<HTML
        <div class="toast show fade mx-auto" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-autohide="false" data-mdb-fixed>
          <div class="toast-header">
            <strong class="me-auto">$title</strong>
            <small>$time</small>
            <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">$text</div>
        </div>
      HTML;
    }
  }

  class Component {
    public function __contructor($element) {

    }
  }
?>