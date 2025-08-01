<?php
$servername="localhost";
$username="root";
$password="";
$dbname="miniproject";
$conn=new mysqli($servername,$username,$password,$dbname);

$first_name=$_POST['first_name'];
$Last_name=$_POST['last_name'];
$email=$_POST['email'];
$pwd=$_POST['pwd'];
$stmt=$conn->prepare("insert into  registeruser(first_name,Last_name,email,pwd) values('$first_name','$Last_name','$email','$pwd')");

if($stmt->execute())
{
  echo "<html>

 <head>
 <style>

  .imh1{
         background-image:url('images/download1.jpeg');
         background-repeat: no-repeat; /* Prevent the background from repeating */
         background-size: cover; /* Make the background image cover the entire area */
         background-position: center; /* Center the background image */
         background-size: 100% 100%;
   }

   h1
   {
      text-color:'white';
      height:10px;
      
      font-size:100px;
   }

   button{

     padding:2px;
            margin:250px;
            font-size:40px;
            font-weight:0;
            background-color:white;
            height:100px;
            width:250px;
            border-radius:20px;
            border: none;
            color:blue;
            
   }

  </style>
 </head>



  
   <body class='imh1'>
   <h1>successfully Registered</h1>
  <form align='center' action='home.php'>
     
     <button type='submit' onclick='login()''>login </button>

  </form>


    <script src='script.js'></script>
  <body>
  </html>";
}
else
{
  echo "incorrect data" . $stmt->error;
}

?>