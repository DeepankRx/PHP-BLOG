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

//connecting parameters
// $servername = "localhost:4306";
$username = "root";
$password = "";
$database = "phub";
$servername = "34.70.68.111";



//connecting to database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  console_log("Connection failed " . mysqli_connect_error() . "\n");
} else {
  console_log("Connection Successful \n");
}

$myDatabase = "CREATE DATABASE phub";
$dbResult = mysqli_query($conn, $myDatabase);
if (!$dbResult) {
  console_log("Database Creation Failed\n Or Database Exist Already\n");
} else {
  console_log("Database Creation Successful\n");
}

$myTable = "CREATE TABLE `blog` (`sno` INT(5) NOT NULL AUTO_INCREMENT, `date` DATE,`title` VARCHAR(10000) NOT NULL, `description` VARCHAR(1000000) NOT NULL , PRIMARY KEY (`sno`))";

$resultOfTable  = mysqli_query($conn, $myTable);
if (!$resultOfTable) {
  console_log("Table Creation Failed " . mysqli_error($conn) . "\n");
} else {
  console_log("\nTable Creation Successful\n");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script type="text/javascript" src="js/index.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css" />
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
    </ul>
  </nav>

  <div class="blog-container">
    <div class="blog-header-container">
      <div class="blog-content">
        <h1 class="blog-title"><strong>Programming Hub Blog</strong></h1>
      </div>
    </div>
    <div class="blogs">
      <?php
      $detail = "SELECT * FROM `blog`";
      $result = mysqli_query($conn, $detail);
      if (!$result) {
        console_log(mysqli_error($conn));
      }
      $num = mysqli_num_rows($result);
      if ($num > 0) {
        $number = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo ' <div class="blog-box">
        <h4 class="blog-date">Sun Dec 19 2021
</h4>
<h2 class="blog-heading">' . $row["title"] . '</h2>
<p class="blog-box-para">' . substr($row["description"], 0, 100) . '<span id="dots"></span ><span class="readMore" id="more' . $number . '">' . substr($row["description"], 100) . '</span></p>
<button class="read-more-btn" onclick="readMore(this.id)" id="myBtn' . $number . '">Read more</button>
    </div>';
          $number = $number + 1;
        }
      }

      ?>
    </div>
  </div>

</body>

</body>

</html>