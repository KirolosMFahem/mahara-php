<?php
$error_fields = array();
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'blog');
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
    exit;
}
// select the user from the database
//edit.php?id=1 => $_GET['id'] = 1
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$select = "SELECT * FROM `users` WHERE `users`.`id` = $id LIMIT 1";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the form
    if (!isset($_POST['name']) || empty($_POST['name'])) {
        $error_fields[] = 'name';
    }
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $error_fields[] = 'email';
    }
    if (isset($_POST['password']) && !empty($_POST['password']) && strlen($_POST['password']) < 8) {
        $error_fields[] = 'password';
    }
    if (!$error_fields) {
        // Connect to the database
        $conn = mysqli_connect('localhost', 'root', '', 'blog');
        // Check connection
        if (!$conn) {
            echo 'Connection error: ' . mysqli_connect_error();
        }

        // Escape the user inputs
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = hash('sha256', $_POST['password']);
        $admin = isset($_POST['admin']) ? 1 : 0;

        // Insert the user into the database
        $query = "UPDATE `users` SET `name` = '".$name."', `email` = '".$email."', `password` = '".$password."', `admin` = ' .$admin. ' WHERE `id` = ".$id;
        if (mysqli_query($conn, $query)) {
            header('Location: list.php');
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    }
}
// Close connection
mysqli_free_result($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin :: Add User</title>
</head>
<body>
<form method="post">
    <label for="name">Name:</label><br>
    <input type="text" name="name" id="name" value="<?= (isset($row['name'])) ? $row['name'] : ''; ?>"><br>
    <?php if (in_array('name', $error_fields)) {
        echo '<p style="color: red">Name is required</p>';
    } ?>
    <input type="hidden" name="id" id="id" value="<?= (isset($row['id'])) ? $row['id']:''?>">
    <label for="email">Email:</label><br>
    <input type="email" name="email" id="email" value="<?= isset($row['email']) ? $row['email'] : ''; ?>"><br>
    <?php if (in_array('email', $error_fields)) {
        echo '<p style="color: red">Email is required</p>';
    } ?>
    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password"><br>
    <?php if (in_array('password', $error_fields)) {
        echo '<p style="color: red">Password is required and must be at least 8 characters</p>';
    } ?>
    <input type="checkbox" name="admin" id="admin" <?= $row['admin'] ? 'checked' : ''; ?>>
    <label for="admin">Admin</label><br>
    <input type="submit" value="Update User">
</form>
</body>
</html>