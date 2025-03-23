<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
  include "./Db_connection.php";
  include "./app/Model/Task.php";
if(!isset($_GET['id'])){
  header("Location:./task.php");
}

 $id = $_GET['id'];
 $task = get_task_by_id($conn,$id);

 if($task==0){
  header("Location:./task.php");
}
     
   $data= array($id);
     delete_task($conn,$data);
    $em= "deleted successfully";
    header("Location:./task.php?success= $em");
    exit();
}else{
    $em = "First log in please";
    header("Location:../login.php?error= $em");
    exit();
      }
?>
