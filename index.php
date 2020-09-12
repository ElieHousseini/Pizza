<?php

  require('config/db_connect.php');

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
  
  // printing the pizzas
  // print_r($pizzas);

  // cycling through the string of ingredients
  // of the first element in the pizzas array
  // expected input: 'tomato, cheese, tofu'
  // expected output: Array ( [0] => tomato [1] => cheese [2] => tofu )
  // explode(',', $pizzas[0]['ingredients']);

?>



<!DOCTYPE html>


<?php include('Components/Header.php'); ?>

  <h4 class="center grey-text">Pizzas!</h4>
  <div class="container">

<div class="row">

      <?php foreach($pizzas as $pizza): ?>

   <div class="col s6 md3">
          <div class="card z-depth-0">
          <img src="pizza.svg" class = 'pizza' alt="Pizza Image">
            <div class="card-content center">
              <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
              <ul>
                <?php foreach(explode(',', $pizza['ingredients']) as $ingredient): ?>
                <li><?php echo htmlspecialchars($ingredient) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class = 'card-action right-align'>
              <a class="brand-text" href="Details.php?id=<?php echo $pizza['id']?>" >
              more info
              </a>
            </div>
          </div>
        </div>

      <?php endforeach; ?>

      <?php 
      if(count($pizzas) >= 3): ?>
        <?php  return false?>
        <?php 
      else: ?>
          <p>There are less than 3 pizzas</p>
      <?php endif ?>
    </div>
    <?php include('Components/Footer.php'); ?> 
  </div>



</html>