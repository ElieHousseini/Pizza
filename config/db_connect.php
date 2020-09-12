<?php

  // Connect to database
  $conn = mysqli_connect('localhost','Elie','test1234','ninja_pizza');

  // Check connection
  if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
  }

?>