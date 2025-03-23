<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
  include "./Db_connection.php";
  include "./app/Model/User.php";
 $users = get_all_users($conn);
//  print_r($users);
?>
<!DOCTYPE html>
<html>
<head>
	<title>create task</title>
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
    .container_add_users .success,
    .container_add_users .error {
      color:rgb(230, 58, 58);
      width: 80%;
      height: 35px;
      font-size: 16px;
      padding-left: 10px;

    }

   .container_add_users .success{
      color:rgb(119, 194, 141);
    
    }

</style>
</head>
<body>
<input type="checkbox" id="checkbox">
<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
    <h4 class="title">create task </h4>
     <form action="./app/add_task.php" class="container_add_users" method="POST">
      <?php if (isset($_GET['error'])) {?> 
      <span class="error">
       <?php echo stripcslashes($_GET['error']);?>
      <?php }?>
      </span> 
      <?php if (isset($_GET['success'])) {?> 
      <span class="success">
       <?php echo stripcslashes($_GET['success']);?>
      <?php }?>
       </span> 
      <br><label for="tilte">Title</label><br>
      <input type="text" placeholder="Tilte" name="tilte"><br>
     <div>
        <label>Discription</label><br>
        <textarea type="text" name = "discription" class="input-1"
        placeholder="Discription" ></textarea><br>
     </div>
      <br><label for="due_date">Due to Date</label><br>
      <input type="date" name="due_date"><br>
     <label>Assigned to</label><br>
     <select name="assigned_to"  id=""  class="input-1">
      <option value="0">select employe</option>
      <?php if($users!=0){
        foreach($users as $user){
          ?>
       <option value="<?= $user['id']?>"><?= $user['full_name']?></option>  
       <?php }} ?>
     </select>
      <input type="submit" value="create task" name="create_task" class="add_user_btn">
     </form>
		</section>
	</div>
<script type="text/javascript">
  var active = document.querySelector("#navlist li:nth-child(3)");
  active.classList.add("active");
</script>
</body>
</html>
<?php 
}else{
    $em = "First log in please";
    header("Location:../login.php?error= $em");
    exit();
         }
?>
