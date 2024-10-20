<?php
    // session_start();
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // connect to the database
        $conn = mysqli_connect('localhost', 'root', '', 'blog');
        if (!$conn) {
           echo 'Connection error: ' . mysqli_connect_error();
         exit;
        }
        // escape the user inputs
        $email = mysqli_escape_string($conn, $_POST['email']);
        $password = hash('sha256', $_POST['password']);
        // select the user from the database
        $query = "SELECT * FROM `users` WHERE `email` = '".$email."' AND `password` = '".$password."' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if($row = mysqli_fetch_assoc($result)){
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            header('Location: /admin/users/list.php');
        } else {
            echo 'Invalid email or password';
        }
        // close connection
        mysqli_free_result($result);
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
    <?php if (isset($error)) echo $error; ?>
        <h1>Login</h1>
        <form method="post">
            <label for="email">Email:</label><br>
            <input type="email" name="email" placeholder="Email" value="<?= (isset($_POST['email'])) ? $_POST['email']:'' ?>"><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" placeholder="Password">
            <button type="submit" value="login">Login</button>
        </form>

