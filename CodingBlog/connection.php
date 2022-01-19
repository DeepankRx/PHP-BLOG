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


$myTable = "CREATE TABLE `blog` (`sno` INT(5) NOT NULL AUTO_INCREMENT, `date` DATE,`title` VARCHAR(10000) NOT NULL, `description` VARCHAR(1000000) NOT NULL , PRIMARY KEY (`sno`))";

$resultOfTable  = mysqli_query($conn, $myTable);
if (!$resultOfTable) {
  console_log("Table Creation Failed " . mysqli_error($conn) . "\n");
} else {
  console_log("\nTable Creation Successful\n");
}
session_start();
?>