<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/icons/favicon.ico" type="image/x-icon">
    <title>Profile Settings - Student Housing Platform</title>
</head>

<body>
    <?php
    session_start();
    ?>
    <div class="navbar">
        <a href="../index.php"><img src="../root/assets/icons/sitelogo/logo.png" alt="Student Housing Platform Logo" class="logo"></a>
        <a href="listings/listings.php">Listings</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="profile.php">
                <?php echo htmlspecialchars($_SESSION['first_name'] . " " . $_SESSION['last_name']); ?>
            </a>
            <a href="auth/logout.php">Logout</a>
        <?php else: ?>
            <a href="auth/login.php">Login</a>
        <?php endif; ?>
    </div>
    <div class="header">
        <p class="pagetitle">Profile Settings</p>
    </div>
    <form action="profile-settings-handler.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <button type="submit">Update Settings</button>
    </form>
    <div class="footer">
        <table>
            <tr>
                <td><a href="auth/login.php">Sign in</a></td>
                <td><a href="https://uottawa.ca">University of Ottawa homepage</a></td>
            </tr>
            <tr>
                <td><a href="auth/register.php">Register</a></td>
                <td><a href="https://housing.uottawa.ca">Housing Portal</a></td>
            </tr>
            <tr>
                <td><a href="listings/listings.php">View Listings</a></td>
                <td><a href="https://www.uottawa.ca/campus-life/housing">Residence Information</a></td>
            </tr>
        </table>
        <p>&copy; 2026 Student Housing Platform. All rights reserved.</p>
    </div>
</body>

</html>