<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asa_overseas";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

$message = "";
$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"] ?? "";
    $email = $_POST["email"] ?? "";
    $mobile = $_POST["mobile"] ?? "";
    $city = $_POST["city"] ?? "";
    $destination = $_POST["destination"] ?? "";
    $office = $_POST["office"] ?? "";
    $coaching = $_POST["coaching"] ?? "";
    $loan = $_POST["loan"] ?? "";
    $user_captcha = $_POST["captcha"] ?? "";
    $terms = isset($_POST["terms"]) ? 1 : 0;

    // CAPTCHA validation
    if (!isset($_SESSION["captcha"]) || strtolower($user_captcha) !== strtolower($_SESSION["captcha"])) {
        $response = ["status" => "error", "message" => "Invalid CAPTCHA. Please try again."];
    } elseif (empty($fullname) || empty($email) || empty($mobile)) {
        $response = ["status" => "error", "message" => "Please fill all required fields."];
    } else {
        $stmt = $conn->prepare("INSERT INTO enquiries (fullname, email, mobile, city, destination, office, coaching, loan, captcha, terms) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssi", $fullname, $email, $mobile, $city, $destination, $office, $coaching, $loan, $user_captcha, $terms);

        if ($stmt->execute()) {
            $response = ["status" => "success", "message" => "Enquiry submitted successfully!"];
        } else {
            $response = ["status" => "error", "message" => "Error: " . $stmt->error];
        }

        $stmt->close();
    }

    unset($_SESSION["captcha"]);
}

$conn->close();
echo json_encode($response);
exit();
?>
