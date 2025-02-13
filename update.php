<?php
include 'db_connection.php';
$eID = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM personnel WHERE ID = '$eID'");
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['fname'], $_POST['lname'], $_POST['address'], $_POST['email'], $_POST['position'], $_POST['department'], $_POST['date_of_joining'])) {
        
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

        if (!empty($_FILES['profile_picture']['name'])) {
            $profile_picture = 'pictures/' . basename($_FILES['profile_picture']['name']);
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture)) {
                $update = "UPDATE personnel SET Firstname = '$fname', Lastname = '$lname', Address = '$address', 
                           Email = '$email', Position = '$position', Department = '$department', DateOfJoining = '$date_of_joining', 
                           ProfilePicture = '$profile_picture' WHERE ID = '$eID'";
            } else {
                echo "Error uploading the file.";
            }
        }

        if (mysqli_query($conn, $update)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
</head>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

h2 {
    color: #333;
    margin-top: 0;
}

form {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

form input {
    width: calc(100% - 22px);
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
    transition: border-color 0.3s;
}

form input:focus {
    border-color: #ff5722;
    outline: none;
}

form button {
    background-color: #ff5722;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #e64a19;
}

input[type="file"] {
    padding: 10px; 
}

@media (max-width: 600px) {
    form {
        padding: 15px;
    }

    form input, form button {
        width: 100%;
    }
}
</style>
<body>
    <h2>Update Employee Details</h2>
    <form action="update.php?id=<?php echo $eID; ?>" method="post" enctype="multipart/form-data"> <!-- Added enctype -->
        <input type="text" name="fname" value="<?php echo htmlspecialchars($row['Firstname']); ?>" required>
        <input type="text" name="lname" value="<?php echo htmlspecialchars($row['Lastname']); ?>" required>
        <input type="text" name="address" value="<?php echo htmlspecialchars($row['Address']); ?>" required>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
        <input type="text" name="position" value="<?php echo htmlspecialchars($row['Position']); ?>" required>
        <input type="text" name="department" value="<?php echo htmlspecialchars($row['Department']); ?>" required>
        <input type="date" name="date_of_joining" value="<?php echo htmlspecialchars($row['DateOfJoining']); ?>" required>
        <input type="file" name="profile_picture" accept="image/*"> <!-- File input for profile picture -->
        <button type="submit">Update</button>
    </form>
</body>
</html>