<?php
// Start session
session_start();

// Establishing database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "tsm";

$conn = new mysqli($servername, $username, $password, $database);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving form data
$input = $_POST['uname'];
$password = $_POST['psw'];

// Checking if the input contains '@', indicating an email
if (strpos($input, '@') !== false) {
    $email = $input;
    $query = "SELECT * FROM users WHERE Email = '$email'";
} else {
    $username = $input;
    $query = "SELECT * FROM users WHERE Username = '$username'";
}

// Queried database for user authentication
$result = $conn->query($query);

if ($result === false) {
    echo "Query Error: " . $conn->error;
    exit();
}

if ($result->num_rows == 1) {
    // User found, verify password
    $user = $result->fetch_assoc();
    $hashed_password = $user['Password'];
    if (password_verify($password, $hashed_password)) {
        // if Passwords match, authentication successful
        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['username'] = $user['Username'];
        $_SESSION['role'] = $user['Role'];
        $_SESSION['admin'] = $user['Admin'];
        
        header("Location: HomePage.php");
        exit();
    } else {
        // if Passwords don't match, authentication failed
        header("Location: LoginPage.php?error=invalid_credentials");
        exit();
    }
} else {
    // if User not found, authentication failed
    header("Location: LoginPage.php?error=invalid_credentials");
    exit();
}

$conn->close();
?>
