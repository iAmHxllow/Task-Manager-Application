<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}
?>

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
                    <button id="open-and-close-sidebar"><img src="./Assets/arrow-back.svg" alt="icon" height="30"
                            width="20" /></button>
                    <div class="Personalpage-icon">
                        <a href="HomePage.php"> <img src="Assets/Personal Page Icon.webp" alt="Personal Page Logo"
                                height="100%" width="100%">
                        </a>
                    </div>
                    <div class="Collabpage-icon">
                        <a href="CollaborationPage.php"> <img src="Assets/Group Collab Icon.webp"
                                alt="Collaboration Page Logo" height="100%" width="100%"> </a>
                    </div>
                    <div class="Exitpage-icon">
                        <a href="ProcessLogout.php"> <img src="Assets/Exit Page Icon.webp" alt="Exit Page Logo"
                                height="100%" width="100%"> </a>
                    </div>
                </div>
            </nav>
        </sidebar>

        <main class="tsm-main">
            <div class="logo-and-settings">
                <div class="TSM-icon">
                    <img src="Assets/TaskMainPageLogo.webp" alt="Task Manager Icon" height="100%" width="100%">
                </div>
                <div class="Settings-icon">
                    <a href="SettingsPage.html">
                        <img src="Assets/Settings Gear Icon.webp" alt="Settings Icon" height="100%" width="100%">
                    </a>
                </div>
            </div>
        </main>
    </div>
    <script src="./Scripts/Index.js"></script>
</body>

</html>
