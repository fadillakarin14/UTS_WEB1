<?php
require "../db.php";

$id = intval($_GET["id"] ?? 0);

$stmt = $mysqli->prepare("SELECT * FROM infos WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Data not found"]);
    exit;
}

echo json_encode([
    "status" => "success",
    "data" => $res->fetch_assoc()
]);
