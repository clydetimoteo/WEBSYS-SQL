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

    $target_dir = 'pictures/'; 
    $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
    $upload_ok = 1;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES['profile_picture']['tmp_name']);
    if ($check === false) {
        echo "File is not an image.";
        $upload_ok = 0;
    }

    if ($_FILES['profile_picture']['size'] > 2000000) {
        echo "Sorry, your file is too large.";
        $upload_ok = 0;
    }

    if (!in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $upload_ok = 0;
    }

    if ($upload_ok == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            $insert = "INSERT INTO personnel (Firstname, Lastname, Address, Email, Position, Department, DateOfJoining, ProfilePicture) 
                        VALUES ('$fname', '$lname', '$address', '$email', '$position', '$department', '$date_of_joining', '$target_file')";

            if (mysqli_query($conn, $insert)) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>