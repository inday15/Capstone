<?php
session_start();
include 'db.php';

// Ensure admin is logged in
if (!isset($_SESSION['username'])) {
    die("Unauthorized access.");
}

// Fetch users along with their rental details
$sql = "SELECT 
            users.username, 
            users.email, 
            rentals.car_name, 
            rentals.price_per_day, 
            rentals.pickup_date, 
            rentals.phone, 
            rentals.total_price, 
            rentals.rental_date
        FROM users
        LEFT JOIN rentals ON users.user_id = rentals.user_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bubble's Rental Car - Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<!-- Topbar Start -->
<div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">
    <div class="row">
        <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center">
                <a class="text-body pr-3" href="#"><i class="fa fa-phone-alt mr-2"></i>09123456789</a>
                <span class="text-body">|</span>
                <a class="text-body px-3" href="#"><i class="fa fa-envelope mr-2"></i>info@example.com</a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<div class="container">
    <h1>Welcome, Admin <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <a href="logout.php" class="btn btn-danger">Log out</a>

    <h2>User Rentals Dashboard</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Car Rented</th>
                <th>Price Per Day</th>
                <th>Pickup Date</th>
                <th>Phone Number</th>
                <th>Total Price</th>
                <th>Rental Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . (!empty($row["car_name"]) ? htmlspecialchars($row["car_name"]) : "No rental yet") . "</td>";
                    echo "<td>" . (!empty($row["price_per_day"]) ? "PHP " . number_format($row["price_per_day"], 2) : "N/A") . "</td>";
                    echo "<td>" . (!empty($row["pickup_date"]) ? htmlspecialchars($row["pickup_date"]) : "N/A") . "</td>";
                    echo "<td>" . (!empty($row["phone"]) ? htmlspecialchars($row["phone"]) : "N/A") . "</td>";
                    echo "<td>" . (!empty($row["total_price"]) ? "PHP " . number_format($row["total_price"], 2) : "N/A") . "</td>";
                    echo "<td>" . (!empty($row["rental_date"]) ? htmlspecialchars($row["rental_date"]) : "N/A") . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No rentals found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php $conn->close(); ?>

<!-- Footer Start -->
<div class="footer container-fluid bg-dark py-4 px-sm-3 px-md-5 text-center">
    <p class="mb-2 text-body">&copy; <a href="#">Team Bubbles</a>. All Rights Reserved.</p>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
