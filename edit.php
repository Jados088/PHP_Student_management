<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $department = $_POST['department'];
    $gender = $_POST['gender'];

    $sql = "UPDATE students SET first_name = ?, last_name = ?, email = ?, date_of_birth = ?, department = ?, gender = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $first_name, $last_name, $email, $date_of_birth, $department, $gender, $id);

    if ($stmt->execute()) {
        echo "<p class='alert success'>Student updated successfully</p>";
    } else {
        echo "<p class='alert error'>Error: " . $stmt->error . "</p>";
    }
header("location: view.php");
    $stmt->close();
} else {
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
   
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" type="text/css" href="css/update.css">
</head>
<body>
    <form method="POST" action="">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
        
        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
        
        <label>Date of Birth:</label>
        <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($student['date_of_birth']); ?>" required>
        
        <label>Department:</label>
        <input type="text" name="department" value="<?php echo htmlspecialchars($student['department']); ?>" required>
        
        <label>Gender:</label>
        <select name="gender" required>
            <option value="Male" <?php echo $student['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo $student['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
            <option value="Other" <?php echo $student['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
        </select>
        
        <button type="submit">Update Student</button>
        <a href="view.php" class="black-link">Back to list</a>
    </form>
</body>
</html>
