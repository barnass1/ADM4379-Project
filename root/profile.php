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
    <title>Profile - Student Housing Platform</title>
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
        <p class="pagetitle">Profile</p>
    </div>
    <div class="profile-details">
<?php
$db_host = '127.0.0.1';
$db_user = 'root';
$db_db = 'student_housing_platform';

// MAMP
$db_password = 'root';
$db_port = '8889';

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db, $db_port);

if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['user_type'] ?? 'user';

if ($role === 'Admin') {
    $sql = "SELECT * FROM listings";
    $stmt = $mysqli->prepare($sql);
}

else {
    $sql = "SELECT * FROM listings WHERE UserId = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<?php if ($role === 'Admin'): ?>
<p id="admin-title">ADMINISTRATOR</p>
<?php endif; ?>

<p>
Welcome <?php echo htmlspecialchars($_SESSION['first_name'] . " " . $_SESSION['last_name']); ?>!
</p>
<div class="profile-buttons">
    <a class="button" href="edit-profile.php">Edit Profile Settings</a>
</div>
<h2>My listings</h2>

<ul>
<?php
if ($result->num_rows > 0) {

    while ($listing = $result->fetch_assoc()) {

        $title = $listing['Title'] ?? 'Untitled listing';
        $id = $listing['ListingId'] ?? 0;

        echo "<li>";
        echo htmlspecialchars($title);
        echo '<a class="button" href="listings/manage-listings.php?id='.$id.'">Details</a>';
        echo "</li>";
    }

} else {
    echo "<li>No listings found. <a class=\"button\" href=\"listings/create-listing.php\">Create Listing</a></li>";
}
?>
</ul>

<div class="profile-buttons">
    <a class="button" href="delete-profile.php">Delete Profile</a>
</div>

</div>
    

    
</body>

</html>