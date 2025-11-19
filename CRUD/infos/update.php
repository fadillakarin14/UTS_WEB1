<?php
require "../db.php";

$id = intval($_GET["id"] ?? 0);
$data = json_decode(file_get_contents("php://input"), true);

$title = $data["title"] ?? "";
$short_desc = $data["short_desc"] ?? "";
$content = $data["content"] ?? "";

$stmt = $mysqli->prepare("UPDATE infos SET title=?, short_desc=?, content=? WHERE id=?");
$stmt->bind_param("sssi", $title, $short_desc, $content, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Updated"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed"]);
}
{
  "title": "Judul Update",
  "short_desc": "Deskripsi update",
  "content": "Isi update..."
}
