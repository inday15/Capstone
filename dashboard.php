<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User is not logged in.");
}

$user_id = $_SESSION['user_id'];

$query = "SELECT car_name, rental_days, pickup_date, total_price FROM rentals WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>


<?php
$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <head>
    <meta charset="utf-8">
    <title>Bubble's Rental Car</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">
        <div class="row">
            <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body pr-3" href=""><i class="fa fa-phone-alt mr-2"></i>+012 345 6789</a>
                    <span class="text-body">|</span>
                    <a class="text-body px-3" href=""><i class="fa fa-envelope mr-2"></i>info@example.com</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body px-3" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-body px-3" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-body px-3" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-body px-3" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-body pl-3" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <div style="display: flex; justify-content: center; align-items: center; height: 10vh;">
    <div style="
        display: flex; 
        justify-content: center; 
        align-items: center; 
        gap: 20px; 
        padding: 10px;
        background: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    ">
        <h1 style="margin: 0;">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <a href="logout.php" style="
            background-color: #dc3545; 
            color: white; 
            text-decoration: none; 
            padding: 8px 12px; 
            border-radius: 5px;
            font-weight: bold;
        ">Log out</a>  
    </div>
</div>



    <h2 style="text-align: center;">Your Rentals</h2>
<div style="display: flex; justify-content: center;">
    <table border="5" style="
        border-collapse: collapse;
        width: 80%;
        text-align: center;
        font-family: Arial, sans-serif;
        color: black;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    ">
        <tr style="background-color:rgb(0, 0, 0); color: white; height: 50px;">
            <th style="padding: 10px;">Car</th>
            <th style="padding: 10px;">Rental Days</th>
            <th style="padding: 10px;">Pickup Date</th>
            <th style="padding: 10px;">Total Price</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr style="background-color:rgb(157, 157, 157); height: 40px;">
                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo htmlspecialchars($row['car_name']); ?></td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo $row['rental_days']; ?></td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo $row['pickup_date']; ?></td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd; font-weight: bold; color:rgb(0, 0, 0);">
                    PHP <?php echo number_format($row['total_price'], 2); ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

        <!-- Rent A Car Start -->
<style>
    .flip-card {
        background-color: transparent;
        width: 100%;
        height: 300px;
        perspective: 1000px;
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
    }

    .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
    }

    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
    }

    .flip-card-front {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ddd;
    }

    .flip-card-back {
        background-color: #007bff;
        color: white;
        transform: rotateY(180deg);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border: 1px solid #ddd;
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img class="img-fluid" src="img/car-rent-1.png" alt="Toyota Wigo">
                    </div>
                    <div class="flip-card-back">
                        <h4 class="text-uppercase">Toyota Wigo</h4>
			<h6>Specs</h6>
			<h8>
Engine type:	1.0 L, 3-cylinder gasoline, in-line, 12-valve DOHC (VVT-i)
Transmission:	CVT
Displacement:	998 cc
			</h8>
                        <h4 class="text-uppercase">2,000 Php/Day</h4>
                        <a class="btn btn-light" href="rent_car.php">Rent Now</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img class="img-fluid" src="img/car-rent-2.png" alt="Honda City">
                    </div>
                    <div class="flip-card-back">
                        <h4 class="text-uppercase">Honda City</h4>
			<h6>Specs</h6>
			<h8>
Engine Type: 1.5 L, 4-cylinder gasoline, in-line, 16-valve DOHC i-VTEC
Transmission: Continuously Variable Transmission (CVT)
Displacement: 1,498 cc
			</h8>
                        <h4 class="text-uppercase">2,500 Php/Day</h4>
                        <a class="btn btn-light" href="rent_car.php">Rent Now</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img class="img-fluid" src="img/car-rent-3.png" alt="Honda BR-V">
                    </div>
                    <div class="flip-card-back">
                        <h4 class="text-uppercase">Honda BR-V</h4>
			<h6>Specs</h6>
			<h8>
Engine Type: 1.5 L, 4-cylinder gasoline, in-line, 16-valve DOHC i-VTEC
Transmission: Continuously Variable Transmission (CVT)
Displacement: 1,498 cc			</h8>
                        <h4 class="text-uppercase">3,000 Php/Day</h4>

                        <a class="btn btn-light" href="rent_car.php">Rent Now</a>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img class="img-fluid" src="img/car-rent-4.png" alt="Toyota Innova">
                    </div>
                    <div class="flip-card-back">
                        <h4 class="text-uppercase">Toyota Innova</h4>
			<h6>Specs</h6>
			<h8>
Engine Type: 2.8 L, 4-cylinder diesel, in-line, 16-valve DOHC with Variable Nozzle Turbo (VNT)
Transmission: 6-speed automatic or 5-speed manual
Displacement: 2,755 cc			</h8>
                        <h4 class="text-uppercase">3,500 Php/Day</h4>

                        <a class="btn btn-light" href="rent_car.php">Rent Now</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img class="img-fluid" src="img/car-rent-5.png" alt="Nissan Navara">
                    </div>
                    <div class="flip-card-back">
                        <h4 class="text-uppercase">Nissan Navara</h4>
			<h6>Specs</h6>
			<h8>
ngine Type: 2.5 L, 4-cylinder diesel, in-line, DOHC with Variable Turbocharger
Transmission: 7-speed automatic or 6-speed manual
Displacement: 2,488 cc		</h8>
                        <h4 class="text-uppercase">4,000 Php/Day</h4>

                        <a class="btn btn-light" href="rent_car.php">Rent Now</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img class="img-fluid" src="img/car-rent-6.png" alt="Toyota Fortuner">
                    </div>
                    <div class="flip-card-back">
                       <h4 class="text-uppercase">Toyota Fortuner</h4>
			<h6>Specs</h6>
			<h8>
Engine Type: 2.8 L, 4-cylinder diesel, in-line, 16-valve DOHC with Variable Nozzle Turbo (VNT)
Transmission: 6-speed automatic or 6-speed manual
Displacement: 2,755 cc		</h8>
                        <h4 class="text-uppercase">4,500 Php/Day</h4>

                        <a class="btn btn-light" href="rent_car.php">Rent Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>

   <!-- <div class="form-container">
        <form action="process_rental.php" method="POST">
            <label for="car">Select Car:</label>
            <select name="car" required>
    <option value="Toyota Wigo">Toyota Wigo - 2,000 PHP/day</option>
    <option value="Honda City">Honda City - 2,500 PHP/day</option>
    <option value="Honda BR-V">Honda BR-V - 3,000 PHP/day</option>
    <option value="Toyota Innova">Toyota Innova - 3,500 PHP/day</option>
    <option value="Nissan Navara">Nissan Navara - 4,000 PHP/day</option>
    <option value="Toyota Fortuner">Toyota Fortuner - 4,000 PHP/day</option>
</select>


            <label for="rental_days">Number of Days:</label>
            <input type="number" name="rental_days" required>

            <label for="pickup_date">Pick-up Date:</label>
            <input type="date" name="pickup_date" required>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" required>

            <button type="submit">Rent Now</button>
        </form>
    </div> -->

    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">09123456789</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Contact Us</h1>
            <div class="row">
                <div class="col-lg-7 mb-2">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                        <form>
                            <div class="row">
                                <div class="col-6 form-group">
                                    <input type="text" class="form-control p-4" placeholder="Your Name" required="required">
                                </div>
                                <div class="col-6 form-group">
                                    <input type="email" class="form-control p-4" placeholder="Your Email" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control p-4" placeholder="Subject" required="required">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control py-3 px-4" rows="5" placeholder="Message" required="required"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 mb-2">
                    <div class="bg-secondary d-flex flex-column justify-content-center px-5 mb-4" style="height: 435px;">
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Head Office</h5>
                                <p>Rizal St, Iloilo City Proper, Iloilo City</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Branch Office</h5>
                                <p>E Lopez St, Jaro, Iloilo City, Iloilo</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Customer Service</h5>
                                <p>customer@example.com</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Return & Refund</h5>
                                <p class="m-0">refund@example.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

<!-- Footer Start -->
<div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5 text-center" style="margin-top: 90px;">
    <div class="row pt-5 justify-content-center">
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Get In Touch</h4>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i>Rizal St, Iloilo City Proper, Iloilo City</p>
            <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i>09123456789</p>
            <p><i class="fa fa-envelope text-white mr-3"></i>info@example.com</p>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Car Gallery</h4>
            <div class="row mx-n1 justify-content-center">
                <div class="col-4 px-1 mb-2">
                    <a href=""><img class="w-100" src="img/gallery-1.jpg" alt=""></a>
                </div>
                <div class="col-4 px-1 mb-2">
                    <a href=""><img class="w-100" src="img/gallery-2.jpg" alt=""></a>
                </div>
                <div class="col-4 px-1 mb-2">
                    <a href=""><img class="w-100" src="img/gallery-3.jpg" alt=""></a>
                </div>
                <div class="col-4 px-1 mb-2">
                    <a href=""><img class="w-100" src="img/gallery-4.jpg" alt=""></a>
                </div>
                <div class="col-4 px-1 mb-2">
                    <a href=""><img class="w-100" src="img/gallery-5.jpg" alt=""></a>
                </div>
                <div class="col-4 px-1 mb-2">
                    <a href=""><img class="w-100" src="img/gallery-6.jpg" alt=""></a>
                </div>
            </div>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-dark py-4 px-sm-3 px-md-5 text-center">
    <p class="mb-2 text-body">&copy; <a href="#">Team Bubbles</a>. All Rights Reserved.</p>
</div>
<!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>


</body>
</html>
