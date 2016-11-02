<html>
<head>
  <title>Delete</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/flash_card.css">
</head>
<body>
  <h1>Delete</h1>

  <?php
  require_once('database.php');

  try
  {
  	// Create the PDO connection
  	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

  	// prepare the statement
  	$statement = $db->prepare("SELECT id, question, answer FROM cards");
  	$statement->execute();

	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p class="flex-container">';
		echo '<strong>#' . $row['id'] . '<br>' . $row['question'] . '<br>' . $row['answer'];
		echo '</p>';
	}

  }
  catch (PDOException $ex)
  {
  	echo "Error connecting to DB. Details: $ex";
  	die();
  }

  ?>
  <p>Delete Card</p>
  <form action="delete_db.php" method="post">
    <p>Card #:<input type="text" name="card_id" size="5" length="5" value=""/>
    <input type="submit" name="submit" value="Submit"></p>
    <p>Delete all cards? type "delete"</p>
  </form>
</body>
  <br><a href="flash_cards.php">Back to FlashCard Page</a>

</html>
