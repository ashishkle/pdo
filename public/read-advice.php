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
            FROM advice ";
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
<h2>Already configured Tags</h2>

    <table>
      <thead>
        <tr>
          <th>Topic </th>
          <th>Analyst's description</th>
          <th>Advice from Cyber Analsyst</th>
          <th>Some references for extra info</th>
          <th>Link to Edit</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["topic"]); ?></td>
          <td><?php echo escape($row["description"]); ?></td>
          <td><?php echo escape($row["advice"]); ?></td>
          <td><?php echo escape($row["reference"]); ?></td>
          <td><a href="update-single.php?tag_value=<?php echo escape($row["tag_value"]); ?>">List Cyber Intel</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>