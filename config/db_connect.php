<?php 

// connect to database
$conn = mysqli_connect('localhost', 'ben', 'pizza_tut1234', 'pizza_tut');
// check connection
if(!$conn){
  echo 'connection error:' . myspli_connect_error();
}

?>