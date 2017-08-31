<?php
      /* our simple php ping function
      function ping($host)
      {
              exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval);
              return $rval === 0;
      }
      */
      $bool = FALSE;

      function ping($host,$port=80,$timeout=6)
      {
              $fsock = fsockopen($host, $port, $errno, $errstr, $timeout);
              if ( ! $fsock )
              {
                      $bool = FALSE;
              }
              else
              {
                      $bool = TRUE;
              }
              return $bool;
      }

      /* check if the host is up
        $host can also be an ip address */
      $host = 'www.alomac-universal.com';
      $up = ping($host);


      if($bool==TRUE)
      {
        header('Location: http://'.$host);
        /* optionally display either a red or green image to signify the server status */
        #echo '<img src="'.($up ? 'on' : 'off').'.jpg" alt="'.($up ? 'up' : 'down').'" />';
      }
      else{
        /* optionally display either a red or green image to signify the server status */
        echo '<img src="'.($up ? 'on' : 'off').'.jpg" alt="'.($up ? 'up' : 'down').'" />';
      }
 ?>
