<?php
include 'db_connection.php';
$eID = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $date_of_joining = $_POST['date_of_joining'];

    $update = "UPDATE personnel SET Firstname = '$fname', Lastname = '$lname', Address = '$address', 
               Email = '$email', Position = '$position', Department = '$department', DateOfJoining = '$date_of_joining' 
               WHERE ID = '$eID'";
    if (mysqli_query($conn, $update)) {
        header("Location: index.php");
    }
}if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Other fields
    $profile_picture = $row['ProfilePicture'];

    if (!empty($_FILES['profile_picture']['name'])) {
        $profile_picture = 'pictures/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
    }

    $update = "UPDATE personnel SET Firstname = '$fname', Lastname = '$lname', Address = '$address', 
               Email = '$email', Position = '$position', Department = '$department', DateOfJoining = '$date_of_joining', 
               ProfilePicture = '$profile_picture' WHERE ID = '$susi'";
    if (mysqli_query($conn, $update)) {
        header("Location: index.php");
    }
}

$result = mysqli_query($conn, "SELECT * FROM personnel WHERE ID = '$eID'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
</head>
<body>
    <h2>Update Employee Details</h2>
    <form action="update.php?id=<?php echo $eID; ?>" method="post">
        <input type="text" name="fname" value="<?php echo $row['Firstname']; ?>" required>
        <input type="text" name="lname" value="<?php echo $row['Lastname']; ?>" required>
        <input type="text" name="address" value="<?php echo $row['Address']; ?>" required>
        <input type="email" name="email" value="<?php echo $row['Email']; ?>" required>
        <input type="text" name="position" value="<?php echo $row['Position']; ?>" required>
        <input type="text" name="department" value="<?php echo $row['Department']; ?>" required>
        <input type="date" name="date_of_joining" value="<?php echo $row['DateOfJoining']; ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>