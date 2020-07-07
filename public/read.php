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
            FROM on2it_tag ";
            //WHERE location = :location";

    //$location = $_POST['location'];
    $statement = $connection->prepare($sql);
    //$statement->bindParam(':location', $location, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }

?>
<?php require "templates/header.php"; ?>
<h2>Existing Tags</h2>

    <table>
      <thead>
        <tr>
          <th>Existing Tag</th>
          <th>TAG description</th>
          <th>Related News Feed</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["tag_value"]); ?></td>
          <td><?php echo escape($row["description"]); ?></td>
          <td><a href="cyber-single.php?tag_value=<?php echo escape($row["tag_value"]); ?>">List Cyber Intel</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>