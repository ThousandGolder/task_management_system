<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin'){
  include "./Db_connection.php";
  include "./app/Model/Task.php";
  include "./app/Model/User.php";
  //  $users = get_all_users($conn);
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
      <h4 class="title">update Tasks <a href="./task.php"> All tasks</a>
        <?php if (isset($_GET['success'])) {?> 
        <span>
        <?php echo stripcslashes($_GET['success']);?>
        <?php }?>
        </span> 
    </h4>
      <form action="./app/update_task.php" class="container_add_users" method="POST">
        <label for="title" >Title</label><br>
        <input type="text" name="title" value="<?=$task['title']?>"><br>
      
          <label for="discription">Discription</label><br>
          <textarea rows="4" cols="64" type="text" name = "discription" class="input-1"
          ><?=$task['discription']?></textarea><br>
          <label for="due_date" >Due To Date</label><br>
        <input type="date" name="due_date" value="<?=$task['due_date']?>"><br>
      <label>Assigned to</label><br>
      <select name="assigned_to"  id=""  class="input-1">
        <option value="0">select employe</option>
        <?php  if($users!=0){
                foreach($users as $user){
                  if($task['assigned_to'] == $user['id']){?>
                  <option selected value="<?= $user['id']?>"><?= $user['full_name']?></option>  
                <?php }else{ ?>
          <option  value="<?= $user['id']?>"><?= $user['full_name']?></option> 
          <?php } }}?>
      </select>
      <input type="text" name="id" value="<?=$task['id']?>" hidden="true">
        <input type="submit" value="Update" name="submit" class="add_user_btn">
      </form>
      
      </section>
    </div>
  <script type="text/javascript">
    var active = document.querySelector("#navlist li:nth-child(4)");
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
