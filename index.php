<?php
  // Connect to database
  $conn = mysqli_connect('localhost','Elie','test1234','ninja_pizza');

  // Check connection
  if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
  }

  // write query for all pizzas
  // *: I want all the Cols from the table pizzas
  $sql = 'SELECT title, ingredients, id FROM pizzas';

  // Make query and get result
  $result = mysqli_query($conn, $sql);

  // Fetch the resulting rows as an array
  $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // Free result from memory
  mysqli_free_result($result);

  // Close the connection
  mysqli_close($conn);
  
  print_r($pizzas);

?>



<!DOCTYPE html>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link rel="stylesheet" href="Styles.css" type="text/css">

<?php include('Components/Header.php'); ?>
<?php include('Components/Footer.php'); ?>

</html>