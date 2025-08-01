<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch victim details from the correct table 'victim'
$sql = "SELECT * FROM victim";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Victim List</title>
    <style>
        .victim-list-container {
            text-align: center;
            background-color: #f4f4f9;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        button {
            padding: 10px 20px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>
    <div class="victim-list-container">
        <h1>Victim List</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Phone</th>
                <th>Problem</th>
                <th>Actions</th>
            </tr>
            <?php 
            // Check if there are any rows in the result
            if ($result->num_rows > 0) {
                // Loop through each row and display victim data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vage']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vphno']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['vproblem']) . "</td>";
                    echo "<td>
                            <a href='update_victim.php?id=" . $row['id'] . "'>Update</a> | 
                            <a href='delete_victim.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No victims found.</td></tr>";
            }
            ?>
        </table>
        <a href="home.php" class="cta-button"><h2>BACK TO HOME</h2></a>
    </div>
</body>
</html>
