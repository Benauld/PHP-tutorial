<?php 
$errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');
$email = '';
$title = '';
$ingredients = '';

if(isset($_POST['submit'])){

  // check email
  if(empty($_POST['email'])){
    $errors['email'] = 'An email is required <br />';
  } else {
    $email =$_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['email'] = 'Not a valid email address <br />';
    }
  }

  // check title
  if(empty($_POST['title'])){
    $errors['title'] = 'A title is required <br />';
  } else {
    $title = $_POST['title'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
      $errors['title'] = 'A title must only contain characters and spaces <br />';
    }
  }

  // check ingredients
  if(empty($_POST['ingredients'])){
    $errors['ingredients'] = 'Ingredients required <br />';
  } else {
    $ingredients = $_POST['ingredients'];
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
      $errors['ingredients'] = 'Ingredients must only contain characters and commas <br />';
    }
  }

  //if no errors then redicrect to home page
  if(array_filter($errors)){
    echo 'there are errors in the form';
  } else {
    header('location: index.php');
  }
} // end of post check


?>
<!DOCTYPE html>
<html>
  <?php include('templates/header.php') ?>

  <section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form action="add.php" class="white" method="POST">
      <label>Your Email:</label>
      <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
      <div class="red-text"><?php echo $errors['email'];?></div>
      <label>Pizza Title:</label>
      <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
      <div class="red-text"><?php echo $errors['title'];?></div>
      <label>Ingredients (comma separated):</label>
      <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
      <div class="red-text"><?php echo $errors['ingredients'];?></div>
      <div class="center">
      <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
      </div>
    </form>
  </section>




  <?php include('templates/footer.php') ?>

</html>