<?php
//db connection
$conn = mysqli_connect("localhost", "root", "", "blog");
if (!$conn) {
    echo mysqli_connect_error();
    exit;
}
// operation
$query = "SELECT * FROM `users`";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo "ID: ".$row['id']."<br>";
    echo "Name ".$row['name']."<br>";
    echo "Email ".$row['email']."<br>";
    echo "Password ".$row['password']."<br>";
    echo  str_repeat("_", 50)."<br><br>";
}
// close connection
mysqli_free_result($result);
mysqli_close($conn);