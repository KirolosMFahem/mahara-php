<?php
//validation
$error_fields = array();
if(! (isset($_POST['name']) && !empty($_POST['name']))){
    $error_fields[] = 'name';
}
if(! (isset($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))){
    $error_fields[] = 'email';
}
if(! (isset($_POST['password']) && strlen($_POST['password']) > 7)){
    $error_fields[] = 'password';
}
if($error_fields){
    header('Location: form.php?error_fields='.implode(',', $error_fields));
    exit;
}

//db connection
$conn = mysqli_connect("localhost", "root", "", "blog");
if (!$conn) {
    echo mysqli_connect_error();
    exit;
}

//escaping any special characters to prevent sql injection
$name = mysqli_escape_string($conn, $_POST['name']);
$email = mysqli_escape_string($conn, $_POST['email']);

//inserting data
$password = sha1($_POST['password']);
$query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('".$name."', '".$email."', '".$password."')";
if(mysqli_query($conn, $query)) {
    echo "Thank you! your data has been saved";
} else {
    echo $query;
    echo mysqli_error($conn);
}

// close connection
mysqli_close($conn);