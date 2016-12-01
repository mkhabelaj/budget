<?php
//$con = mysqli_connect("localhost","root","","budget");

/**
 * returns connection
 * @return mysqli
 */
function con(){
    return mysqli_connect("localhost","root","","budget");
}

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
?>