<?php 


 $dbc = mysqli_connect('127.0.0.1', 'root', '', 'todo');

$todo_id = $_GET['id'];

$sql = "delete from todos where id = $todo_id";
mysqli_query($dbc, $sql);

echo '<script>alert("Todo is Deleted.")</script>';
echo("<script>location.href = 'index.php';</script>");

?>
				   
