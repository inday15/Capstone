<?php
session_start(); // Start session at the beginning
include 'db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Retrieve user data from the database
    $stmt = $conn->prepare("SELECT user_id, username, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $db_email, $hashed_password);
        $stmt->fetch();

        // Verify the password
       if (password_verify($password, $hashed_password)) {
            // Store user data in session AFTER successful login
            $_SESSION['user_id'] = $id;
            header("Location: dashboard.php");
       
            exit();
        } else {
            echo "<script>alert('❌ Incorrect password!'); window.history.back();</script>";
            exit();
        }
    } else {
        echo "<script>alert('❌ No account found with this email!'); window.history.back();</script>";
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>

<html lang="en">

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
                    <a class="text-body pr-3" href=""><i class="fa fa-phone-alt mr-2"></i>09123456789</a>
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



    <!-- Carousel Start -->
    <div class="container-fluid p-0" style="margin-bottom: 90px;">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Rent A Car</h4>
                            <h1 class="display-1 text-white mb-md-4">Well maintained, safe, and comfortable.</h1>
                            <a href="#cars" class="btn btn-primary py-md-3 px-md-5 mt-2">Reserve Now</a>
				</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Rent A Car</h4>
                            <h1 class="display-1 text-white mb-md-4">We provide the widest selection of cars and motorcycle/bike.</h1>
                            <a href="#cars" class="btn btn-primary py-md-3 px-md-5 mt-2">Reserve Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->

<section id="login">
    <section class="vh-100">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card shadow" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="assets/img/login.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;">
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form action="login.php" method="POST">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="bi bi-car fa-2x me-2" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">Rental Vehicles</span>
                                        </div>
    
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login Here</h5>
    
					

                                        <div class="form-outline mb-4">
                                            <label class="form-label fw-bold">Email</label>
                                            <input type="email" class="form-control form-control-lg" name="email" required placeholder="Enter Your Email">
                                        </div>
    
                                        <div class="form-outline mb-4">
                                            <label class="form-label fw-bold">Password</label>
                                            <input type="password" class="form-control form-control-lg" name="password" required placeholder="Enter Your Password">
                                        </div>
    
                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-lg btn-primary w-100" name="login" type="submit">Login</button>
                                        </div>
    
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">
                                            Don't have an account?
                                            <a href="register.php" data-bs-toggle="modal" data-bs-target="#register" style="color:rgb(0, 0, 0);">Register here</a>
                                           <br> Own this Site?
                                            <a href="adminlogin.php" data-bs-toggle="modal" data-bs-target="#adminlogin" style="color:rgb(0, 0, 0);">Login as admin</a>
                                        </p>
                                    </form>
    
                                    <!-- Registration Modal -->
                                    <div class="modal fade" id="register" tabindex="-1" aria-labelledby="registerLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="registerLabel">Create Account</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="register.php" method="POST">
                                                        <div class="row">
                                                            <div class="col-6 mb-3">
                                                                <label class="fw-bold">Lastname</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="bi bi-person"></i></div>
                                                                    <input type="text" name="ln" class="form-control" required placeholder="Enter Lastname">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label class="fw-bold">Firstname</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="bi bi-person"></i></div>
                                                                    <input type="text" name="fn" class="form-control" required placeholder="Enter Firstname">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <label class="fw-bold">Email</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="bi bi-envelope"></i></div>
                                                                    <input type="email" name="email" class="form-control" required placeholder="Enter Email">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label class="fw-bold">Password</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="bi bi-lock"></i></div>
                                                                    <input type="password" name="password" class="form-control" required placeholder="Enter Password">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label class="fw-bold">Confirm Password</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="bi bi-lock"></i></div>
                                                                    <input type="password" name="confirm_password" class="form-control" required placeholder="Confirm Password">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <label class="fw-bold">Phone Number</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="bi bi-telephone"></i></div>
                                                                    <input type="text" name="phone" class="form-control" required placeholder="Enter Phone Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <label class="fw-bold">Address</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="bi bi-house"></i></div>
                                                                    <input type="text" name="address" class="form-control" required placeholder="Enter Address">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-grid">
                                                            <button type="submit" class="btn btn-primary">Register</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- End Modal -->
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">01</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Welcome To <span class="text-primary">BUBBLE Cars</span></h1>
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <img class="w-75 mb-4" src="img/about.png" alt="">
                    <p>Justo et eos et ut takimata sed sadipscing dolore lorem, et elitr labore labore voluptua no rebum sed, stet voluptua amet sed elitr ea dolor dolores no clita. Dolores diam magna clita ea eos amet, amet rebum voluptua vero vero sed clita accusam takimata. Nonumy labore ipsum sea voluptua sea eos sit justo, no ipsum sanctus sanctus no et no ipsum amet, tempor labore est labore no. Eos diam eirmod lorem ut eirmod, ipsum diam sadipscing stet dolores elitr elitr eirmod dolore. Magna elitr accusam takimata labore, et at erat eirmod consetetur tempor eirmod invidunt est, ipsum nonumy at et.</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-headset text-secondary"></i>
                        </div>
                        <h4 class="text-uppercase m-0">24/7 Car Rental Support</h4>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-secondary p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-car text-secondary"></i>
                        </div>
                        <h4 class="text-light text-uppercase m-0">Car Reservation Anytime</h4>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-map-marker-alt text-secondary"></i>
                        </div>
                        <h4 class="text-uppercase m-0">Lots Of Pickup Locations</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Banner Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="bg-banner py-5 px-4 text-center">
                <div class="py-5">
                    <h1 class="display-1 text-uppercase text-primary mb-4">15% OFF</h1>
                    <h1 class="text-uppercase text-light mb-4">Special Offer For New Members</h1>
                    <a class="btn btn-primary mt-2 py-3 px-5" href="">Register Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


<section id="cars">
    <!-- Rent A Car Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">02</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Find Your Car</h1>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="rent-item mb-4">
                        <img class="img-fluid mb-4" src="img/car-rent-1.png" alt="">
                        <h4 class="text-uppercase mb-4">Toyota Wigo</h4>
                        <div class="d-flex justify-content-center mb-4">
                        </div>
                        <a class="btn btn-primary px-3" href="#login">2,000 Php/Day</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="rent-item mb-4">
                        <img class="img-fluid mb-4" src="img/car-rent-2.png" alt="">
                        <h4 class="text-uppercase mb-4">Honda City</h4>
                        <div class="d-flex justify-content-center mb-4">
                        </div>
                        <a class="btn btn-primary px-3" href="#login">2,500 Php/Day</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="rent-item mb-4">
                        <img class="img-fluid mb-4" src="img/car-rent-3.png" alt="">
                        <h4 class="text-uppercase mb-4">Honda Br-v</h4>
                        <div class="d-flex justify-content-center mb-4">
                        </div>
                        <a class="btn btn-primary px-3" href="#login">3,000 Php/Day</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="rent-item mb-4">
                        <img class="img-fluid mb-4" src="img/car-rent-4.png" alt="">
                        <h4 class="text-uppercase mb-4">Toyota Innova</h4>
                        <div class="d-flex justify-content-center mb-4">
                        </div>
                        <a class="btn btn-primary px-3" href="#login">3,500 Php/Day</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="rent-item mb-4">
                        <img class="img-fluid mb-4" src="img/car-rent-5.png" alt="">
                        <h4 class="text-uppercase mb-4">Nissan Navara</h4>
                        <div class="d-flex justify-content-center mb-4">
                        </div>
                        <a class="btn btn-primary px-3" href="#login">4,000 Php/Day</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="rent-item mb-4">
                        <img class="img-fluid mb-4" src="img/car-rent-6.png" alt="">
                        <h4 class="text-uppercase mb-4">Toyota Fortuner</h4>
                        <div class="d-flex justify-content-center mb-4">
                        </div>
                        <a class="btn btn-primary px-3" href="#login">4,000 Php/Day</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Rent A Car End -->
</section>

    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="display-1 text-primary text-center">03 </h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Meet Our Team</h1>
            <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
                <div class="team-item">
                    <img class="img-fluid w-100" src="img/team-1.jpg" alt="">
                    <div class="position-relative py-4">
                        <h4 class="text-uppercase">John Calawigan Jr.</h4>
                        <p class="m-0"></p>
                    </div>
                </div>
                <div class="team-item">
                    <img class="img-fluid w-100" src="img/team-2.jpg" alt="">
                    <div class="position-relative py-4">
                        <h4 class="text-uppercase">Blessie Joyce David</h4>
                    </div>
                </div>
                <div class="team-item">
                    <img class="img-fluid w-100" src="img/team-3.jpg" alt="">
                    <div class="position-relative py-4">
                        <h4 class="text-uppercase">Jemelyn Entrina</h4>
                                         </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">04</h1>
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
                                <p>123 Street, New York, USA</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Branch Office</h5>
                                <p>123 Street, New York, USA</p>
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
<div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
    <div class="row pt-5 justify-content-center text-center">
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Get In Touch</h4>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i>123 Street, New York, USA</p>
            <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i>+012 345 67890</p>
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
<div class="container-fluid bg-dark py-4 px-sm-3 px-md-5 text-center">
    <p class="mb-2 text-body">&copy; <a href="#">Team Bubbles</a>. All Rights Reserved.</p>
</div>



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

</html>