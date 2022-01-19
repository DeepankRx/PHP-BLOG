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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Programming Hub</title>
</head>

<body>

  <nav id="navbar">
    <h1><a class="title" href="index.php">Programming Hub</a></h1>
    <ul>
      <li><a class="nav-element" href="index.php">Home</a></li>
      <li><a class="nav-element" href="blog.php">Blog</a></li>
      <li><a class="nav-element" href="contact.php">Contact</a></li>
      <li><a class="nav-element" href="login.php"><button class="login-btn">Login</button></a></li>
      <li><a class="nav-element" href="signup.php"><button class="login-btn">Sign Up</button></a></li>
    </ul>
  </nav>

  <div class="home-container">
    <div class="header-container">
      <div class="header-content">
        <h1 class="welcome-line"> Welcome To <span class="title">Programming Hub</span></h1>
        <p class="welcome-text">Confused on which course to take? I have got you covered. Browse courses and find out the best course for you. Its free! Code With Harry is my attempt to teach basics and those coding techniques to people in short time which took me ages to learn.</p>
      </div>
      <div class=header>
        <img class="home-img" src="images/home-bg.jpg" alt="">
      </div>
    </div>
    <div class="recent-blog">
      <h1>
        Recent Blogs
      </h1>
    
      <?php
      $detail = "SELECT * FROM `blog`";
      $result = mysqli_query($conn, $detail);
      if (!$result) {
        console_log(mysqli_error($conn));
      }
      $num = mysqli_num_rows($result);
      if ($num > 0) {
        $number = 1;
        $i=3;
        while ($i--) {
          $row = mysqli_fetch_assoc($result);
          echo ' <div class="card">
          <img class="card-img" src="https://picsum.photos/350/200" alt="">
          <h1 class="card-heading">'.$row['title'].'</h1>
          <p class="card-para">'.substr($row['description'],0,200).'</p>
        </div>';
          $number = $number + 1;
        }
      }
      ?>
     
    </div>
  </div>
  <footer>
    <div class="footer">
      <p class="footer-para">&copy; 2022 Programming Hub</p>

    </div>
  </footer>
</body>

<script src="js/index.js">

</script>

</html>