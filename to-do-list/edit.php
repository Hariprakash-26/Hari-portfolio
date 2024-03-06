<?php
$dbc = mysqli_connect('127.0.0.1', 'root', '', 'todo');

if (isset($_GET['id'])) {
    $todo_id = $_GET['id'];

    // Fetch data from table
    $sql = "SELECT * FROM todos WHERE id = $todo_id";
    $result = mysqli_query($dbc, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $todo = $row['todo'];
    } else {
        // Handle invalid ID, redirect to index.php
        header("Location: index.php");
        exit();
    }
} elseif (isset($_POST['submit'])) {
    $todo = $_POST['todo'];
    $id = $_POST['id'];

    // Update todo
    $query = "UPDATE todos SET todo = '$todo' WHERE id = $id";
    mysqli_query($dbc, $query);

    header("Location: index.php");
    exit();
} else {
    // Handle no ID, redirect to index.php
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>TODOS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .card {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">Edit Todo</h5>
            <div class="card-body">
                <form action="edit.php" method="post">
                    <div class="form-group">
                        <input type="text" name="todo" value="<?=$todo?>" class="form-control">
                        <input type="hidden" name="id" value="<?=$todo_id?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
