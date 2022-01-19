<?php

include "connection.php";

$myTable = "CREATE TABLE `messages` (`sno` INT(5) NOT NULL AUTO_INCREMENT, `date` DATE,`Name` VARCHAR(50) NOT NULL,`Email` VARCHAR(100) NOT NULL, `Message` VARCHAR(1000) NOT NULL,`PhoneNumber` BIGINT NOT NULL , PRIMARY KEY (`sno`))";

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
  $Message = $_POST["Message"];

  $insertingData = "INSERT INTO `messages` ( `date`,`Name`, `Email`,`PhoneNumber`, `Message` ) VALUES (SYSDATE(), '$Name','$Email','$PhoneNumber','$Message')";
  $insert = mysqli_query($conn, $insertingData);
  if (!$insert) {
    console_log("Data Insertion Failed " . mysqli_error($conn));
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
      if (!isset($_SESSION["Username"])) {
        echo   '<li><a class="nav-element" href="login.php"><button class="login-btn">Login</button></a></li>
   <li><a class="nav-element" href="signup.php"><button class="login-btn">Sign Up</button></a></li>';
      } else {
        echo   '<li><a class="nav-element" href="logout.php"><button class="login-btn">Log Out</button></a></li>';
        echo
        '<li><a class="nav-element" href="profile.php"><button class="login-btn">' . $_SESSION['Username'] . '</button></a></li>';
      }
      ?>
    </ul>
  </nav>
  <div class="contact-container">
    <div class="contact-form">
      <h1 class="title">Contact Us</h1>
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="label-div">
          <label for="Name">Name : </label>
        </div>
        <div class="input-div">
          <input class="text-input " type="text" name="Name" id="Name" required>
        </div>
        <br>
        <div class="label-div">
          <label for="Email">Email :</label>
        </div>
        <div class="input-div">
          <input class="text-input" type="text" name="Email" id="Email" required>
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
          <label for="Message">Message : </label>
        </div>
        <div class="input-div">
          <input class="text-input message-box" type="text" name="Message" id="Message" required>
        </div>
        <br>
        <div class="submit-div">
          <input type="submit" class="read-more-btn" value="Send Message">
        </div>
      </form>
    </div>
  </div>

</body>

</html>