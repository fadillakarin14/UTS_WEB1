<?php
require "../db.php";

$id = intval($_GET["id"] ?? 0);

$stmt = $mysqli->prepare("DELETE FROM infos WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Deleted"]);
} else {
    echo json_encode(["status" => "error", "message" => "Delete failed"]);
}
