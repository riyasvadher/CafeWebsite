<?php 
require_once("conn.php");

$name = $_GET['name'];
$date = $_GET['date'];
$time = $_GET['time'];
$guests = $_GET['guests'];

$query = "INSERT INTO reservations (name, reservation_date, reservation_time, guests) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param("sssi", $name, $date, $time, $guests);

if ($stmt->execute()) {
    $response = ["status" => "success", "message" => "Your reservation was successful!"];
} else {
    $response = ["status" => "error", "message" => "Sorry, there was an error with your reservation. Please try again."];
}

$stmt->close();
$con->close();

// Return the response as JSON
echo json_encode($response);
?>
