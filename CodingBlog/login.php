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


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $Username = $_POST["Username"];
  $Password = $_POST["Password"];
  $credentialsMatching = "SELECT * FROM `users` WHERE `Username` = '$Username' AND `Password` = '$Password'";
  $result = mysqli_query($conn, $credentialsMatching);
  if (!$result) {
    console_log("Query Failed " . mysqli_error($conn) . "\n");
  } else {
    console_log("Query Successful\n");
  }
  if (mysqli_num_rows($result) === 1) {
    session_start();
    $row = mysqli_fetch_assoc($result);
    console_log($row);
    $_SESSION["Username"] = $Username;
    $_SESSION["Password"] = $Password;
    if(isset($_SESSION["Username"]) && $row['isAdmin']==="true"){
      header("Location: admin.php");
    }
    else{
      header("Location: index.php");
    }
  } else {
    echo "<script>alert('Invalid Username Of Password')</script>";

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
    <div class="contact-form">
      <h1 class="title">Login</h1>
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="label-div">
          <label for="Name">Username : </label>
        </div>
        <div class="input-div">
          <input class="text-input " type="text" name="Username" id="Username" required>
        </div>
        <br>
        <div class="label-div">
          <label for="Password">Password :</label>
        </div>
        <div class="input-div">
          <input class="text-input " type="password" name="Password" id="Password" required>
        </div>

        <div class="submit-div">
          <input type="submit" class="read-more-btn" value="  Login  ">
          <a href="signup.php"> <input type="button" class="read-more-btn" value="  Sign Up  "></a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>