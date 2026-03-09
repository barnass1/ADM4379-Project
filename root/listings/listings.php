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
    <title>Listings - Student Housing Platform</title>
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
        <p class="pagetitle">Listings</p>
    </div>
    <?php

    if (isset($_SESSION['user_id'])) {
    ?>
        <div class="create-listing-banner">
            <span>Want to list your room or apartment?</span>
            <a href="../listings/create-listing.php" class="button">Create Listing</a>
        </div>
    <?php
    }
    ?>
    <div>
        <?php
        $db_host = '127.0.0.1';
        $db_user = 'root';
        $db_db = 'student_housing_platform';
        // MAMP
        $db_password = 'root';
        $db_port = '8889';
        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_db, $db_port);
        if ($mysqli->connect_error) {
            echo 'Errno: ' . $mysqli->connect_errno;
            echo '<br>';
            echo 'Error: ' . $mysqli->connect_error;
            exit();
        }
        ?>
        <?php
        $sql = "SELECT * FROM Listings ORDER BY CreatedAt DESC";
        $result = $mysqli->query($sql);
        ?>

        <table class="listings">

            <?php
            if ($result && $result->num_rows > 0) {

                $count = 0;

                echo "<tr>";

                while ($row = $result->fetch_assoc()) {

                    if ($count > 0 && $count % 3 == 0) {
                        echo "</tr><tr>";
                    }
            ?>

                    <td>

                        <a href="../listings/listing_details.php?id=<?php echo $row['ListingId']; ?>" class="listing">

                            <ul class="ul-listing">

                                <li class="listing-image">
                                    <?php

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
                                    ?>

                                    <img src="../assets/images/<?php echo $folder; ?>/<?php echo $prefix; ?>-first.jpg"
                                        alt="<?php echo $row['Title']; ?>">

                                </li>

                                <li><?php echo $row['Title']; ?></li>
                                <li><?php echo $row['CampusType']; ?></li>
                                <li><?php echo $row['Location']; ?></li>

                                <li>Room Type: <?php echo $row['RoomType']; ?></li>

                                <li>Mandatory Meal Plan: <?php echo $row['MealPlan']; ?></li>

                                <li>Agreement Length: <?php echo $row['AgreementMonths']; ?> months</li>

                                <li>$<?php echo $row['Price']; ?>/<?php echo $row['PricePeriod']; ?></li>

                                <li>Available from <?php echo $row['AvailableFrom']; ?></li>

                            </ul>

                        </a>

                    </td>

            <?php
                    $count++;
                }

                echo "</tr>";
            }
            ?>

        </table>
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