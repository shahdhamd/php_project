<?php
include 'config.php';
if(isset($_GET['deletedid'])){
    $id=$_GET['deletedid'];
 
    $delete_sql = "DELETE FROM users WHERE id = :id";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bindParam(':id', $id);
    $delete_result = $delete_stmt->execute();

    
    if ($delete_result === true) {
       header('location:display.php');

}else{
    echo 'error in delete';
}
}


?>