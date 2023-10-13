<?php
  function error_handler($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
      // This error code is not included in error_reporting, so let it fall
      // through to the standard PHP error handler
      return false;
    }
  
    // Supported error types
    $php_error_types = [
      E_WARNING => 'Warning',
      E_NOTICE => 'Notice',
      E_USER_ERROR => 'User Error',
      E_USER_WARNING => 'User Warning',
      E_USER_NOTICE => 'User Notice',
      E_RECOVERABLE_ERROR => 'Recoverable Error',
      E_DEPRECATED => 'Deprecated',
      E_USER_DEPRECATED => 'User Deprecated',
      E_ALL => 'All'
    ];

    $php_version = PHP_VERSION;

    echo <<<HTML
      <div class="alert alert-dismissible fade show alert-danger" role="alert" data-mdb-color="warning" data-mdb-fixed>
        <div>
          <strong>Version Number: </strong> $php_version
        </div>
        <div> 
          <strong>$php_error_types[$errno]: </strong> $errstr
        </div>
        <div>
        <strong>Error thrown: </strong> at <strong>$errfile</strong> at line <strong>$errline</strong>
        </div>
        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
      </div>
    HTML;
  
    /* Do not execute PHP internal error handler */
    return true;
  }
  
  set_error_handler('error_handler');
?>