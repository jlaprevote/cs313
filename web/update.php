<html>
<head>
  <title>Edit/Update</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/flash_card.css">
</head>
<body>
  <h1>Edit/Update</h1>

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
  <p>Update Card</p>
  <form action="update_db.php" method="post">
    <p>Card #:<input type="text" name="card_id" size="3" length="3" value=""/></p>
    <p>Question:<input type="text" name="question" size="40" length="40" value=""/></p>
    <p>Answer:<input type="text" name="answer" size="40" length= "40" value=""/></p>
    <input type="submit" name="submit" value="Submit"><br>
  </form>
  <br><a href="flash_cards.php">Back to FlashCard Page</a>


</body>
</html>
