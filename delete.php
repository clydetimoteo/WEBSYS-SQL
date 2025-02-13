<?php
include 'db_connection.php';
$eID = $_GET['id'];

$sql = "DELETE FROM personnel WHERE ID = '$eID'";
if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>