<?php
require "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$email = $data["email"] ?? "";
$password = $data["password"] ?? "";

$stmt = $mysqli->prepare("SELECT id, name, password FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Account not found"]);
    exit;
}

$u = $res->fetch_assoc();

if (!password_verify($password, $u["password"])) {
    echo json_encode(["status" => "error", "message" => "Wrong password"]);
    exit;
}

echo json_encode([
    "status" => "success",
    "message" => "Login success",
    "user" => [
        "id" => $u["id"],
        "name" => $u["name"],
        "email" => $email
    ]
]);
{
  "email": "email@gmail.com",
  "password": "12345"
}
