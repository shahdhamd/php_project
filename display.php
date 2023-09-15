<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="crudAdmin.php" class="text-light" style="text-decoration: none;">Add user</a></button>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">pass</th>
                <th scope="col">image</th>
              </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM users where user_type='user'";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $pass = $row['pass'];
                        $image = $row['image'];
                        echo '<tr>
                        <th scope="row">' . $id . '</th>
                        <td>' . $name . '</td>
                        <td>' . $email . '</td>
                        <td>' . $pass . '</td>
                        <td>' . $image . '</td>
                        <td>
                        <button class="text-light btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light"   style="text-decoration: none;">update</a></button> 
                        <button class="text-light btn btn-danger"><a href="delet.php?deletedid='. $id .'"  class="text-light" style="text-decoration: none;">delete</a></button>
                        <button class="text-light btn btn-warning"><a href="set.php?setid='. $id .'"  class="text-light" style="text-decoration: none;">set user password</a></button>
                    </td>
                      </tr>';
                    }
                }
                ?>
            
            </tbody>
          </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>