<?php
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
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['psw'];
$password_repeat = $_POST['psw-repeat'];

// Checking if passwords match
if ($password !== $password_repeat) {
    header("Location: SignUpPage.php?error=password_mismatch");
    exit();
}

// Checking if username already exists
$query_username = "SELECT * FROM users WHERE Username = '$username'";
$result_username = $conn->query($query_username);

if ($result_username === false) {
    echo "Error: " . $query_username . "<br>" . $conn->error;
    exit();
}

if ($result_username->num_rows > 0) {
    header("Location: SignUpPage.php?error=username_exists");
    exit();
}

// Validating email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: SignUpPage.php?error=invalid_email");
    exit();
}

// Checking if email already exists
$query_email = "SELECT * FROM users WHERE Email = '$email'";
$result_email = $conn->query($query_email);

if ($result_email === false) {
    echo "Error: " . $query_email . "<br>" . $conn->error;
    exit();
}

if ($result_email->num_rows > 0) {
    header("Location: SignUpPage.php?error=email_exists");
    exit();
}

// Hashing the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Inserting new user data into the database
$insert_query = "INSERT INTO users (Username, Email, Password, Role) VALUES ('$username', '$email', '$hashed_password', 'Registered User')";

if ($conn->query($insert_query) === TRUE) {
    header("Location: HomePage.html");
    exit();
} else {
    echo "Error: " . $insert_query . "<br>" . $conn->error;
}

$conn->close();
?>