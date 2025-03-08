<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = $_POST['ln'];
    $firstname = $_POST['fn'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    // Insert new user into the database
    $sql = "INSERT INTO users (lastname, firstname, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $lastname, $firstname, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='index.html'>Login now</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
