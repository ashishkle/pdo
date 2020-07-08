<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $new_advice = array(
       
        "id"        => $id,
        "topic" => $_POST['topic'],
        "description"  => $_POST['description'],
        "advice"     => $_POST['advice'],
        "references"       => $_POST['references']
      
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "advice",
      implode(", ", array_keys($new_advice)) , ":" . implode(", :", array_keys($new_advice))
    );
    
    $statement = $connection->prepare($sql);
    echo $sql;
    $statement->execute($new_advice);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['topic']); ?> successfully added.</blockquote>
  <?php endif; ?>

  <h2>Add a ADVICE for This newsfeed post Analysis</h2>

  <?php if (isset($_GET['title']) && $statement) : ?>
	<blockquote><?php echo escape($_GET['title']); ?> successfully updated.</blockquote>
  <?php endif; ?>

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="id">Id of this item </label>
    <label for="topic">Name this Topic </label>
    <input type="text" name="topic" id="topic" size="100">

    <label for="description">Write small description</label>
    <input type="text" name="description" id="description" size="600" >
    
    <label for="advice">Add a new advice</label>
    <input type="text" name="advice" id="advice" size="300">
 
    <label for="references">Add reference to your Analysis</label>
    <input type="text" name="references" id="references" size="300">
   
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

