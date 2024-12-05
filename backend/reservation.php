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
    // Redirect to index with a success message
    header("Location: ../frontend/index.php?message=" . urlencode("Reservation successfully saved!"));
    exit();
} else {
    // Redirect to index with an error message
    header("Location: ../frontend/index.php?message=" . urlencode("Error: " . $stmt->error));
    exit();
}
?>
