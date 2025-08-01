<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
// Fetch data from the database in reverse order
$sql = "SELECT id, vname, vage, vphno, vproblem FROM victim ORDER BY id DESC";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>FUNDFORHOPE</title>
    <link rel="stylesheet" href="sty.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
          
        }
        .itemcontainer {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 20px;
            background-image:url("images/donate.jpeg");
            background-repeat: no-repeat; /* Prevent the background from repeating */
            background-size: cover; /* Make the background image cover the entire area */
            background-position: center; /* Center the background image */
            background-size: 100% 100%;
        }
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 10px pink;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .card-background-container {
            height: 180px;
            background-size: cover;
            background-position: center;
            background-image:url("images/profile5.jpeg");
        }
        .card-heading {
            margin: 10px;
            font-size: 1.2rem;
            color: #333;
        }
        .card-description {
            margin: 10px;
            font-size: 0.9rem;
            color: #555;
        }
        .card-footer-container {
            margin: 10px;
            font-size: 0.9rem;
            color: #555;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .price {
            font-weight: bold;
            color: #007bff;
        }

        .donate {
            padding: 2px;
            margin: 10px;
            font-size: 15px;
            font-weight: 0;
            background-color: white;
            width: 80px;
            border-radius: 20px;
            border: none;
            color: blue;
            box-shadow: 0 4px 10px orange;
        }

        .enlarge-button {
            transition: transform 0.3s ease;
        }

        .enlarge-button:hover {
            transform: scale(1.1);
        }

        .head1{
            margin-left:25px;
            font-size:25px;
            color:black;
        }

    </style>
</head>
<body>


<div class="bgimage">
    <!-- Navigation -->
     
    <div class="wrapper">

    
        <nav class="nav">
            <div class="nav-logo">
                <p>SAVE LIFE</p>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="#" class="link active">Home</a></li>
                    <li><a href="adminlogin.php" class="link">Admin</a></li>
                    <li><a href="service.html" class="link">Services</a></li>
                    <li><a href="about.html" class="link">About</a></li>
                </ul>
            </div>
            
            <div class="nav-button">
                <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
                <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
            </div>
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>
       
        <!-- Form Box -->
        <div class="form-box">
            <!-- Login Form -->
            <div class="login-container" id="login">
                <div class="top">
                    <span>Victim Sign In... <a href="#" onclick="register()">Sign Up</a></span>
                </div>
                <form action="login.php" method="POST">
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Email" name="email" required>
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" placeholder="Password" name="pwd" required>
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Sign In">
                    </div>
                </form>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="register-container" id="register">
                <div class="top">
                    <span>Victim Sign Up... <a href="#" onclick="login()">Login</a></span>
                </div>
                <form action="register.php" method="post">
    <div class="input-box">
        <input type="text" class="input-field" placeholder="Firstname" name="first_name" required>
        <i class="bx bx-user"></i>
    </div>
    <div class="input-box">
        <input type="text" class="input-field" placeholder="Lastname" name="last_name" required>
        <i class="bx bx-user"></i>
    </div>
    <div class="input-box">
        <!-- Changed type to email for client-side validation -->
        <input type="email" class="input-field" placeholder="Email" name="email" required>
        <i class="bx bx-envelope"></i>
    </div>
    <div class="input-box">
        <input type="password" class="input-field" placeholder="Password" name="pwd" required>
        <i class="bx bx-lock-alt"></i>
    </div>
    <div class="input-box">
        <input type="submit" class="submit" value="Register">
    </div>
</form>

                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="register-check">
                        <label for="register-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Terms & Conditions</a></label>
                    </div>
                </div>
            </div>
            
        </div>
        <span class="head1"><h1>"Be the reason <br>someone smiles again. <br>Every donation makes a <br>difference."</h1></span>
    </div>
    </div>
    <!-- Victim Cards -->
    <div class="itemcontainer">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='card enlarge-button'>
                <div class='card-background-container'>
                    <p class='badge'>Victim</p>
                </div>
                <h4 class='card-heading'>" . htmlspecialchars($row['vname']) . "</h4>
                <p class='card-description'>
                    Age: " . htmlspecialchars($row['vage']) . "<br>
                    Phone: " . htmlspecialchars($row['vphno']) . "<br>
                    Problem: " . htmlspecialchars($row['vproblem']) . "
                </p>
                <div class='card-footer-container'>
                    <p class='price'>Support Needed</p>
                    <a href='victim_details.php?id=" . htmlspecialchars($row['id']) . "' class='donate enlarge-button'>View Details</a>
                </div>
            </div>
            ";
        }
    } else {
        echo "<p>No victims found.</p>";
    }
    $conn->close();
    ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
