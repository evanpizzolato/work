<?php
//turns off errors for user
ini_set('display_errors', 0); //allows to change configuration settings

//error_reporting(0);


function nerrorhandler($errno,$errmsg,$filename,$errline){
  $errortype = array(
      E_ERROR => "Error",
      E_WARNING => "warning",
      'E_PARSE' => "parse error",
      "E_NOTICE" => "Notice",
      E_USER_ERROR => " user Error",
      E_USER_WARNING => "user warning",
      E_USER_NOTICE => "user Notice"
      
      
  );
  
  
  $dt = date('Y-m-d H:i:s');
  $err = "Error reporting\n";
  $err .= "\t Date Time: " . $dt . "\n";
  $err .= "\t Error Number: " . $errno . "\n";
  $err .= "\t Error Message: " . $errmsg . "\n";
  $err .= "\t file name: " . $filename . "\n";
  $err .= "\t Error line number: " . $errline . "\n";
  $err .= "End reporting\n";
  
  

  error_log($err,3, dirname(__FILE__). '\errors\log_errors\error_log.log');
  

//header("Location: customerror.php");  
    
}


set_error_handler("nerrorhandler");


?>
