<?php
require '../models/user.php';
session_start();

if (isset($_SESSION['id'])) {
    echo '<p> Welcome, ' . $_SESSION['email'] . ' <a href="/logout.php">Logout</a> </p>';
} else {
    header('Location: /login.php');
    exit;
}

$user = new user();
$users = $user->getUsers();

if (isset($_GET['search'])) {
    $users = $user->searchUsers($_GET['search']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin :: List Users</title>
</head>
<body>
<h1>List Users</h1>
<form method="get">
    <input type="text" name="search" placeholder="Search by name or email">
    <button type="submit" value="search">Search</button>
</form>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Avatar</th>
        <th>Admin</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $row): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td>
                <?php if (!empty($row['avatar'])): ?>
                    <img src="/uploads/<?= $row['avatar']; ?>" alt="Avatar" width="50" height="50">
                <?php else: ?>
                    No Avatar
                <?php endif; ?>
            </td>
            <td><?= $row['admin'] ? 'Yes' : 'No'; ?></td>
            <td><a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | <a href="delete.php?id=<?= $row['id'] ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3" style="text-align: center">Total Users: <?= count($users); ?></td>
        <td colspan="3" style="text-align: center"><a href="add.php">Add User</a></td>
    </tr>
    </tfoot>
</table>
</body>
</html>