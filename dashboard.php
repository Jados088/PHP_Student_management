<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <a href="add.php">Add Student</a><br>
    <a href="view.php">View Students</a><br>
    <a href="logout.php">Logout</a><br>

</body>
</html>
