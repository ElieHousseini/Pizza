<?php

require('config/db_connect.php');

$title = $email = $ingredients = '';
$errors = array('EMAIL' => '', 'TITLE'=>'', 'INGREDIENTS'=>'');

  // Checking if the data is sent
  // all the data will be stored in GET variable on the server
  // in the GET request all the data will be visible in the URL of the user
  if(isset($_POST['SUBMIT'])){

    // Check email
    if(empty($_POST['EMAIL'])){
      $errors['EMAIL'] = 'email is required <br />';
    } else{
      $email = $_POST['EMAIL'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['EMAIL'] = 'EMAIL must be a valid email address';
      }
    }
        // Check title
        if(empty($_POST['TITLE'])){
          $errors['TITLE'] =  'TITLE is required <br />';
        } else{
          $title = $_POST['TITLE'];
          // from the start to the end, we want any
          // lower case, upper case or spaces
          // as the user as you want
          if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $errors['TITLE'] = 'TITLE must be letters and spaces only';
          }
        }

    // Check ingredients
    if(empty($_POST['INGREDIENTS'])){
      $errors['INGREDIENTS'] =  ' INGREDIENT is required <br />';
    } else{
      $ingredients = $_POST['INGREDIENTS'];
      // ReGix looking for comma seperated list
      if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
        $errors['INGREDIENTS'] = 'INGREDIENTS must be comma seperated lists';
      }
    }

    // checks if the form is valid or not
    // cycles through our array and performs a callback function
    // on each element we can define a call back function in it
    // it returns false if we do not have any error. else we have errors
    if(array_filter($errors)){
      // echo 'errors in the form';
    } else { // valid form
      //? mysqli_real_escape_string: is a function that scans the input
      //? from any malicious code (protects from SQL injections).
      // adding EMAIL, TITLE, INGREDIENTS to the DB
      $email = mysqli_real_escape_string($conn, $_POST['EMAIL']);
      $title = mysqli_real_escape_string($conn, $_POST['TITLE']);
      $ingredients = mysqli_real_escape_string($conn, $_POST['INGREDIENTS']);

      // Create sql
      $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

      // save to db and check
      if(mysqli_query($conn, $sql)){
        // success
        header('Location: index.php');
      } else {
        // error
        echo 'query error: '. mysqli_error($conn);
      }
    }

  } // end of POST check

?>

<!DOCTYPE html>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link rel="stylesheet" href="Styles.css" type="text/css">

<?php include('Components/Header.php'); ?>

<section class='container grey-text'>
    <h4 class='center'>Add a Pizza</h4>
    <form class='white' action='<?php echo $_SERVER['PHP_SELF'] ?>' method="POST">
      <label>Your Email:</label>
      <input type="text" name='EMAIL' value = '<?php echo htmlspecialchars($email) ?>'/>
      <div class="red-text"><?php echo $errors['EMAIL'] ?></div>
      <label>Pizza Title</label>
      <input type="text" name='TITLE' value = '<?php echo htmlspecialchars($title) ?>'/>
      <div class="red-text"><?php echo $errors['TITLE'] ?></div>
      <label>Ingredient (comma separated):</label>
      <input type="text" name='INGREDIENTS' value = '<?php echo htmlspecialchars($ingredients) ?>'/>
      <div class="red-text"><?php echo $errors['INGREDIENTS'] ?></div>
      <div class='center'>
      <input type="submit" name='SUBMIT' value='submit' class='btn brand z-depth-0'>
    </div>
  </form>
</section>

<?php include('Components/Footer.php'); ?>

</html>