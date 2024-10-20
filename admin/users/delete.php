<?php
//connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'blog');
//check connection
if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
}
//select the user from the database
//delete.php?id=1 => $_GET['id'] = 1
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$query = "DELETE FROM `users` WHERE `users`.`id` =" . $id. " LIMIT 1";
if(mysqli_query($conn, $query)) {
    header('Location: list.php');
}   else {
    echo 'Query error: ' . mysqli_error($conn);
}
//close connection
mysqli_close($conn);
