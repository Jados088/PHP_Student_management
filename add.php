<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $department = $_POST['department'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO students (first_name, last_name, email, date_of_birth, department, gender) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $date_of_birth, $department, $gender);

    if ($stmt->execute()) {
        echo "Student added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" type="text/css" href="css/add.css">
</head>
<body>
    <form method="POST" action="">
        <label>First Name:</label>
        <input type="text" name="first_name" required>
        <label>Last Name:</label>
        <input type="text" name="last_name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Date of Birth:</label>
        <input type="date" name="date_of_birth" required>
        <label>Department:</label>
        <input type="text" name="department" required>
        <label>Gender:</label>
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <button type="submit">Add Student</button>
        <a href="view.php" class="button">View students</a>
        <a href="dashboard.php" class="button">Back</a>
        
    </form>
</body>
</html>
