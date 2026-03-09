<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/icons/favicon.ico" type="image/x-icon">
    <title>Login - Student Housing Platform</title>
</head>

<body>
    <div class="navbar">
        <a href="../../index.php"><img src="../assets/icons/sitelogo/logo.png" alt="Student Housing Platform Logo" class="logo"></a>
        <a href="../listings/listings.php">Listings</a>
        <a href="../auth/login.php">Login</a>
    </div>
    <div class="header">
        <p class="pagetitle">Login</p>
    </div>

    <div class="login_register">
        <h1>Sign in to your account</h1>
        <form action="login_handler.php" method="POST">
            <label for="username">Email:</label>
            <input type="email" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="error-message">'.htmlspecialchars($_GET['error']).'</div>';
        }
        ?>
        <?php
        if (isset($_GET['success'])) {
            echo '<div class="success-message">Registration successful. Please log in.</div>';
        }
        ?>
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>

</html>