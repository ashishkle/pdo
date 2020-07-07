<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

require "../config.php";
require "../common.php";


  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * 
            FROM on2it_context
            WHERE newsfeed regexp :tag_value"; 

    $newsfeed = $_POST['tag_value'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':tag_value', $newsfeed, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
?>
<?php require "templates/header.php"; ?>
        
    <h2>Related Cyber Intel</h2>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>ON2IT CONTEXT</th>
          <th>Title</th>
          <th>NewdFeed</th>
          <th>Link</th>
          <th>Tag</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["id"]); ?></td>
          <td><?php echo escape($row["on2itcontext"]); ?></td>
          <td><?php echo escape($row["title"]); ?></td>
          <td><?php echo escape($row["newsfeed"]); ?></td>
          <td><?php echo escape($row["link"]); ?></td>
          <td><?php echo escape($row["tags"]); ?></td>
          <td><?php echo escape($row["pub_date"]); ?></td>
          </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>