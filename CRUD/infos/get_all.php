<?php
require "../db.php";

$query = $mysqli->query("SELECT * FROM infos ORDER BY created_at DESC");
$data = [];

while ($row = $query->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
