<?php
session_start(); // Start the session

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email1 = $_POST['email1'];
    $upswd1 = $_POST['upswd1'];

    if (!empty($email1) && !empty($upswd1)) {
        $host = "127.0.0.1";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "register";

        // Create connection
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        } else {
            $SELECT = "SELECT uname1, upswd1 FROM register WHERE email1 = ? LIMIT 1";

            // Prepare statement
            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("s", $email1);
            $stmt->execute();
            $stmt->bind_result($uname1, $storedPassword);
            $stmt->fetch();

            // Checking email existence and password verification
            if ($storedPassword !== null && $upswd1 === $storedPassword) {
                // Store user information in session variables
                $_SESSION['email'] = $email1;
                $_SESSION['username'] = $uname1;

                // Store user information in local storage for use in JavaScript
                echo '<script>
                        localStorage.setItem("loggedInEmail", "'.$email1.'");
                        localStorage.setItem("loggedInUsername", "'.$uname1.'");
                        window.location.href = "homepage.html";
                      </script>';
                exit(); // Ensure that no more code is executed after redirection
            } else {
                echo "Incorrect email or password";
            }

            $stmt->close();
            $conn->close();
        }
    } else {
        echo "All fields are required";
    }
} else {
    echo "Invalid request";
}
?>
