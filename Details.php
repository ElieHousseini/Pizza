<?php

require('config/db_connect.php');

if(isset($_POST["delete"])){

  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

  $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

  if(mysqli_query($conn, $sql)){
    // success
    header('Location: index.php');
  } else{
    // failure
    echo 'query error: '. mysqli_error($conn);
  }

}

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
  echo "Error finding ID";
}

?>

<!DOCTYPE html>

<html lang="en">
<?php include('Components/Header.php'); ?>
<div class="container center grey-text">
  <?php if($pizza): ?>

    <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
    <p>Creating by: <?php echo htmlspecialchars($pizza['email']); ?></p>
    <p><?php echo date($pizza['created_at']);?></p>
    <h5>Ingredients:</h5>
    <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

    <!-- DETELE FORM -->
    <form action="Details.php" method = "POST">
      <input type = "hidden" name = "id_to_delete" value = "<?php echo $pizza['id'] ?>" >
      <input type="submit" name="delete" value="Delete" class = 'btn brand z-depth-0'>
    </form>

  <?php else: ?>
    <h5>No Such Pizza Exists</h5>
  <?php endif; ?>
</div>
<?php include('Components/Footer.php'); ?>

</html>