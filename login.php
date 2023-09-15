<?php
include 'config.php';
session_start();
if(isset($_POST['submit'])){

    $email=$_POST['email'];
    $email=filter_var($email,FILTER_SANITIZE_STRING);
    $pass=md5($_POST['pass']);
    $pass=filter_var($pass,FILTER_SANITIZE_STRING);
    
    $select = "SELECT * FROM users WHERE email = '$email' && pass = '$pass'";
    $result = $conn -> query($select);

    if($result -> rowCount() > 0) {
      $row = $result-> fetch(PDO :: FETCH_ASSOC); 
      if($row['user_type'] == 'admin') {
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');
      } elseif($row['user_type'] == 'user') {
         $_SESSION['user_id'] = $row['id'];
         header('location:user_page.php');
      }
    }else{
      $error[] = 'incorrect email or password!';
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css.css">
    
</head>
<body>

<section class="form-container">

<form action="" method="post" enctype="multipart/form-data">
   <h3 style="text-align:center;">login page</h3>

   <label> email:<span>*</span></label>
   <input type="email" required placeholder="enter your email" class="box" name="email">
   <label> password:<span>*</span></label>
   <input type="password" required placeholder="enter your password" class="box" name="pass">


   <p>dont have  account? <a href="register.php">register now</a></p>
   <?php
    if(isset($error)){
      foreach($error as $error){

      echo '<div id="nameAlert" class="alert-danger alert d-block">'.
      '<div style="color:red ; font-size:20px">' .$error.'</div>'.
      '</div>';
      }
    };
  ?>
   <input type="submit" value="login" class="btn" name="submit">
</form>

</section>
</body>
</html>