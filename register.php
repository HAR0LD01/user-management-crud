<?php
include('prog.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    $stmt = $connection->prepare("INSERT INTO `user` (first_name, last_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $first_name, $last_name);
    
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
</head>
<body>
    <h1>Register User</h1>
    <form action="register.php" method="post">
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>
        
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>
        
        <input type="submit" value="Register">
    </form>
    <br>
    <a href="home.php">Back to Home Page</a>
    
</body>
</html>
