<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/icons/favicon.ico" type="image/x-icon">
    <title>Single room on the 2nd floor</title>
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
    <div class="header">
        <p class="pagetitle">Property Details</p>
    </div>
    <?php

    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_db = 'student_housing_platform';
    $db_password = 'root';
    $db_port = '8889';

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_db, $db_port);

    if ($mysqli->connect_error) {
        die("Connection failed");
    }

    $id = $_GET['id'];

    $sql = "SELECT Listings.*, Users.Email
        FROM Listings
        JOIN Users ON Listings.UserId = Users.UserId
        WHERE Listings.ListingId = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: ../error.php");
        exit();
    }

    $locationMap = [
        "Marchand Residence" => "mrd",
        "Thompson Residence" => "thn",
        "Leblanc Residence" => "lbc",
        "Henderson Residence" => "hsy",
        "Annex" => "anx",
        "90 University Residence" => "ninety-u"
    ];

    $prefix = $locationMap[$row['Location']] ?? "default";

    $type = "single";
    if (stripos($row['RoomType'], "double") !== false) {
        $type = "double";
    }

    $folder = $prefix . "-" . $type;

    if ($prefix == "ninety-u") {
        $folder = $prefix;
    }

    $imagePath = "../assets/images/$folder/";
    $images = glob($imagePath . "*.{jpg,jpeg,png}", GLOB_BRACE);

    ?>

    <table class="property-details">

        <tr>

            <td class="details-text">

                <a href="listings.php" class="button">Back to listings</a>

                <h2><?php echo $row['Title']; ?></h2>

                <p>Location: <?php echo $row['Location']; ?></p>

                <p>
                    $<?php echo $row['Price']; ?>/<?php echo $row['PricePeriod']; ?>
                    + <?php echo $row['MealPlan']; ?> Meal Plan
                </p>

                <p>Type: <?php echo $row['RoomType']; ?></p>

                <p>Meal Plan: <?php echo $row['MealPlan']; ?></p>

                <p>Agreement: <?php echo $row['AgreementMonths']; ?> months</p>

                <p>Available: <?php echo $row['AvailableFrom']; ?></p>

            </td>

            <td class="details-image">

                <div class="image-carousel">

                    <?php
                    $i = 1;

                    foreach ($images as $img) {
                    ?>

                        <input type="radio"
                            id="slide<?php echo $i; ?>"
                            name="carousel<?php echo $id; ?>"
                            <?php if ($i == 1) echo "checked"; ?>>

                        <div class="carousel-slide slide<?php echo $i; ?>">
                            <img src="<?php echo $img; ?>" alt="<?php echo $row['Title']; ?>">
                        </div>

                    <?php
                        $i++;
                    }
                    ?>

                    <div class="carousel-dots">

                        <?php
                        for ($j = 1; $j <= count($images); $j++) {
                        ?>
                            <label for="slide<?php echo $j; ?>"></label>
                        <?php
                        }
                        ?>

                    </div>

                </div>

            </td>

        </tr>

        <tr>

            <td colspan="2">

                <p><?php echo $row['Description']; ?></p>

            </td>

        </tr>

    </table>

    <div class="contact-section">
        <span>Are you interested in this property?</span><br>

        <a href="mailto:<?php echo $row['Email']; ?>" class="button">
            Contact here
        </a>
    </div>
    <div class="footer">
        <table>
            <tr>
                <td><a href="../auth/login.php">Sign in</a></td>
                <td><a href="https://uottawa.ca">University of Ottawa homepage</a></td>
            </tr>
            <tr>
                <td><a href="../auth/register.php">Register</a></td>
                <td><a href="https://housing.uottawa.ca">Housing Portal</a></td>
            </tr>
            <tr>
                <td><a href="listings.php">View Listings</a></td>
                <td><a href="https://www.uottawa.ca/campus-life/housing">Residence Information</a></td>
            </tr>
        </table>
        <p>&copy; 2026 Student Housing Platform. All rights reserved.</p>
    </div>

</body>

</html>