<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the id is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the victim details from the database
    $sql = "SELECT vname, vage, vphno, vproblem FROM victim WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any victim is found
    if ($result->num_rows > 0) {
        $victim = $result->fetch_assoc();
    } else {
        echo "No victim found with that ID.";
        exit();
    }
} else {
    echo "No ID provided!";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Victim Details</title>
    <link rel="stylesheet" href="sty.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 6px 10px pink;
        }
        .victim-details {
            margin-bottom: 20px;
        }
        .victim-details h2 {
            color: #333;
        }
        .victim-details p {
            font-size: 1.1rem;
            color: #555;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        .donate{
            padding:2px;
            margin:10px;
            font-size:15px;
            font-weight:0;
            background-color:white;
            width:80px;
            border-radius:20px;
            border: none;
            color:blue;
            box-shadow: 0 4px 10px orange;
        }
        .enlarge-button {
            transition: transform 0.3s ease;
        }
        .enlarge-button:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Victim Details</h2>

        <div class="victim-details">
            <h3>Name: <?php echo htmlspecialchars($victim['vname']); ?></h3>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($victim['vage']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($victim['vphno']); ?></p>
            <p><strong>Problem:</strong> <?php echo htmlspecialchars($victim['vproblem']); ?></p>
        </div>


    <div align='center'>
       <p class='price'>Donate</p>
      <form action="phonepay.html" method="GET">
        <button class='donate enlarge-button' type="submit" name="amount" value="10">10</button>
        <button class='donate enlarge-button' type="submit" name="amount" value="20">20</button><br>
        <button class='donate enlarge-button' type="submit" name="amount" value="30">30</button>
        <button class='donate enlarge-button' type="submit" name="amount" value="40">40</button>
      </form>
    </div>

        <a href="home.php" class="back-button">Back to Victim List</a>
    </div>
</body>
</html>
