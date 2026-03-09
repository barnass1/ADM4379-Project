<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.php?error=Invalid request");
    exit;
}
$required = ['firstname','lastname','email','password','usertype'];

foreach ($required as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
        header("Location: register.php?error=Missing required fields");
        exit;
    }
}
$firstName = trim($_POST['firstname']);
$lastName = trim($_POST['lastname']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$userType = $_POST['usertype'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: register.php?error=Invalid email format");
    exit;
}
$allowedTypes = ['Student','Landlord'];

if (!in_array($userType, $allowedTypes)) {
    header("Location: register.php?error=Invalid user type");
    exit;
}
$db_host = '127.0.0.1';
$db_user = 'root';
$db_db = 'student_housing_platform';
$db_password = 'root';
$db_port = '8889';

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db, $db_port);

if ($mysqli->connect_error) {
    header("Location: register.php?error=Database connection failed");
    exit;
}
$check = $mysqli->prepare("SELECT UserId FROM Users WHERE Email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $check->close();
    $mysqli->close();
    header("Location: register.php?error=Email already registered");
    exit;
}
$check->close();
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO Users (FirstName, LastName, Email, PasswordHash, UserType)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    $mysqli->close();
    header("Location: register.php?error=Database error");
    exit;
}

$stmt->bind_param("sssss", $firstName, $lastName, $email, $passwordHash, $userType);

if (!$stmt->execute()) {
    $stmt->close();
    $mysqli->close();
    header("Location: register.php?error=Registration failed");
    exit;
}

$stmt->close();
$mysqli->close();
header("Location: login.php?success=registered");
exit;
?>