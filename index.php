<?php
  // Connect to database
  $conn = mysqli_connect('localhost','Elie','test1234','ninja_pizza');

  // Check connection
  if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
  }

  // write query for all pizzas
  // *: I want all the Cols from the table pizzas they will be ordered according to the 
  // created_at attribute.
  $sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

  // Make query and get result
  $result = mysqli_query($conn, $sql);

  // Fetch the resulting rows as an array
  $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // Free result from memory
  mysqli_free_result($result);

  // Close the connection
  mysqli_close($conn);
  
  // print_r($pizzas);

?>



<!DOCTYPE html>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link rel="stylesheet" href="Styles.css" type="text/css">

<?php include('Components/Header.php'); ?>

  <h4 class="center grey-text">Pizzas!</h4>

  <div class="container">

    <div class="row">

      <?php foreach($pizzas as $pizza){ ?>

        <div class="col s6 md3">
          <div class="card z-depth-0">
            <div class="card-content center">
              <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
              <div><?php echo htmlspecialchars($pizza['ingredients']) ?></div>
            </div>
            <div class = 'card-action right-align'>
              <a href="#" class="brand-text">more info</a>
            </div>
          </div>
        </div>

      <?php } ?>

    </div>

  </div>

<?php include('Components/Footer.php'); ?>

</html>