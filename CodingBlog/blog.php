<?php
include "connection.php";

$CommentTable = "CREATE TABLE `comments` (`sno` INT(5) NOT NULL AUTO_INCREMENT, `date` DATE,`comment` VARCHAR(10000) NOT NULL,`Name` VARCHAR(250) NOT NULL, PRIMARY KEY (`sno`))";

$resultOfTable  = mysqli_query($conn, $CommentTable);
if (!$resultOfTable) {
  console_log("Table Creation Failed " . mysqli_error($conn) . "\n");
} else {
  console_log("\nTable Creation Successful\n");
}
if(isset($_POST["comment"]))
{
  $comment = $_POST["comment"];
 
  $sql = "INSERT INTO comments (date,comment,`Name`) VALUES (NOW(),'$comment','$_SESSION[Username]')";
  $result = mysqli_query($conn,$sql);
 if(!$result)
  {
    echo "<script>alert('Comment Not Added');</script>";
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
        <h4 class="blog-date">' . $row['date'] . '</h4>
        </h4>
        <h2 class="blog-heading">' . $row["title"] . '</h2>
        <p class="blog-box-para">' . substr($row["description"], 0, 100) . '<span id="dots"></span ><span class="readMore" id="more' . $number . '">' . substr($row["description"], 100) . '</span></p>
        
        <button class="read-more-btn" onclick="readMore(this.id)" id="myBtn' . $number . '">Read more</button>
        </div>';
          $number = $number + 1;
        }
      }

      ?>
      <div class="comment-section">
      <h1><b>Comments</b></h1>
          <hr class="hr">
        <?php
        // session_start();
        if(isset($_SESSION["Username"])){
          echo '
        <form action="blog.php" method="post">
          <div class="input-div">
            <input class="comment-input" type="text" name="comment" placeholder="Enter your comment here" required>
            <input class="login-btn" type="submit" name="submit" value="Submit">
          </div>
      </form>';
        }
        ?>
    <?php

      $detail = "SELECT * FROM `comments`";
      $result = mysqli_query($conn, $detail);
      if (!$result) {
        console_log(mysqli_error($conn));
      }
      $num = mysqli_num_rows($result);
      if ($num > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="comment-box">

          <h4 class="comment-name">Comment By: ' . $row["Name"] . '</h4>
          <h4 class="comment-date">On Date : ' . $row['date'] . '</h4><br>
          <p class="comment-para">Comment : ' . $row["comment"] . '</p>
          <hr >
          </div>';
        }
      } 
      ?>
      </div>
    </div>
  </div>

</body>

</body>

</html>