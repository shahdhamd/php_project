<?php
include 'config.php';
$id=$_GET['setid'];
$select = $conn->prepare("SELECT * FROM `users` WHERE id = ? ");
$select->execute([$id]);
$row = $select->fetch(PDO::FETCH_ASSOC);
$pass = $row['pass'];
if(isset($_POST['submit'])){
    $pass=md5($_POST['pass']);
    $pass=filter_var($pass,FILTER_SANITIZE_STRING);
    $update = $conn->prepare("UPDATE users SET id=?, pass=? WHERE id=?");
    $update->execute([$id, $pass, $id]);
    if($update){
        header('location:display.php');
    }else{
        $message[]="fail in update";
    }
}
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
    <label >NEW PASSWORD</label>
    <input type="password" class="form-control" name="pass" autocomplete="off" value=<?php echo $pass;?>>
  </div>







  <button type="submit" class="btn btn-primary" name="submit">Update</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>