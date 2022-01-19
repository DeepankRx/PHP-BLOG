<?php

include "connection.php";

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
    <?php
    if (isset($_SESSION["Username"])) {
        $credentialsMatching = "SELECT * FROM `users` WHERE `Username` = '" . $_SESSION["Username"] . "' AND `Password` = '" . $_SESSION["Password"] . "'";
        $result = mysqli_query($conn, $credentialsMatching);
        console_log($_SESSION["Username"]);
        console_log($_SESSION["Password"]);
        console_log($credentialsMatching);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($num > 0) {

            console_log($row);
            echo '<div class="contact-container">
        <div class="contact-form">
            <h1 class="title">Profile Detail</h1>
            <div >
                <div class="label-div">
                    <label for="Name">Name : </label>
                </div>
                <div class="input-div">
                ' . $row['Name'] . '
                </div>
                <br>
                <div class="label-div">
                    <label for="Email">Email :</label>
                </div>
                <div class="input-div">
                ' . $row['Email'] . '
                </div>
                <br>
                <div class="label-div">
                    <label for="Phone Number">Phone Number : </label>
                </div>
                <div class="input-div">
                ' . $row['PhoneNumber'] . '
                </div>
                <br>
                <div class="label-div">
                    <label for="Message">Account Created On : </label>
                </div>
                <div class="input-div">
                ' . $row['date'] . '
                </div>
                <br>
                <div class="label-div">
                    <label for="Message">Username : </label>
                </div>
                <div class="input-div">
                ' . $row['Username'] . '
                </div>
                <br>
                <div class="label-div">
                    <label for="Message">Password : </label>
                </div>
                <div class="input-div">
                ' . $row['Password'] . '
                </div>
            </div>
        </div>
    </div>

</body>

</html>';
        }
    }
    ?>