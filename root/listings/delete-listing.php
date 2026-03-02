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
    <title>Delete Listing - Student Housing Platform</title>
</head>

<body>
    <div class="navbar">
        <a href="../../index.php"><img src="../assets/icons/sitelogo/logo.png" alt="Student Housing Platform Logo" class="logo"></a>
        <a href="../listings/listings.php">Listings</a>
        <a href="../auth/login.php">Login</a>
    </div>
    <h1>Delete Listing</h1>
    <form action="delete-handler.php" method="post">
        <p>Are you sure you want to delete the listing "Cozy apartment near campus"?</p>
        <button type="submit">Yes, Delete Listing</button>
        <a href="manage-listings.php">Cancel</a>
    </form>
</body>

</html>