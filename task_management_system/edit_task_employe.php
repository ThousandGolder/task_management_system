<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'employe'){
  include "./Db_connection.php";
  include "./app/Model/Task.php";
  include "./app/Model/User.php";
   $users = get_all_users($conn);
  if(!isset($_GET['id'])){
    header("Location:./task.php");
  }

  $id = $_GET['id'];
  $task = get_task_by_id($conn,$id);

  if($task==0){
    header("Location:./task.php");
  }
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>edit Tasks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .container_add_users{
        width: 50%;
        min-width: 300px;}
      .input-1,
      .container_add_users input {
        width: 80%;
        height: 35px;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 10px;
        color: gray;
        justify-content: center;
        margin: 5px auto 10px auto;
        border: 1px solid;
        border-color: blue;
      }
      .container_add_users .add_user_btn{
      max-width: 40%;
      padding: auto;
      margin: auto  20%;
      border: none;
      background-color: #006CE0;
      color: #fff;
      font-size: 18px;
      }
      .add_user_btn:hover{
        opacity: 0.6;
      }
    .container_add_users span{
      color: red;
    } 
    </style>
  </head>
    
  <body>
    <input type="checkbox" id="checkbox">
  <?php include "inc/header.php" ?>
    <div class="body">
      <?php include "inc/nav.php" ?>
      <section class="section-1">
      <h4 class="title">Edit Tasks <a href="./my_task.php">Tasks</a>
        <?php if (isset($_GET['success'])) {?> 
        <span>
        <?php echo stripcslashes($_GET['success']);?>
        <?php }?>
        </span>
        <?php if (isset($_GET['error'])) {?> 
        <span>
        <?php echo stripcslashes($_GET['error']);?>
        <?php }?>
        </span> 
    </h4>
      <form action="./app/update_task_employe.php" class="container_add_users" method="POST">

        <div> Title :<b><p><?=$task['title']?></p><b></div><br>
        <div> Discription :<b><p><?=$task['discription']?></p><b></div><br>
      <label>Status</label><br>
      <select name="status"  id=""  class="input-1">
        <option  <?php  if($task['status']=="pending") echo"selected"; ?> 
          >pending</option> 
        <option  <?php  if($task['status']=="in_progress") echo"selected"; ?> 
          >in_progress</option> 
        <option  <?php  if($task['status']=="completed") echo"selected"; ?> 
          >completed</option> 
        
      </select>
      <input type="text" name="id" value="<?=$task['id']?>" hidden="true">
        <input type="submit" value="Update" name="submit" class="add_user_btn">
      </form>
      
      </section>
    </div>
  <script type="text/javascript">
    var active = document.querySelector("#navlist li:nth-child(2)");
    active.classList.add("active");
  </script>
  </body>
  </html>
  <?php 
}else{
      $em = "First log in please";
      header("Location:./login.php?error= $em");
      exit();
       }
?>
