<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php?error=Invalid request");
    exit;
}
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.php?error=Missing credentials");
    exit;
}

$email = trim($_POST['username']);
$password = $_POST['password'];

if ($email === "" || $password === "") {
    header("Location: login.php?error=Missing credentials");
    exit;
}
$db_host = '127.0.0.1';
$db_user = 'root';
$db_db = 'student_housing_platform';
$db_password = 'root';
$db_port = '8889';

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db, $db_port);

if ($mysqli->connect_error) {
    header("Location: login.php?error=Database error");
    exit;
}
$stmt = $mysqli->prepare("SELECT UserId, FirstName, LastName, Email, PasswordHash, UserType FROM Users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt->close();
    $mysqli->close();
    header("Location: login.php?error=Invalid email or password");
    exit;
}

$user = $result->fetch_assoc();
if (!password_verify($password, $user['PasswordHash'])) {
    $stmt->close();
    $mysqli->close();
    header("Location: login.php?error=Invalid email or password");
    exit;
}
$_SESSION['user_id'] = $user['UserId'];
$_SESSION['first_name'] = $user['FirstName'];
$_SESSION['last_name'] = $user['LastName'];
$_SESSION['email'] = $user['Email'];
$_SESSION['user_type'] = $user['UserType'];

$stmt->close();
$mysqli->close();
header("Location: ../profile.php");
exit;

?>