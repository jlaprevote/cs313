<html>
<head>
  <title>Test</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/flash_card.css">
</head>
<body>
  <h1>Test</h1>

  <?php
  require_once('database.php');

  try
  {
  	// Create the PDO connection
  	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

    //reset card sequence
    $db->exec("ALTER SEQUENCE cards_id_seq RESTART WITH 1");
    $db->exec("UPDATE cards SET id=nextval('cards_id_seq')");

  	$statement = $db->prepare("SELECT id, question FROM cards ORDER BY id ASC");
  	$statement->execute();

	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p class="flex-container">';
		echo '<strong>#' . $row['id'] . '<br>' . $row['question'];
		echo '</p>';
	}

  }
  catch (PDOException $ex)
  {
  	echo "Error connecting to DB. Details: $ex";
  	die();
  }

  ?>
  <p>Enter Card no. and your Answer</p>
  <form action="test_db.php" method="post">
    <p>Card #:<input type="text" name="card_id" size="3" length="3" value=""/></p>
    <p>Answer:<input type="text" name="guess_answer" size="40" length= "40" value=""/></p>
    <input type="submit" name="submit" value="Submit"><br>
  </form>

  <?php
    $statement = $db->prepare("SELECT card_id FROM guess ORDER BY card_id ASC");
    $statement->execute();

    echo '<p>Duplicate answers will be overwritten!</p>';
    echo '<p>Answers submited: ';

    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      echo '<strong>#' . $row['card_id'] . '   ';
    }
    echo '</p>';

    $num_correct = 0;

    $statement = $db->prepare("SELECT is_correct FROM guess");
    $statement->execute();

    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      if ($row['is_correct'] == 0) {
        $num_correct = $num_correct + 1;
      }
    }

    echo '<p>There are ' . $num_correct . ' answer(s) correct</p>';
  ?>

  <br><br><a href="flash_cards.php">Back to FlashCard Page</a>


</body>
</html>
