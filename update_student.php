<?php
require "config.php";

header("Content-Type: application/json");

if (!isset($_POST["updateID"])) {
    echo json_encode(["status" => "error", "message" => "Student ID missing"]);
    exit;
}

$id = $_POST["updateID"];
$last = $_POST["updateLast"];
$first = $_POST["updateFirst"];
$email = $_POST["updateEmail"];

$sql = "UPDATE students SET lastname=?, firstname=?, email=? WHERE studentID=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $last, $first, $email, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$stmt->close();
$conn->close();
?>
