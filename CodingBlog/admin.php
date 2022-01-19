<?php

//function for console log
include "connection.php";

if(!isset($_SESSION['Username'])){
  header("location: login.php");
  die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST["title"];
  $description = $_POST["description"];
  if (empty($title) || empty($description)) {
    console_log("Please Insert Title and description");
  }
  $insertingData = "INSERT INTO `blog` ( `title`, `description`,`date`) VALUES ('$title', '$description',SYSDATE())";
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
  <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
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