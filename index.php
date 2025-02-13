<?php
include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        header {
            background-color: #ff5722;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        img {
            border-radius: 50%; 
        }
        a {
            color: #ff5722;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>HUMAN RESOURCE MANAGEMENT SYSTEM</header> 
    
    <h2>ADD NEW EMPLOYEE</h2>
    <form action="insert.php" method="post" enctype="multipart/form-data"> <!-- Added enctype -->
        Please add their Profile Pictures
        <input type="file" name="profile_picture" accept="image/*" required>
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
            <th>Profile Picture</th>
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