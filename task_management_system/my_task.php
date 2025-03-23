<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id']) && ($_SESSION['role']=="employe")){
	include "Db_connection.php";
	include "app/Model/Task.php";
  include "app/Model/User.php";
  $assigned_to = $_SESSION['id'];
	$my_tasks = get_all_my_tasks($conn,$assigned_to);
	$users = get_all_users($conn);

	// print_r($assigned_to)

?>
<!DOCTYPE html>
<html>
<head>
	<title>My Tasks</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/style.css">

</head>
<body>
	<input type="checkbox" id="checkbox">
<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
    <h4 class="title">My Tasks 
	  <?php if (isset($_GET['success'])) {?> 
      <span>
      <?php echo stripcslashes($_GET['success']);?>
      <?php }?>
     </span> 
	</h4>
	<table class="main-table">
		<?php if ($my_tasks!=0){ ?>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Discription</th>
				<th>Due Date</th>
				<th>status</th>
				<th>Action</th>
			</tr>
			<tr>
			<?php $i=0; foreach($my_tasks as $task){ ?>
				<td><?php echo++$i; ?></td>
				<td><?=$task["title"]?></td>
				<td><?=$task["discription"]?></td>
				<td><?=$task["due_date"]?></td>
				<td><?=$task["status"]?></td>
				<td>
					<a href="edit_task_employe.php?id=<?=$task["id"]?>" class="edit-btn">Edit</a>
				</td>
			</tr>
			<?php }?>
		</table>
   <?php } else{

				echo"
			 <tr>
				<th>#</th>
				<th>Title</th>
				<th>Discription</th>
				<th>Assigned To</th>
				<th>Action</th>
			</tr>
				<tr><td>empty table </td></tr> 	</table>";
			} ?> 
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
		header("Location:../login.php?error= $em");
		exit();
		}
?>
