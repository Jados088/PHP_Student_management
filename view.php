<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <link rel="stylesheet" type="text/css" href="css/view.css">
</head>
<body>
    <h1>Students Information</h1>
    <table border="1">
        <tr>
            <th>NO</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Department</th>
            <th>Gender</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
            <td><?php echo htmlspecialchars($row['department']); ?></td>
            <td><?php echo htmlspecialchars($row['gender']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo urlencode($row['id']); ?>">Edit</a>
                <a href="delete.php?id=<?php echo urlencode($row['id']); ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="dashboard.php">Back</a>
</body>
</html>
