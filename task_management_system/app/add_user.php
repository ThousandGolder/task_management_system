<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
  if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['full_name'])){
      include "../Db_connection.php";
       include "./Model/User.php";
      // validating input data
        function validate_input($data){
          $data= trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        $full_name = validate_input($_POST['full_name']);
        $user_name = validate_input($_POST['user_name']);
        $password = validate_input($_POST['password']);
        $check_Username = getUserName($conn ,$user_name);
      
        if(empty($user_name)){
          $em= "Username is required";
          header("Location:../add_user.php?erroru= $em");
          exit();
          }
        elseif(empty($full_name)){
          $errorName = "Name is required";
          header("Location:../add_user.php?errorf= $errorName");
          exit();
        }elseif(empty($password)){
          $errorPwr= "Password is required";
          header("Location:../add_user.php?errorp= $errorPwr");
          exit();
         }elseif($check_Username !=0){
            $success ="$user_name are already registered ";
            header("Location:../add_user.php?success= $success"); 
             exit();
         }else{
          
          // insert data to into data base
           
            $password= password_hash($password,PASSWORD_DEFAULT);
            $data = array($full_name,$user_name,$password,"employe");
            Insert_user($conn,$data);
            $success ="You are successfully entered";
            header("Location:../add_user.php?success= $success"); 
        }
  }else{

      if(empty($_POST['full_name'])){
       $errorf = "Name is required <br>";
       header("Location:../add_user.php?errorf=$errorf");

      }elseif(empty($_POST['user_name'])){
       $erroru = "Username is required <br>";
      header("Location:../add_user.php?erroru=$erroru");  
      }elseif(empty($_POST['password'])){
        $errorp ="Password is required <br>";
      header("Location:../add_user.php?errorp=$errorp");
      }

    }
}else{
    $em = "First log in please";
    header("Location:../login.php?error= $em");
    exit();
    }
?>




