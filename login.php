<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user"] = $row["name"];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password! <a href='login.html'>Try again</a>";
        }
    } else {
        echo "User not found! <a href='index.html'>Register here</a>";
    }

    $stmt->close();
    $conn->close();
}
?>
