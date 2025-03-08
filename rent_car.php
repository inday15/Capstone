<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rent a Car</title>
</head>
<body>

<h2>Rent a Car</h2>
<form action="process_rental.php" method="POST">
    <label for="car">Select Car:</label>
    <select name="car">
        <option value="Toyota Wigo">Toyota Wigo - 2,000 PHP/day</option>
        <option value="Honda BR-V">Honda BR-V - 3,000 PHP/day</option>
        <option value="Honda City">Honda City - 2,500 PHP/day</option>
    </select><br><br>

    <label for="rental_days">Number of Days:</label>
    <input type="number" name="rental_days" required><br><br>

    <label for="pickup_date">Pick-up Date:</label>
    <input type="date" name="pickup_date" required><br><br>

    <button type="submit">Rent Now</button>
</form>

</body>
</html>
