<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

$title = $_GET['title'];
$id = $_GET['id'];
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
        "reference"       => $_POST['reference']
      
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

  <h2>Add a ADVICE for This newsfeed with your Analysis</h2>

  <h2><?php  $_GET['title'] ?> </h2>
	

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="<?php echo $title; ?>"><?php echo ucfirst($title); ?></label>
    <label for="<?php echo $id; ?>"><?php echo ucfirst($id); ?> </label>
    <label for="topic">Name this Topic </label>
    
    <input type="text" name="topic" id="topic" size="100">

    <label for="description">Write small description</label>
    <input type="text" name="description" id="description" size="600" >
    
    <label for="advice">Add a new advice</label>
    <input type="text" name="advice" id="advice" size="300">
 
    <label for="reference">Add references to your Analysis</label>
    <input type="text" name="reference" id="reference" size="300">
   
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

