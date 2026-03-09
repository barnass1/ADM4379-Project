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
    <title>Edit Listing - Student Housing Platform</title>
</head>

<body>
    <?php
        session_start();
    ?>
    <div class="navbar">
        <a href="../../index.php"><img src="../assets/icons/sitelogo/logo.png" alt="Student Housing Platform Logo" class="logo"></a>
        <a href="../listings/listings.php">Listings</a>
        <?php if (isset($_SESSION['user_id'])): ?>
        <a href="../profile.php">
            <?php echo htmlspecialchars($_SESSION['first_name'] . " " . $_SESSION['last_name']); ?>
        </a>
        <a href="../auth/logout.php">Logout</a>
        <?php else: ?>
        <a href="../auth/login.php">Login</a>
        <?php endif; ?>
    </div>
    <h1>Edit Listing</h1>
    <form action="edit-handler.php" method="post">
        <label for="title">Listing Title:</label>
        <input type="text" id="title" name="title" value="Cozy apartment near campus" required><br><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required>A comfortable and affordable apartment located just minutes from campus. Perfect for students looking for convenience and community.</textarea><br><br>
        <label for="price">Price per Month:</label>
        <input type="number" id="price" name="price" value="800" required><br><br>
        <button type="submit">Update Listing</button>
    </form>
    
</body>

</html>