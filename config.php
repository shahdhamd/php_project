<?php
$db_name="mysql:host=localhost;dbname=user_form";
$username="root";
$password="";
$conn=new PDO($db_name,$username,$password);


  
  function test_input($data) { 
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data; 
  }

?>