<?php
include('prog.php');

$id_to_edit = "";
$existing_last_name = "";
$existing_first_name = "";

function fetchUsers($connection) {
    $query = "SELECT * FROM `user`";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $users;
}

$users = fetchUsers($connection);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id_to_edit = mysqli_real_escape_string($connection, $_POST['id']);
    $select_query = "SELECT * FROM `user` WHERE id = '$id_to_edit'";
    $result = mysqli_query($connection, $select_query);
    if (!$result) {
        die("Select query failed: " . mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $existing_last_name = $row['last_name'];
        $existing_first_name = $row['first_name'];
    } else {
        echo "<script>alert('User with ID $id_to_edit does not exist.');</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user'])) {
    $id_to_update = mysqli_real_escape_string($connection, $_POST['id']);
    $new_last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $new_first_name = mysqli_real_escape_string($connection, $_POST['first_name']);

    $check_query = "SELECT * FROM `user` WHERE id = '$id_to_update'";
    $check_result = mysqli_query($connection, $check_query);
    if (!$check_result) {
        die("Check query failed: " . mysqli_error($connection));
    }
    $check_row = mysqli_fetch_assoc($check_result);
    if (!$check_row) {
        echo "<script>alert('User with ID $id_to_update does not exist.');</script>";
    } else {
        $update_query = "UPDATE `user` SET last_name = '$new_last_name', first_name = '$new_first_name' WHERE id = '$id_to_update'";
        $update_result = mysqli_query($connection, $update_query);

        if (!$update_result) {
            die("Update query failed: " . mysqli_error($connection));
        } else {
            echo "<script>alert('User with ID $id_to_update updated successfully.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin: 20px auto;
            width: 50%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>UPDATE USER</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['last_name']; ?></td>
                    <td><?php echo $user['first_name']; ?></td> 
                </tr>
                //here
            <?php endforeach; ?>
        </tbody>
    </table>

    <form method="post" action="update.php">
        <label for="id">Enter User ID to Update:</label>
        <input type="text" id="id" name="id" value="<?php echo $id_to_edit; ?>" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $existing_last_name; ?>" required>
        
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $existing_first_name; ?>" required>
        
        <input type="submit" name="update_user" value="Update User">
    </form>

    <br>
    <a href="home.php">Back to home page</a>
    
</body>
</html>
