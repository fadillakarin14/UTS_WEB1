<?php
require "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$name = $data["name"] ?? "";
$email = $data["email"] ?? "";
$password = $data["password"] ?? "";

if (!$name || !$email || !$password) {
    echo json_encode(["status" => "error", "message" => "Incomplete input"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email"]);
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hash);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "User registered"]);
} else {
    echo json_encode(["status" => "error", "message" => "Email already exists"]);
}
