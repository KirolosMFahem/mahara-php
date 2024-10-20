<?php
//check for errors
$errors_arr = array();
if (isset($_GET['error_fields'])) {
    $errors_arr = explode(',', $_GET['error_fields']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <body>
        <form method="post" action="process_db.php">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"><?php if (in_array('name', $errors_arr)) echo "* Please enter your Name"?><br>
            <label for="email">Email</label>
            <input type="email" name="email" id="email"><?php if (in_array('name', $errors_arr)) echo "* Please enter a valid Email"?><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password"><?php if (in_array('name', $errors_arr)) echo "* Please enter a Password not less that 8 characters"?><br>
            <label for="gender">Gender</label><br>
            <label>
                <input type="radio" name="gender" value="male">
            </label>Male
            <label>
                <input type="radio" name="gender" value="female">
            </label>Female
            <input type="submit" name="submit" value="Register">
        </form>
    </body>
</html>