<?php
    $db = mysqli_connect('localhost','root','','ipheya');

    #pdo for gantt chart processes
    $pdo = null;
    $limit = 10;
    $counter = 0;
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "ipheya";
    while (true) {
        try {
            $pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username,$password);
            $pdo->exec( "SET CHARACTER SET utf8" );
            $pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
            $pdo->setAttribute( PDO::ATTR_PERSISTENT, true );
            break;
        }
        catch (Exception $e) {
            $pdo = null;
            $counter++;
            if ($counter == $limit)
                throw $e;
        }
    }
    #pdo for gantt chart processes end

    if(mysqli_connect_errno())
    {
      echo "Database connection failed with following error(s): ".mysqli_connect_errno();
      die();
    }
    #require_once($_SERVER['DOCUMENT_ROOT'].'/walk-about/config.php');
    require_once('helpers.php');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
 ?>
