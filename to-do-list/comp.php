<?php
$dbc = mysqli_connect('127.0.0.1', 'root', '', 'todo');

if (isset($_GET['id'])) {
    $todo_id = $_GET['id'];

    // Fetch status from the todos table
    $query = "SELECT status FROM todos WHERE id = $todo_id";
    $result = mysqli_query($dbc, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];

        // Toggle the status between 0 and 1
        $newStatus = ($status == 1) ? 0 : 1;

        // Update status in the todos table
        $updateQuery = "UPDATE todos SET status = $newStatus WHERE id = $todo_id";
        mysqli_query($dbc, $updateQuery);
    }
}

// Redirect back to index.php
header("Location: index.php");
exit();
?>
