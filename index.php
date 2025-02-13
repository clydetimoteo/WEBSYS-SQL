<?php
include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS</title>
    
    <style>
        body{
            font-family: Century Gothic;
        }body h1{
            
        }form input{
            border: 0.5px solid;
            border-radius: 5px;
            padding: 15px;
        }form button:hover{
            background-color: green;
            color: white;
            transition: 0.3s ease;
            border-radius: 10px;
        }header{
            background-color: red;
        }
    </style>
</head>
<body>
    <header>HUMAN RESOURCE MANAGEMENT SYSTEM</header> 
    
    <h2>ADD NEW EMPLOYEE</h2>
    <form action="insert.php" method="post">
        <input type="file" name="profile_picture" accept="image/*">
        <br>
        <input type="text" name="fname" placeholder="First Name" required>
        <br>
        <input type="text" name="lname" placeholder="Last Name" required>
        <br>
        <input type="text" name="address" placeholder="Address" required>
        <br>
        <input type="email" name="email" placeholder="Email" required>
        <br>
        <input type="text" name="position" placeholder="Position" required>
        <br>
        <input type="text" name="department" placeholder="Department" required>
        <br>
        <input type="date" name="date_of_joining" required>
        <br>

        <button type="submit">Register</button>
    </form>

    <h2>Employee Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Address</th>
            <th>Email</th>
            <th>Position</th>
            <th>Department</th>
            <th>Date of Joining</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM personnel");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['ID']}</td>
                <td>{$row['Firstname']}</td>
                <td>{$row['Lastname']}</td>
                <td>{$row['Address']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['Position']}</td>
                <td>{$row['Department']}</td>
                <td>{$row['DateOfJoining']}</td>
                <td>
                <img src='{$row['ProfilePicture']}' alt='Profile Picture' width='50' height='50'>
                </td>
                <td>
                    <a href='update.php?id={$row['ID']}'>Edit</a> | 
                    <a href='delete.php?id={$row['ID']}'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>