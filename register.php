

<?php

@include 'config.php';

if(isset($_POST['submit'])){

  $name=$_POST['name'];
  $name=filter_var($name,FILTER_SANITIZE_STRING);
  $email=$_POST['email'];
  $email=filter_var($email,FILTER_SANITIZE_STRING);
  $pass=md5($_POST['pass']);
  $pass=filter_var($pass,FILTER_SANITIZE_STRING);
  $cpass=md5($_POST['cpass']);
  $cpass=filter_var($cpass,FILTER_SANITIZE_STRING);

    
    $image=$_FILES['image']['name'];
    $image_tmp=$_FILES['image']['tmp_name'];
    move_uploaded_file($image_tmp, 'images/'.$image);
    $select = "SELECT * FROM users WHERE email = '$email'";
    $row = $conn -> query($select);
    
    if($row ->rowCount() > 0) {
        $error[] = 'email already exist!';
        
    }else{
      if($pass!=$cpass){
        $error[]='passward and conform passward do not match.try again';
      }
      else{
        $add_inf = "INSERT INTO users(name, email, pass,  image) VALUES('$name','$email','$pass', '$image')";
        $conn -> query($add_inf);
        header('location:login.php');
      }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css.css">
    
</head>
<body>

<section class="form-container">

<form action="" method="post" enctype="multipart/form-data">
   <h3 style="text-align:center;">register page</h3>
   <label> UserName:<span>*</span></label>
   <input type="text" required placeholder="enter your username" class="box" name="name">
   <label> email:<span>*</span></label>
   <input type="email" required placeholder="enter your email" class="box" name="email">
   <label> password:<span>*</span></label>
   <input type="password" required placeholder="enter your password" class="box" name="pass">
   <label> confirm password:<span>*</span></label>
   <input type="password" required placeholder="confirm your password" class="box" name="cpass">
 
   <input type="file" name="image" required class="box" accept="image/jpg, image/png, image/jpeg">
   <p>already have an account? <a href="login.php">login now</a></p>
   <?php
        if(isset($error)){
          foreach($error as $error){
          echo 
          '<div style="color:red ; font-size:20px">' .$error.'</div>';
          }
        };
      ?>
   <input type="submit" value="register now" class="btn" name="submit">
</form>

</section>
</body>
</html>