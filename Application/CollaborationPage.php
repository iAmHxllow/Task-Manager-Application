
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Task Manager</title>
    <link rel="icon" type="image/webp" href="Assets/TSM-Favicon.webp" />
    <link rel="stylesheet" href="CSS/Style.css" />
</head>
<body>
    <div class="main-container">
        <sidebar>
            <nav>
                <div class="flex-container">
                    <button id="open-and-close-sidebar"><img src="./Assets/arrow-back.svg" alt="icon" height="30" width="20" /></button>
                    <div class="Personalpage-icon">
                        <a href="HomePage.php"> <img src="Assets/Personal Page Icon.webp" alt="Personal Page Logo" height="100%" width="100%"></a>
                    </div>
                    <div class="Collabpage-icon">
                        <a href="CollaborationPage.php"> <img src="Assets/Group Collab Icon.webp" alt="Collaboration Page Logo" height="100%" width="100%"> </a>
                    </div>
                    <div class="Exitpage-icon">
                        <a href="ProcessLogout.php"> <img src="Assets/Exit Page Icon.webp" alt="Exit Page Logo" height="100%" width="100%"> </a>
                    </div>
                </div>
            </nav>
        </sidebar>
        <main class="tsm-main">
            <div>
                <div class="logo-and-settings">
                    <div class="TSM-icon">
                        <img src="Assets/Collaboration Logo.webp" alt="Task Manager Icon">
                    </div>
                    <div class="Settings-icon">
                        <a href="SettingsPage.html">
                            <img src="Assets/Settings Gear Icon.webp" alt="Settings Icon">
                        </a>
                    </div>
                    <div class="Share-icon" id="share-icon">
                        <img src="Assets/Share Icon.webp" alt="Share Icon">
                    </div>
                </div>
                <div class="share-container" id="share-container">
                    <div>
                        <h3>Share</h3>
                    </div>
                    <div>
                        <form action="ProcessInvite.php" method="post">
                            <input type="text" id="invite" name="invite" placeholder="Add Usernames or emails..."><br>
                            <input type="hidden" name="can_edit" id="can_edit" value="0">
                            <input type="submit" value="Invite">
                        </form>
                    </div>
                    <div class="permissions-container">
                        <h3>Permissions</h3>
                        <div class="switch-container">
                            <p id="can-edit-text">Can Edit</p>
                            <label class="switch">
                                <input type="checkbox" id="can_edit_checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <form action="ProcessTransfer.php" method="post">
                            <label for="admin" id="transfer-admin-text">Transfer Admin</label>
                            <select id="admin" name="admin">
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

                                // Fetch users from the database
                                $result = $conn->query("SELECT User_ID, Username FROM Users");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['User_ID'] . "'>" . $row['Username'] . "</option>";
                                }

                                // Close the connection
                                $conn->close();
                                ?>
                            </select>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
        </main>
    </div>
    <script src="./Scripts/Index.js"></script>
</body>
</html>
