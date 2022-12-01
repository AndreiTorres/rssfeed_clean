<?php


class Connection {

  
  static function connect() {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "rssfeedclean";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
  
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
  }

  static function close($conn) {
    mysqli_close($conn);
  }

}






?>