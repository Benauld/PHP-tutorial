<?php
include('./config/db_connect.php');

if(isset($_POST['delete'])){
  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
  $sql = "DELETE FROM pizzas where id = $id_to_delete";
  if(mysqli_query($conn, $sql)){
    // success
    header('Location: index.php');
  }else{
    echo 'query error:' . mysqli_error($conn);
  }
}
//check get request id parameter
if(isset($_GET['id'])){
 $id = mysqli_real_escape_string($conn, $_GET['id']);
 // make sql
 $sql = "SELECT * FROM pizzas WHERE id = $id";
 $result = mysqli_query($conn, $sql);
 $pizza = mysqli_fetch_assoc($result);

 mysqli_free_result($result);
 mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>
  <?php include('templates/header.php') ?>
   
   <div class="container center">
    <?php if($pizza): ?>  
      <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
      <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
      <p>Created On: <?php echo htmlspecialchars($pizza['created_at']); ?></p>
      <h5>Ingredients</h5>
      <ul> 
        <?php foreach (explode(',',$pizza['ingredients']) as $ingredient): ?>
          <li> <?php echo htmlspecialchars($ingredient); ?></li>
        <?php endforeach; ?>
      </ul>
      <!-- delete form -->
      <form action="details.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
        <input class="btn brand z-depth-0" type="submit" name="delete" value="Delete">
      </form>
    <?php else: ?>
      <h5>No such pizza exists!</h5>
    <?php endif;?>
   </div>

  <?php include('templates/footer.php') ?>
</html>