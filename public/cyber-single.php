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
    $tag_value = $_GET['tag_value'];
    $sql = "SELECT id, on2itcontext, title , SUBSTRING(newsfeed, 10, 300) as newsfeed, link,tags,pub_date
            FROM on2it_context
            WHERE newsfeed regexp :tag_value"; 


    $statement = $connection->prepare($sql);
    $statement->bindParam(':tag_value', $tag_value, PDO::PARAM_STR);
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
          <th>Analyse and Advice</th>
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
        <tr >
        <td><a href="advisory-single.php?id=<?php echo escape($row["id"]); ?>&title=<?php echo escape($row["title"]); ?>">Add Advisory</a></td>
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