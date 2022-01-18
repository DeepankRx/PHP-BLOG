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

$servername = "34.70.68.111";
$username = "root";
$password = "";
$database = "phub";

// $servername = "sql6.freemysqlhosting.net:3306";
// $username = "sql6466492";
// $password = "DPtlr48aTG";
// $database = "sql6466492";

//connecting to database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  console_log("Connection failed " . mysqli_connect_error() . "\n");
} else {
  console_log("Connection Successful \n");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST["title"];
  $description = $_POST["description"];
  if (empty($title) || empty($description)) {
    console_log("Please Insert Title and description");
  }
  $insertingData = "INSERT INTO `blog` ( `title`, `description`) VALUES ('$title', '$description');";
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
  <script type="text/javascript" src="js/index.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css" />
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Programming Hub</title>
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


  <div class="home-container">
    <div class="header-container">
      <div class="header-content">
        <h1 class="welcome-line">Create <span class="title">Blog</span></h1>

      </div>
      <div class=form-div>
        <form class="form" action='<?php echo $_SERVER['PHP_SELF'] ?>' method="post" >
          <label for="">Enter Title :</label>
          <input type="text" class="description-input-1" name="title" id="title" required>
          <br>
          <label for="">Enter Description :</label>
          <input class="description-input-2" type="text" name="description" id="title" required>
          <br>
          <input class="read-more-btn" type="submit" value="Submit">
        </form>
      </div>
    </div>

  </div>
</body>

</html>