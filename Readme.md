# User Management System

This project is a simple User Management System built with PHP. It allows administrators to manage users, including adding, updating, deleting, and searching for users.

## Project Structure

- `admin/models/user.php`: Contains the `user` class which handles database operations related to users.
- `admin/users/list.php`: Displays a list of users and provides search functionality.
- `admin/models/database_config.php`: Contains the database configuration settings.

## Database Configuration

The database configuration is stored in `admin/models/database_config.php`:

```php
<?php
$config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'blog'
];
?>
```
### User Class
The `user` class extends `MysqlAdapter` and provides methods to interact with the `users` table in the database:  
- `getUsers()`: Retrieves all users.
- `getUser($user_id)`: Retrieves a user by ID.
- `addUser($user_data)`: Adds a new user.
- `updateUser($user_data, $user_id)`: Updates an existing user.
- `deleteUser($user_id)`: Deletes a user by ID.
- `searchUsers($keyword)`: Searches for users by name or email.
### List Users Page
The `admin/users/list.php` file displays a list of users and includes a search form:  
- Displays a welcome message if the user is logged in.
- Redirects to the login page if the user is not logged in.
- Lists all users or search results in a table.
- Provides links to edit or delete each user.
- Includes a form to search users by name or email.
### Usage
1. Setup Database Configuration: Update the database configuration in admin/models/database_config.php with your database credentials.
2. Run the Application: Access the admin/users/list.php page in your browser to manage users.
### Example
To list all users, navigate to `admin/users/list.php`. To search for users, use the search form on the same page.
```html
<form method="get">
    <input type="text" name="search" placeholder="Search by name or email">
    <button type="submit" value="search">Search</button>
</form>
```
This project is a basic example of user management in PHP and can be extended with additional features as needed.
### Certificate
This project was created as part of a course on PHP basics. A certificate of completion is available upon request
1. or simply visit the following URL: [Certificate URL](https://maharatech.gov.eg/mod/customcert/verify_certificate.php)
2. and enter the course code: `NjMHQrzrqY`.
### Course URL
For more information about the course, visit the following URL: [Course URL](https://maharatech.gov.eg/course/view.php?id=21)