<?php

$db_host = '127.0.0.1';
$db_user = 'root';
$db_db = 'student_housing_platform';
$db_password = 'root';
$db_port = '8889';

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db, $db_port);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userId = $_SESSION["user_id"];

    $title = $_POST["title"];
    $location = $_POST["location"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    $roomType = $_POST["roomType"];
    $mealPlan = $_POST["mealPlan"];
    $campusType = $_POST["campusType"];
    $agreementMonths = $_POST["agreementMonths"];
    $availableFrom = $_POST["availableFrom"];
    $availableTo = $_POST["availableTo"];

    $userRole = strtolower($_SESSION["user_type"]);

    // price period logika
    if ($userRole === "student") {
        $pricePeriod = "term";
    } else {
        $pricePeriod = $_POST["pricePeriod"];
    }

    $stmt = $mysqli->prepare("
        INSERT INTO listings
        (UserId, Title, Location, Price, PricePeriod, RoomType, MealPlan, AgreementMonths, AvailableFrom, AvailableTo, CampusType, Description)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "issdsssissss",
        $userId,
        $title,
        $location,
        $price,
        $pricePeriod,
        $roomType,
        $mealPlan,
        $agreementMonths,
        $availableFrom,
        $availableTo,
        $campusType,
        $description
    );

    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    header("Location: listings.php");
    exit;
}