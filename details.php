<?php
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

// Retrieve form data
$vname = $_POST['vname'];
$vage = $_POST['vage'];
$vphno = $_POST['vphno'];
$vproblem = $_POST['vproblem'];

// Server-side validation for mobile number (10 digits)
if (!preg_match('/^\d{10}$/', $vphno)) {
    die("Invalid mobile number. Please enter exactly 10 digits.");
}

// Additional validation for age (optional)
if (!is_numeric($vage) || $vage < 0 || $vage > 150) {
    die("Invalid age. Please enter a valid number between 0 and 150.");
}

// Prepare and execute the SQL query securely
$stmt = $conn->prepare("INSERT INTO victim (vname, vage, vphno, vproblem) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $vname, $vage, $vphno, $vproblem);

if ($stmt->execute()) {
    echo "
    <html>
    <head>
    <style>
        .imh1 {
            background-image: url('images/donate.jpeg');
            background-repeat: no-repeat; 
            background-size: cover; 
            background-position: center; 
            background-size: 100% 100%;
        }

        h1 {
            color: white;
            text-align: center;
            font-size: 50px;
            margin-top: 20%;
        }

        button {
            padding: 10px 20px;
            margin: 0 auto;
            font-size: 20px;
            font-weight: bold;
            background-color: white;
            height: 50px;
            width: 200px;
            border-radius: 10px;
            border: none;
            color: blue;
            display: block;
        }
    </style>
    </head>
    <body class='imh1'>
        <h1>Profile added successfully!</h1>
        <form align='center' action='home.php'>
            <button type='submit'>View Profile</button>
        </form>
    </body>
    </html>
    ";
} else {
    echo "Error adding profile: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
