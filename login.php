<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "miniproject";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the password from POST request
$pwd = $_POST['pwd'];

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT first_name, Last_name, email FROM registeruser WHERE pwd = ?");
$stmt->bind_param("s", $pwd); // Bind the password parameter
$stmt->execute();
$stmt->store_result(); // Store the result to check if any rows are returned

// Check if the password matches any record
if ($stmt->num_rows > 0) {
    $stmt->bind_result($first_name, $Last_name, $email);
    $stmt->fetch();

    // Display the form
    echo "
    <html>
    <head>
       <link rel='stylesheet' href='stylelogin.css'>
       <script src='script.js'></script>
    </head>
    <body>
    <div class='wrapper'>
     <div class='form-box'>
        <form action='details.php' method='post'>
        <h1>Hello, $first_name $Last_name</h1>
        <h1 id='change1'>Enter Victim Details</h1>
          <div class='input-box enlarge-button'>
               <input type='text' class='input-field' id='vname' name='vname' placeholder='Enter Victim Name' required>
               <i class='bx bx-user'></i>
          </div>
          <div class='input-box enlarge-button'>
            <input type='text' class='input-field' id='vage' name='vage' placeholder='Enter Age' required>
            <i class='bx bx-user'></i>
          </div>
          <div class='input-box enlarge-button'>
            <input 
                type='text' 
                class='input-field' 
                id='vphno' 
                name='vphno' 
                placeholder='Enter 10-digit Mobile Number' 
                pattern='\d{10}' 
                title='Please enter a valid 10-digit mobile number' 
                required>
            <i class='bx bx-lock-alt'></i>
          </div>
          <div class='input-box enlarge-button'>
            <input type='text' class='input-field' id='vproblem' name='vproblem' placeholder='Enter Problem' required>
            <i class='bx bx-envelope'></i>
          </div>
          <div class='input-box enlarge-button'>
            <input type='submit' class='submit' value='Submit'>
          </div>
        </form>
     </div>
    </div>
    </body>
    </html>";
} else {
    // Display "Invalid Password" message
    echo "
    <html>
    <head>
       <link rel='stylesheet' href='stylelogin.css'>
    </head>
    <body>
    <div class='wrapper'>
     <div class='form-box'>
        <h1>Invalid Password</h1>
     </div>
    </div>
    </body>
    </html>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
