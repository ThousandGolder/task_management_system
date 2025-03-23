
<nav class="side-bar">
			<div class="user-p">
				<img src="img/user.png">
				<h4><?=$_SESSION['username']?></h4>
			</div>
			<!-- Employee Navigation Bar -->
			   <?php
				 if($_SESSION['role'] == "employe"){
				 ?>
			<ul id="navlist">
				<li>
					<a href="./index.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="./my_task.php">
						<i class="fa fa-tasks" aria-hidden="true"></i>
						<span>My task</span>
					</a>
				</li>
				<li>
					<a href="./profile.php">
						<i class="fa fa-user" aria-hidden="true"></i>
						<span>Profile</span>
					</a>
				</li>
				<li>
					<a href="./notifications.php">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Notifications</span>
					</a>
				</li>
				<li>
					<a href="./logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
			<?php }else{ ?>
	<!-- admin Navigation Bar -->
			<ul id="navlist">
				<li>
					<a href="./index.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="">
					<a href="./user.php">
						<i class="fa fa-users" aria-hidden="true"></i>
						<span>Manage Users</span>
					</a>
				</li>
				<li>
					<a href="./create_task.php">
						<i class="fa fa-plus" aria-hidden="true"></i>
						<span>Create Tasks</span>
					</a>
				</li>
				<li>
					<a href="./task.php">
						<i class="fa fa-tasks" aria-hidden="true"></i>
						<span>All Tasks</span>
					</a>
				</li>
				<li>
					<a href="./logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
			<?php } ?>
		</nav>