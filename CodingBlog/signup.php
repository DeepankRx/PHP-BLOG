<?php

//function for console log
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

$servername = "localhost:4306";
$username = "root";
$password = "";
$database = "phub";

//connecting to database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    console_log("Connection failed " . mysqli_connect_error() . "\n");
} else {
    console_log("Connection Successful \n");
}

$myTable = "CREATE TABLE `users` (`sno` INT(5) NOT NULL AUTO_INCREMENT, `date` DATE,`Username` VARCHAR(50) NOT NULL,`Password` VARCHAR(100) NOT NULL, `Name` VARCHAR(100) NOT NULL,`PhoneNumber` BIGINT NOT NULL ,`Email` VARCHAR(100) NOT NULL,`isAdmin` CHAR(5),UNIQUE (Username),UNIQUE (Email),PRIMARY KEY (`sno`))";

$resultOfTable  = mysqli_query($conn, $myTable);
if (!$resultOfTable) {
    console_log("Table Creation Failed " . mysqli_error($conn) . "\n");
} else {
    console_log("\nTable Creation Successful\n");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $PhoneNumber = $_POST["PhoneNumber"];
    $Username = $_POST["Username"];
    $Password =$_POST["psw"];
    $insertingData = "INSERT INTO `users` ( `date`,`Name`, `Email`,`PhoneNumber`,`Username` ,`Password`,`isAdmin` ) VALUES (SYSDATE(), '$Name','$Email','$PhoneNumber','$Username','$Password','false')";
    $insert = mysqli_query($conn, $insertingData);
    if (!$insert) {
       if(mysqli_errno($conn)==1062){
        echo "<script>alert('Username or Email already exists');</script>";
       }
       else{
        echo "<script>alert('Error Occured');</script>";
       }
    } else {
        console_log("Data Insertion Successful ");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/contact.css?v=<?php echo time(); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programing Hub</title>
</head>

<body>
<nav id="navbar">
    <h1><a class="title" href="index.php">Programming Hub</a></h1>
    <ul>
      <li><a class="nav-element" href="index.php">Home</a></li>
      <li><a class="nav-element" href="blog.php">Blog</a></li>
      <li><a class="nav-element" href="contact.php">Contact</a></li>
      <?php 
      if(!isset($_SESSION["Username"])){
  echo   '<li><a class="nav-element" href="login.php"><button class="login-btn">Login</button></a></li>
   <li><a class="nav-element" href="signup.php"><button class="login-btn">Sign Up</button></a></li>';
      }
      else
      {
        echo   '<li><a class="nav-element" href="logout.php"><button class="login-btn">Log Out</button></a></li>';
        echo
        '<li><a class="nav-element" href="profile.php"><button class="login-btn">'.$_SESSION['Username'].'</button></a></li>';
      }
      ?>
    </ul>
  </nav>
    <div class="contact-container">
        <div id="validationBox" class="validation-box">
            <div id="message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>uppercase</b> letter</p>
                <p id="number" class="invalid">Atleast A <b>number</b></p>
                <p id="length" class="invalid">Min <b>08 characters</b></p>
            </div>
        </div>
        <div class="contact-form">
            <h1 class="title">Sign Up</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="label-div">
                    <label for="Username">Username : </label>
                </div>
                <div class="input-div">
                    <input class="text-input " type="text" name="Username" id="Username" required>
                </div>
                <br>
                <div class="label-div">
                    <label for="Password">Password :</label>
                </div>
                <div class="input-div">
                    <input class="text-input" type="password" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </div>
                <br>
                <div class="label-div">
                    <label for="Password">Confirm Password :</label>
                </div>
                <div class="input-div">
                    <input class="text-input" type="password" id="psw2" name="psw2" required>
                </div>
                <br>
                <div class="label-div">
                    <label for="Name">Your Name : </label>
                </div>
                <div class="input-div">
                    <input class="text-input " type="text" name="Name" id="Name" required>
                </div>
                <br>
                <div class="label-div">
                    <label for="Phone Number">Phone Number : </label>
                </div>
                <div class="input-div">
                    <input class="text-input " type="number" name="PhoneNumber" id="Phone Number" required>
                </div>
                <br>
                <div class="label-div">
                    <label for="Email">Email : </label>
                </div>
                <div class="input-div">
                    <input class="text-input " type="text" name="Email" id="Email" required>
                </div>
                <div class="submit-div">
                    <a href="login.php"> <input type="button" class="read-more-btn" value="  Login  "></a>
                    <input type="submit" class="read-more-btn" onClick="verifyPassword();" value="  Sign UP  ">
                </div>

            </form>
        </div>
    </div>

</body>
<script src="js/index.js?v=<?php echo time(); ?>"></script>

</html>