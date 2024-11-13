<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Task Manager</title>
    <link rel="icon" type="image/webp" href="Assets/TSM-Favicon.webp" />
    <link rel="stylesheet" href="CSS/Style.css" />
</head>

<body class="LSP-body">
    <div class="LSP-main-container">
        <div class="SignUp-container">
            <form action="ProcessSignUp.php" method="post">
                <div class="signup-info-container">
                    <h1>Sign Up</h1>
                    <p>Please fill in this form to create an account.</p>
                    <hr>

                    <label for="username"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" required>

                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>

                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

                    <p id="t-p-text">By creating an account you agree to our <a href="Terms&PrivacyPage.html">Terms &
                            Privacy</a>.</p>

                    <div class="clearfix">
                        <button type="submit" class="signupbtn">Sign Up</button>
                        <a href="LoginPage.php">
                            <button type="button" class="cancelbtn">Cancel</button></a>
                    </div>
                </div>
            </form>

            <!-- Displaying error messages -->
            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if ($error === 'password_mismatch') {
                    echo '<p style="color: red;">Passwords do not match. Please try again.</p>';
                } elseif ($error === 'username_exists') {
                    echo '<p style="color: red;">Username already exists. Please choose a different one.</p>';
                } elseif ($error === 'email_exists') {
                    echo '<p style="color: red;">Email already exists. Please use a different one.</p>';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>