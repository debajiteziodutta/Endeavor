<?php
session_start();
    $conn =  mysqli_connect(
    //Server name. for local project it will be "local host" and for live server, here you have to mention the server ip. 
    'localhost',
    //for username of wamp or xampp
    'root',
    //for password to login into wamp or xampp
    '',
    //mentioning the database name
    'sit'
  ) or die(mysqli_erro($mysqli));
?>
