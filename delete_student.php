<?php
require "config.php";

header("Content-Type: application/json");

if (!isset($_POST["deleteID"])) {
    echo json_encode(["status" => "error", "message" => "No ID provided"]);
    exit;
}

$id = $_POST["deleteID"];

$sql = "DELETE FROM students WHERE studentID=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$stmt->close();
$conn->close();
?>
