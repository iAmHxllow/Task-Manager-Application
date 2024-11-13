<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newAdminId = $_POST['admin'];
    $collabPageId = 1; // Set to the actual collaboration page ID

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

    // Disable foreign key checks
    $conn->query("SET FOREIGN_KEY_CHECKS=0");

    // Update the collaboration page with the new admin
    $stmt = $conn->prepare("UPDATE CollabPage SET Host = ? WHERE CollabPage_ID = ?");
    $stmt->bind_param("ii", $newAdminId, $collabPageId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Admin transfer successful.";
        // Redirect to a confirmation page or back to the form
        header("Location: CollaborationPage.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Re-enable foreign key checks
    $conn->query("SET FOREIGN_KEY_CHECKS=1");

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>