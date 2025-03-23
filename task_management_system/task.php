<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
	include "Db_connection.php";
	include "./app/Model/Task.php";
	include "./app/Model/User.php";
	
	$text="All Task";
	if(isset($_GET['due_date']) && $_GET['due_date'] =="Due Today"){
  $text ="Due Today";
		$tasks = get_all_tasks_due_today($conn);
		$num_task= count_tasks_due_today($conn);
		$users = get_all_users($conn);
	}elseif(isset($_GET['due_date']) && $_GET['due_date'] =="Overdue"){
    $text ="Overdue";
   	$tasks = get_all_tasks_overdue($conn);
		$num_task= count_tasks_due_overdue($conn);
		$users = get_all_users($conn);
	}elseif(isset($_GET['due_date']) && $_GET['due_date'] =="No Deadline"){
  $text ="No Deadline";
		$tasks = get_all_tasks_no_dealine($conn);
		$num_task= count_tasks_no_deadline($conn);
		$users = get_all_users($conn);
	}
	else{
		$tasks = get_all_tasks($conn);
		$num_task= count_tasks($conn);
		$users = get_all_users($conn);
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>All Tasks</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/style.css">

</head>
<body>
	<input type="checkbox" id="checkbox">
<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
    <h4 class="title"> <a href="./create_task.php">Create Task</a>
		<a href="./task.php?due_date=Due Today"> Due Today</a>
		<a href="./task.php?due_date=Overdue"> Overdue</a>
		<a href="./task.php?due_date=No Deadline">No Deadline</a>
		<a href="./task.php">All Tasks</a>
		<br><br><?=$text?> ( <?=$num_task?> ) 
	  <?php if (isset($_GET['success'])) {?> 
      <span>
      <?php echo stripcslashes($_GET['success']);?>
      <?php }?>
     </span> 
	</h4>
	<table class="main-table">
		<?php if ($tasks!=0){ ?>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Discription</th>
				<th>Assigned To</th>
				<th>Due To Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			<tr>
			<?php $i=0; foreach($tasks as $task){ ?>
				<td><?php echo ++$i ?></td>
				<td><?=$task["title"]?></td>
				<td><?=$task["discription"]?></td>
				<td> <?php if($task["due_date"] ==""){
           echo"No Deadline";
				}else echo $task["due_date"]; ?></td>
				<td>
				<?php
				 foreach($users as $user){
					if($user['id'] == $task['assigned_to']){
						echo $user['full_name'];
					}
				}
				?>
				</td>
				<td><?=$task["status"]?></td>
				<td>
					<a href="edit_task.php?id=<?=$task["id"]?>" class="edit-btn">Edit</a>
					<a href="delete_task.php?id=<?=$task["id"]?>" class="delete-btn">Delete</a>
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
  var active = document.querySelector("#navlist li:nth-child(4)");
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
