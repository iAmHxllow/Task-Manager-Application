<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invite = $_POST['invite'];
    $canEdit = isset($_POST['can_edit']) ? (int) $_POST['can_edit'] : 0;
    $destinationPageId = 1; // Set to actual destination page ID
    $senderId = 1; // Set to actual sender's ID

    // Determine if the invite is an email or a username
    $recipientType = filter_var($invite, FILTER_VALIDATE_EMAIL) ? 'Email' : 'Username';

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

    // Prepare and bind invite statement
    $stmt = $conn->prepare("INSERT INTO Invite (DestinationPage_ID, Sender, Recipient, Sent) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisi", $destinationPageId, $senderId, $recipientType, $canEdit);

    // Execute the statement
    if ($stmt->execute()) {
        // Logic to link user with the collaboration page and set permissions
        $recipientUserId = getUserIdByInvite($invite, $conn);

        if ($recipientUserId !== null) {
            // Determine permission ID based on $canEdit value
            $permissionId = $canEdit ? 2 : 1; // 2 = 'Can Edit' and 1 = 'View Only'

            $linkStmt = $conn->prepare("INSERT INTO UserCollaborationLink (User_ID, CollabPage_ID, Permission_ID) VALUES (?, ?, ?)");
            $linkStmt->bind_param("iii", $recipientUserId, $destinationPageId, $permissionId);
            $linkStmt->execute();
            $linkStmt->close();
        } else {
            echo "Error: User not found.";
        }

        // Send invite email if the recipient is an email
        if ($recipientType === 'Email') {
            $collabPageUrl = "http://yourdomain.com/CollaborationPage.php?id=$destinationPageId";
            $subject = "You are invited to collaborate!";
            $message = "Hello, you have been invited to collaborate on a page. Click the link below to join:\n$collabPageUrl";
            $headers = "From: no-reply@yourdomain.com";

            if (mail($invite, $subject, $message, $headers)) {
                echo "Invite email sent successfully.";
            } else {
                echo "Failed to send invite email.";
            }
        }

        // Redirect to a confirmation page or back to the form
        header("Location: CollaborationPage.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

// Function to get user ID based on invite (email or username)
function getUserIdByInvite($invite, $conn) {
    // Initialize the variable to avoid unassigned variable error
    $userId = null;

    // Implement your logic to fetch user ID based on email or username
    // Example:
    $stmt = $conn->prepare("SELECT User_ID FROM Users WHERE Email = ? OR Username = ?");
    $stmt->bind_param("ss", $invite, $invite);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();

    return $userId;
}
?>
