<?php
$errors = array();
    function display_errors($errors){
      $display = '<ul class="bg-danger" style="list-style-type: none;">';
      foreach($errors as $error){
        $display .='<li  class="text-danger text-center">'.$error.'</li>';
      }
      $display .= '</ul>';
      return $display;
    }
    function sanitize($dirty){
      return htmlentities($dirty,ENT_QUOTES,"UTF-8");
    }
    function money($number){
      return 'R'.number_format($number,2);
    }
    #function login($user_id){
    #  $_SESSION['Client'] = $user_id;
    #  global $db;

    #  }
?>
