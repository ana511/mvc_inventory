<?php
  $host = 'localhost';
  $username = "root";
  $password = "";
  $port = 3306;
  $dbname = "week7";

  /* Attempt MySQL server connection. Assuming you are running MySQL
  server with default setting (user 'root' with no password) */
  $mysqli = new mysqli($host, $username, $password, $dbname, $port);
  // Check connection
  if($mysqli === false){
      die("ERROR: Could not connect. " . $mysqli->connect_error);
  }
?>