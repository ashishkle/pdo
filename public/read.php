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
            FROM users ";
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
<h2>Update users</h2>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email Address</th>
          <th>Age</th>
          <th>Location</th>
          <th>Date</th>
          <th>Related News Feed</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["id"]); ?></td>
          <td><?php echo escape($row["firstname"]); ?></td>
          <td><?php echo escape($row["lastname"]); ?></td>
          <td><?php echo escape($row["email"]); ?></td>
          <td><?php echo escape($row["age"]); ?></td>
          <td><?php echo escape($row["location"]); ?></td>
          <td><?php echo escape($row["date"]); ?> </td>
          <td><a href="cyber-single.php?tag_value=<?php echo escape($row["tag_value"]); ?>">List Cyber Intel</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>