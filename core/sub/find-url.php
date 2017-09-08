<?php
#21539288 POLELA AL
#Find if a url exists
function urlExists($url) {
      $class_attr = '';
      $handle = curl_init($url);
      curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

      $response = curl_exec($handle);
      $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

      if($httpCode >= 200 && $httpCode <= 400) {
          $bool = true;
      } else {
          $bool = false;
      }
      if($bool==true)
      {
        $class_attr = 'text-success';
      }
      else{
        $class_attr = 'text-danger text-uppercase';
      }
      return $class_attr;
      curl_close($handle);
  }
?>
