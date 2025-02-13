<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $date_of_joining = $_POST['date_of_joining'];

    $profile_picture = 'pictures/' . basename($_FILES['profile_picture']['name']);
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);

    $insert = "INSERT INTO personnel (Firstname, Lastname, Address, Email, Position, Department, DateOfJoining, ProfilePicture) 
            VALUES ('$fname', '$lname', '$address', '$email', '$position', '$department', '$date_of_joining', '$profile_picture')";

    if (mysqli_query($conn, $insert)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>