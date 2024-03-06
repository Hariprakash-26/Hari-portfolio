<?php  
$dbc = mysqli_connect('127.0.0.1', 'root', '', 'todo');

if(isset($_POST['submit'])){
    $todo = $_POST['todo'];
    $sql = "INSERT INTO todos (todo) VALUES ('$todo')";
    mysqli_query($dbc, $sql);
    $msg = "Today's todos created.";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>TODOS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
         body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden; /* To prevent horizontal scrollbar */
        }

        video {
            position: fixed;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensure the video covers the entire container */
    z-index: -1;
        }

        .container-fluid {
            z-index: 1;
            position: relative;
        }

        .card {
            margin: 20px;
            opacity: 0.6;
            background-color: white;
        }

        li {
            font-size: 20px;
        }
        card-body{}
    </style>
</head>
<body>

<video autoplay muted loop id="MyVideo"><source src="deer.mp4" type="video/mp4"></video>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Todo List</h5>
                        <form action="index.php" method="post">
                            <div class="form-group">
                                <label>Today's Todo</label>
                                <center>
                                    <input type="text" name="todo" class="form-control">
                                </center>   
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info" type="submit" name="submit">Done</button>
                            </div>
                            <?php if (isset($_POST['submit'])) {?>
                                <div class="alert alert-success">
                                    <p><?=$msg;?></p>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">TODO's</h5>
                        <p class="card-text">My Todo's</p>
                        <ul class="list-group">
                            <?php 
                            $sql = "SELECT * FROM todos";
                            $result = mysqli_query($dbc, $sql);

                            while ($row = mysqli_fetch_array($result)) {
                                $todo = $row['todo'];
                                $todo_id = $row['id'];
                                $status = $row['status'];
                            ?>
                            <li class="list-group-item">
                                <?=$todo?>
                                <?php if ($status == 0) { ?>
                                    &nbsp; 
                                    <a href="edit.php?id=<?=$todo_id?>" class="btn btn-success">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <a href="del.php?id=<?=$todo_id?>" class="btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                    <a href="comp.php?id=<?=$todo_id?>" class="btn btn-info">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="del.php?id=<?=$todo_id?>" class="btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                    <a href="comp.php?id=<?=$todo_id?>" class="btn btn-success">
                                        <i class="fa fa-check" aria-hidden="true" ></i>
                                    </a>
                                <?php } ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
