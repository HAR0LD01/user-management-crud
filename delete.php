<!DOCTYPE html>
<html lang="en">
<?php include('prog.php'); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>DELETE USER</h1>

    <?php
    if (isset($_POST['delete'])) {
        $id_to_delete = $_POST['id'];
        $delete_query = "DELETE FROM user WHERE id = '$id_to_delete'";

        $delete_result = mysqli_query($connection, $delete_query);

        if (!$delete_result) {
            die("Delete query failed: " . mysqli_error($connection));
        } else {
            echo "<p>User with ID $id_to_delete deleted successfully.</p>";
        }

        header("Location: delete.php");
        exit();
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>LAST NAME</th>
                <th>FIRST NAME</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM user";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td><form method='post' action='delete.php'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' name='delete' value='Delete'>
                      </form></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="home.php">Back to Home Page</a>
</body>
</html>