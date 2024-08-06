<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
        // Ensure $password and $row['username'] are defined before this code
        $userinfo = [
            "username" => $username,
            "password" => $password
        ];

       
        setcookie("userinf", serialize($userinfo), time() + 60*60, "/", "", true, true);

            
            header("Location: dashboard.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<form method="POST" action=""> <!-- Change action as needed -->

    <?php
    $usernamevalue = "";
    $passwordvalue = ""; // Consider removing this as we won't pre-fill the password

    if (isset($_COOKIE['userinf'])) {
        $userinfo = unserialize($_COOKIE['userinf']);
        $usernamevalue = htmlspecialchars($userinfo['username']);
        $passwordvalue = htmlspecialchars($userinfo['password']);
    }
    ?>

    <link rel="stylesheet" type="text/css" href="css/userform.css">
    <h1>Login</h1>
    <label>Username:</label>
    <input type="text" name="username" value="<?php echo $usernamevalue; ?>" required>
    <label>Password:</label>
    <input type="password" name="password" value="<?php echo $passwordvalue; ?>" required> <!-- Remove pre-filled value -->
    <button type="submit">Login</button><br>
    Don't you have an account? 
    <a href="register.php">Signup</a>

</form>

</body>
</html>
