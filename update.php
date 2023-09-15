<?php
include 'config.php';
$id=$_GET['updateid'];
$select = $conn->prepare("SELECT * FROM `users` WHERE id = ? ");
$select->execute([$id]);
$row = $select->fetch(PDO::FETCH_ASSOC);

$name = $row['name'];
$email = $row['email'];
$pass = $row['pass'];
$image = $row['image'];

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
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder='images/'.$image;
        if($pass!=$cpass){
            $message[]='confirm password not matched';
        }else if($image_size > 2000000){
            $message[] = 'img is large!';
        
        }else{
            $update = $conn->prepare("UPDATE users SET id=?, name=?, pass=?, email=?, image=? WHERE id=?");
            $update->execute([$id,$name, $pass, $email, $image, $id]);

            if($update){
                move_uploaded_file($image_tmp_name, $image_folder);
               header('location:display.php');
               
            }
            
}
        }
  //  }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>crudAdmin</title>
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>
<form method="post" enctype="multipart/form-data">
    <div class="container my-5">
  <div class="mb-3">
    <label >name</label>
    <input type="name" class="form-control" name="name" autocomplete="off" value=<?php echo $name;?>>
  </div>

  <div class="mb-3">
    <label >Email </label>
    <input type="email" class="form-control" name="email" autocomplete="off" value=<?php echo $email;?>>
  </div>
  <div class="mb-3">
    <label >Password</label>
    <input type="password" class="form-control" name="pass" autocomplete="off" value=<?php echo $pass;?>>
  </div>

  <div class="mb-3">
    <label >ConfirmPassword</label>
    <input type="password" class="form-control" name="cpass" autocomplete="off">
  </div>
  <div class="mb-3">
    <label >image:</label>
    <input type="file" class="form-control" accept="image/jpg, image/png, image/jpeg" name="image" >
  </div>





  <button type="submit" class="btn btn-primary" name="submit">Update</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>