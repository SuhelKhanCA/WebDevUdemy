<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mywebsite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Display message if set
if (isset($_GET["message"]) && $_GET["message"] == "delete") {
    echo "Record Deleted <br /><br />";
}

// Query to get all users
$sql = "SELECT id, firstname, lastname, email FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
</head>
<body>

<table width="100%" border="1" cellspacing="1" cellpadding="1">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo htmlspecialchars($row["id"]); ?></td>
            <td><?php echo htmlspecialchars($row["firstname"]); ?></td>
            <td><?php echo htmlspecialchars($row["lastname"]); ?></td>
            <td><?php echo htmlspecialchars($row["email"]); ?></td>
            <td>
                <a href="deluser.php?id=<?php echo urlencode($row["id"]) ?>">Delete</a> |
                <a href="update.php?id=<?php echo urlencode($row["id"]) ?>">Update</a>
            </td>
        </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
    }
    ?>
</table>

<?php
// Close the connection
$conn->close();
?>

</body>
</html>
