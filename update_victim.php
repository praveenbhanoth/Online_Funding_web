<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject";

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

// If form is submitted, update the victim data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $vname = $_POST['vname'];
    $vage = $_POST['vage'];
    $vphno = $_POST['vphno'];
    $vproblem = $_POST['vproblem'];

    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE victim SET vname = ?, vage = ?, vphno = ?, vproblem = ? WHERE id = ?");
    $stmt->bind_param("sissi", $vname, $vage, $vphno, $vproblem, $id);
    
    if ($stmt->execute()) {
        // Redirect to the victim list page on success
        header("Location: victim_list.php");
        exit();
    } else {
        echo "Error updating victim: " . $conn->error;
    }
}

// Get the victim's details based on the ID passed in the URL
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM victim WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$victim = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Victim</title>
    <style>
        .form-container {
            text-align: center;
            background-color: #f4f4f9;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="update_victim.php" method="POST">
            <h2>Update Victim</h2>
            <input type="hidden" name="id" value="<?= $victim['id'] ?>">
            <input type="text" name="vname" value="<?= htmlspecialchars($victim['vname']) ?>" required>
            <input type="number" name="vage" value="<?= htmlspecialchars($victim['vage']) ?>" required>
            <input type="text" name="vphno" value="<?= htmlspecialchars($victim['vphno']) ?>" required>
            <textarea name="vproblem" required><?= htmlspecialchars($victim['vproblem']) ?></textarea>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
