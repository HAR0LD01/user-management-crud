<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        .container {
            
            text-align: center;
            margin-top: 50px;
        }
        button {
            padding: 15px 30px;
            margin: 10px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Management</h1>
        <button onclick="location.href='register.php'">Add Users</button>
        <button onclick="location.href='delete.php'">Delete Users</button>
        <button onclick="location.href='update.php'">Update Users</button>
    </div>
</body>
</html>
