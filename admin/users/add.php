<?php
$error_fields = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the form
    if (!isset($_POST['name']) || empty($_POST['name'])) {
        $error_fields[] = 'name';
    }
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $error_fields[] = 'email';
    }
    if (!isset($_POST['password']) || strlen($_POST['password']) < 8) {
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
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = hash('sha256', $_POST['password']);
        $admin = isset($_POST['admin']) ? 1 : 0;

        // Upload the avatar
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        $avatar = '';
        if ($_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
            $temp_name = $_FILES['avatar']['tmp_name'];
            $avatar = basename($_FILES['avatar']['name']);
            move_uploaded_file($temp_name, $upload_dir . $name . $avatar);
        } else {
            echo 'Error uploading file';
            exit;
        }
        // Insert the user into the database
        $query = "INSERT INTO `users` (`name`, `email`, `password`, `admin`) VALUES ('$name', '$email', '$password', '$admin')";
        if (mysqli_query($conn, $query)) {
            header('Location: list.php');
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin :: Add User</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <label for="name">Name:</label><br>
    <input type="text" name="name" id="name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : ''; ?>"><br>
    <?php if (in_array('name', $error_fields)) {
        echo '<p style="color: red">Name is required</p>';
    } ?>
    <label for="email">Email:</label><br>
    <input type="email" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>"><br>
    <?php if (in_array('email', $error_fields)) {
        echo '<p style="color: red">Email is required</p>';
    } ?>
    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password"><br>
    <?php if (in_array('password', $error_fields)) {
        echo '<p style="color: red">Password is required and must be at least 8 characters</p>';
    } ?>
    <label for="avatar">Avatar:</label><br>
    <input type="file" name="avatar" id="avatar"><br>
    <input type="checkbox" name="admin" id="admin" <?= isset($_POST['admin']) ? 'checked' : ''; ?>>
    <label for="admin">Admin</label><br>
    <input type="submit" value="Add User">
</form>
</body>
</html>