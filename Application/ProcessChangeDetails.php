<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $passwordConfirm = $_POST['psw-confirm'];
    $userId = $_SESSION['user_id'];

    // Validate the input
    if (empty($username) || empty($email) || empty($password) || empty($passwordConfirm)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if ($password !== $passwordConfirm) {
        die("Passwords do not match.");
    }

    // Establishing database connection
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database = "tsm";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $database);

    // Checking connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind the update statement
    $stmt = $conn->prepare("UPDATE Users SET Username = ?, Email = ?, Password = ? WHERE User_ID = ?");
    $stmt->bind_param("sssi", $username, $email, $hashedPassword, $userId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Details updated successfully.";
        // Redirect to a confirmation page or back to the account page
        header("Location: AccountPage.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
