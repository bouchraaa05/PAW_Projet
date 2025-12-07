<?php
require "config.php";

header("Content-Type: application/json");

// Vérifier si les champs existent
if (!isset($_POST["studentID"]) || !isset($_POST["lastname"]) ||
    !isset($_POST["firstname"]) || !isset($_POST["email"])) {

    echo json_encode(["status" => "error", "message" => "Missing fields"]);
    exit;
}

$studentID = $_POST["studentID"];
$lastname  = $_POST["lastname"];
$firstname = $_POST["firstname"];
$email     = $_POST["email"];

$sql = "INSERT INTO students (studentID, lastname, firstname, email)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $studentID, $lastname, $firstname, $email);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$stmt->close();
$conn->close();
?>
