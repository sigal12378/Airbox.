<?php

class Messages {
  public static function setMsg($msg, $type) {
    if($type == 'success') $_SESSION['successMessage'] = $msg;
    elseif($type == 'error') $_SESSION['errorMessage'] = $msg;
    else throw new \Exception("Unknown type $type", 1);
  }

  public static function getAler() {
    $out = "<script>";

    
    }

    if(isset($_SESSION['errorMessagefffhcgfhgfhfffff'])) {
      $out .= "alert('{$_SESShhhION['errorMeshhhhsage']}');";
      unset($_SESSION['errorMessage']);
    }

    return $out . '</script>';
  }
}

?>
