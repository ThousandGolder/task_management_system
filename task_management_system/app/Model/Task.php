<?php
function Insert_task($conn,$data){
  $sql = "INSERT INTO tasks (title,discription,assigned_to,due_date) VALUES (?,?,?,?) ";
  $stmt = $conn->prepare($sql);
  $stmt->execute($data);
}

function get_all_tasks($conn){
   $sql = "SELECT * FROM tasks ";
  
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);

if($stmt->rowCount() > 0){
  $tasks  = $stmt->fetchAll();
}else  $tasks = 0;
return $tasks;
}

// $my_tasks = get_all_my_tasks($conn,$_SESSION['id'])

function get_all_my_tasks($conn,$assigned_to){
  $sql = "SELECT * FROM tasks WHERE assigned_to=?";
 $stmt = $conn->prepare($sql);
  $stmt->execute([$assigned_to]);

if($stmt->rowCount() > 0){
  $tasks  = $stmt->fetchAll();
}else  $tasks = 0;
return $tasks;
}




function get_all_tasks_no_dealine($conn){
   $sql = "SELECT * FROM tasks WHERE status != 'completed' AND due_date  IS NULL OR due_date = '0000-00-00' ";
  // $sql = "SELECT * FROM tasks ORDER BY id DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);

if($stmt->rowCount() > 0){
  $tasks  = $stmt->fetchAll();
}else  $tasks = 0;
return $tasks;
}

function count_tasks_no_deadline($conn){
 $sql = "SELECT id FROM tasks  WHERE status !='completed' AND due_date  IS NULL OR due_date = '0000-00-00' ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
return $stmt->rowCount();
}
 
function get_all_tasks_overdue($conn){
   $sql = "SELECT * FROM tasks WHERE due_date < CURDATE() AND status !='completed' ";
  // $sql = "SELECT * FROM tasks ORDER BY id DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);

if($stmt->rowCount() > 0){
  $tasks  = $stmt->fetchAll();
}else  $tasks = 0;
return $tasks;
}

function count_tasks_due_overdue($conn){
 $sql = "SELECT id FROM tasks  WHERE due_date < CURDATE()  AND status !='completed'";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
return $stmt->rowCount();
}

function get_task_by_id($conn,$id){
  $sql = "SELECT * FROM tasks WHERE id =? ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);

if($stmt->rowCount() > 0){
  $task = $stmt->fetch();
}else  $task =0;
return $task;
}

function count_tasks($conn){
 $sql = "SELECT id FROM tasks";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
return $stmt->rowCount();
}

function get_all_tasks_due_today($conn){
   $sql = "SELECT * FROM tasks WHERE due_date = CURDATE() ";
  // $sql = "SELECT * FROM tasks ORDER BY id DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);

if($stmt->rowCount() > 0){
  $tasks  = $stmt->fetchAll();
}else  $tasks = 0;
return $tasks;
}

function count_tasks_due_today($conn){
 $sql = "SELECT id FROM tasks  WHERE due_date = CURDATE()";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
return $stmt->rowCount();
}

function delete_task($conn,$data){
  $sql = "DELETE FROM tasks  WHERE id=?";
  $stmt = $conn->prepare($sql);
 $stmt->execute($data);
}

function update_tasks($conn,$data){
  $sql = "UPDATE tasks SET title =?, discription=?, assigned_to=?,due_date=? WHERE id =? ";
  $stmt = $conn->prepare($sql);
  $stmt->execute($data);
}

function update_tasks_status($conn,$data){
  $sql = "UPDATE tasks SET status=?  WHERE id =? ";
  $stmt = $conn->prepare($sql);
  $stmt->execute($data);
}


function get_all_task_by_id($conn,$id){
  $sql = "SELECT * FROM tasks WHERE assigned_to =? ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);

if($stmt->rowCount() > 0){
  $tasks = $stmt->fetchAll();
}else  $tasks =0;
return $tasks;
}

function count_my_pending_tasks($conn,$id){
 $sql = "SELECT id FROM tasks  WHERE status = 'pending' AND assigned_to=? ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
return $stmt->rowCount();
}

function count_my_in_progress_tasks($conn,$id){
 $sql = "SELECT id FROM tasks  WHERE status = 'in_progress' AND assigned_to=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
return $stmt->rowCount();
}

function count_my_completed_tasks($conn,$id){
 $sql = "SELECT id FROM tasks  WHERE status = 'completed' AND assigned_to=? ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
return $stmt->rowCount();
}

function count_pending_tasks($conn){
 $sql = "SELECT id FROM tasks  WHERE status = 'pending' ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
return $stmt->rowCount();
}

function count_in_progress_tasks($conn){
 $sql = "SELECT id FROM tasks  WHERE status = 'in_progress' ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
return $stmt->rowCount();
}

function count_completed_tasks($conn){
 $sql = "SELECT id FROM tasks  WHERE status = 'completed' ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([]);
return $stmt->rowCount();
}


function count_my_tasks($conn,$id){
 $sql = "SELECT id FROM tasks WHERE assigned_to=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
return $stmt->rowCount();
}


function count_tasks_my_due_overdue($conn,$id){
 $sql = "SELECT id FROM tasks  WHERE due_date < CURDATE()  AND status !='completed' AND assigned_to=? AND due_date != '0000-00-00' ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
return $stmt->rowCount();
}

function count_my_tasks_no_deadline($conn,$id){
 $sql = "SELECT id FROM tasks  WHERE due_date  IS NULL OR due_date = '0000-00-00' AND assigned_to=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
return $stmt->rowCount();
}

function count_my_tasks_due_today($conn,$id){
 $sql = "SELECT id FROM tasks  WHERE due_date = CURDATE() AND assigned_to=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
return $stmt->rowCount();
}
?>