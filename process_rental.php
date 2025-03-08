<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User is not logged in.");
}

$user_id = $_SESSION['user_id']; // Get logged-in user's ID
$car_name = $_POST['car'];
$rental_days = (int) $_POST['rental_days'];
$pickup_date = $_POST['pickup_date'];
$phone = $_POST['phone'];

$car_prices = [
    "Toyota Wigo" => 2000,
    "Honda City" => 2500,
    "Honda BR-V" => 3000,
    "Toyota Innova" => 3500,
    "Nissan Navara" => 4000,
    "Toyota Fortuner" => 4000
];

if (!array_key_exists($car_name, $car_prices)) {
    die("Invalid car selection.");
}

$price_per_day = $car_prices[$car_name];
$total_price = $rental_days * $price_per_day;

// Insert rental data into the rentals table
$stmt = $conn->prepare("INSERT INTO rentals (user_id, car_name, price_per_day, rental_days, pickup_date, phone, total_price) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isiissd", $user_id, $car_name, $price_per_day, $rental_days, $pickup_date, $phone, $total_price);

if ($stmt->execute()) {
    echo "<div style='text-align: center; padding: 20px; font-family: Arial, sans-serif;'>";
    echo "<h2>Rental Booked Successfully!</h2>";
    echo "<p>Car: <strong>$car_name</strong></p>";
    echo "<p>Rental Days: <strong>$rental_days</strong></p>";
    echo "<p>Total Price: <strong>PHP " . number_format($total_price, 2) . "</strong></p>";
    echo "<br>";
    echo "<a href='dashboard.php' style='padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;'>Go to Dashboard</a>";
    echo "</div>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
