<?php
require "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$title = $data["title"] ?? "";
$short_desc = $data["short_desc"] ?? "";
$content = $data["content"] ?? "";

if (!$title || !$short_desc || !$content) {
    echo json_encode(["status" => "error", "message" => "Incomplete input"]);
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO infos (title, short_desc, content) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $short_desc, $content);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Data created"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to create"]);
}

{
  "title": "Judul Baru",
  "short_desc": "Deskripsi singkat",
  "content": "Isi lengkap data..."
}
