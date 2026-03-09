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
    <title>New Listing - Student Housing Platform</title>
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
        <p class="pagetitle">Create New Listing</p>
    </div>
    <div class="create-listing">
        <h1>Create New Listing</h1>
        <?php
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../auth/login.php");
            exit();
        }
        ?>

        <form action="create-handler.php" method="POST">

            <label>Title</label>
            <input type="text" name="title" required>

            <label>Location</label>

            <?php if ($_SESSION['user_type'] == "Student") { ?>

                <select name="location" required>

                    <option value="45 Mann Residence">45 Mann Residence</option>
                    <option value="90 University Residence">90 University Residence</option>
                    <option value="Annex">Annex</option>
                    <option value="Friel Residence">Friel Residence</option>
                    <option value="Henderson Residence">Henderson Residence</option>
                    <option value="Hyman Soloway">Hyman Soloway</option>
                    <option value="Leblanc Residence">Leblanc Residence</option>
                    <option value="Marchand Residence">Marchand Residence</option>
                    <option value="Rideau Residence">Rideau Residence</option>
                    <option value="Stanton Residence">Stanton Residence</option>
                    <option value="Thompson Residence">Thompson Residence</option>

                </select>

            <?php } else { ?>

                <input type="text" name="location" placeholder="Enter property address or location" required>

            <?php } ?>

            <label>Campus Type</label>

            <?php if ($_SESSION['user_type'] == "Student") { ?>

                <input type="hidden" name="campusType" value="On Campus">
                <p>On Campus</p>

            <?php } elseif ($_SESSION['user_type'] == "Landlord") { ?>

                <input type="hidden" name="campusType" value="Off Campus">
                <p>Off Campus</p>

            <?php } ?>

            <label>Price</label>
            <input type="number" step="0.01" name="price" required>

            <?php if ($_SESSION['user_type'] == "Student"): ?>
                <label>Price Period</label>
                <input type="hidden" name="pricePeriod" value="term">
                <p>Term (student listing)</p>
            <?php else: ?>
                <label>Price Period</label>
                <select name="pricePeriod">
                    <option value="month">Month</option>
                    <option value="term">Term</option>
                </select>
            <?php endif; ?>

            <?php if ($_SESSION['user_type'] == "Student") { ?>

                <label>Room Type</label>
                <select name="roomType" required>
                    <option value="Traditional">Traditional</option>
                    <option value="Traditional Plus">Traditional Plus</option>
                    <option value="Suite">Suite</option>
                    <option value="Studio">Studio</option>
                    <option value="Apartment">Apartment</option>
                </select>

                <label>Meal Plan</label>
                <select name="mealPlan">
                    <option value="5 Day">5 Day</option>
                    <option value="7 Day">7 Day</option>
                    <option value="No Meal Plan">No Meal Plan</option>
                </select>

            <?php } elseif ($_SESSION['user_type'] == "Landlord") { ?>

                <label>Room Type</label>
                <input type="text" name="roomType" placeholder="e.g. Basement room, private room">

                <input type="hidden" name="mealPlan" value="No Meal Plan">

                <label>Meal Plan</label>
                <p>No meal plan</p>

            <?php } ?>

            <label>Agreement Months</label>
            <input type="number" name="agreementMonths">

            <label>Available From</label>
            <input type="date" name="availableFrom">

            <label>Available To</label>
            <input type="date" name="availableTo">

            <label>Description</label>
            <textarea name="description"></textarea>

            <button type="submit" class="button">Create Listing</button>

        </form>
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