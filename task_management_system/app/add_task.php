<?php
session_start();
if($_POST['create_task']){
  if(isset($_SESSION['role']) && isset($_SESSION['id'])){
  if (isset($_POST['tilte']) && isset($_POST['discription'])  && isset($_POST['due_date']) && isset($_POST['assigned_to']) &&isset($_SESSION['role']) =='admin'){
      include "../Db_connection.php";
      // validating input data
      
        function validate_input($data){
          $data= trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        $tilte = validate_input($_POST['tilte']);
        $discription = validate_input($_POST['discription']);
        $assigned_to = validate_input($_POST['assigned_to']);
        $due_date = validate_input($_POST['due_date']);

     
        if(empty($tilte)){
          $em= "Tilte is required";
          header("Location:../create_task.php?error= $em");
          exit();
          }
        elseif(empty($discription)){
          $errorName = "Discription is required";
          header("Location:../create_task.php?error= $errorName");
          exit();
        }elseif(empty($assigned_to)){
          $errorPwr= "Assigned to is required";
          header("Location:../create_task.php?error= $errorPwr");
          exit();
        } 
        else{
          
          // insert data to into data base
            include "./Model/Task.php";
            include "./Model/Notifications.php";
            $data = array($tilte,$discription,$assigned_to,$due_date);
            Insert_task($conn,$data);

            $notify_data=array("'$tilte' has been assigned to you. please review and start working on it ",$assigned_to,'New Task Assigned');
            insert_notification($conn,$notify_data);
            $success ="Task are created successfully";
            header("Location:../create_task.php?success= $success"); 
     
        }
  }else{

      if(empty($_POST['title'])){
       $error = "title is required <br>";
       header("Location:../create_task.php?error=$error");

      }elseif(empty($_POST['discription'])){
       $error = "discription is required <br>";
      header("Location:../create_task.php?error=$error");  
      }elseif(empty($_POST['assigned_to'])){
        $errorp ="Assigned to is required <br>";
      header("Location:../create_task.php?error=$error");
      }

    }
}else{
    $em = "First log in please";
    header("Location:../create_task.php?error= $em");
    exit();
    }
}
?>




