<?php

require('config/db_connect.php');

// Check GET request id param
if(isset($_GET['id'])){

  // Getting the id value from the URL
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  // make sql
  // It's important to use double quotes not a single quote.
  $sql = "SELECT * FROM pizzas WHERE id = $id";

  // Get the query results
  $result = mysqli_query($conn, $sql);

  // Fetch the result in array format
  $pizza = mysqli_fetch_assoc($result);

  // Freeing the memory from the result of the query
  mysqli_free_result($result);

  // Closing the connection
  mysqli_close($conn);
  
  // print_r($pizza);

} else{
  // Error
  echo 'Error fetching the ID';
}

?>

<!DOCTYPE html>

<html lang="en">
<?php include('Components/Header.php'); ?>
<div class="container center">
  <?php if($pizza): ?>

    <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
    <p>Creating by: <?php echo htmlspecialchars($pizza['email']); ?></p>
    <p><?php echo date($pizza['created_at']);?></p>
    <h5>Ingredients:</h5>
    <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>
  <?php else: ?>
  <?php endif; ?>
</div>
<?php include('Components/Footer.php'); ?>

</html>