<?php
// Assuming $email is the unique identifier (email address) of the logged-in user
$email = "john@example.com"; // Replace this with the actual email address

// Connect to your database
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "home";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
} else {
    // Select the user ID based on the email address
    $selectQuery = "SELECT user_id FROM register WHERE email = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();

    // Now $userId contains the user ID associated with the provided email address

    // Handle profile picture upload
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $avatarFileName = $_FILES['avatar']['name'];
        $avatarTmpName = $_FILES['avatar']['tmp_name'];

        // Define the upload directory
        $uploadDirectory = "path/to/your/upload/directory/";

        // Move the uploaded file to the upload directory
        move_uploaded_file($avatarTmpName, $uploadDirectory . $avatarFileName);

        // Update the database with the avatar file name
        $updateQuery = "UPDATE register SET avatar = ? WHERE user_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("si", $avatarFileName, $userId);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
}
?>
