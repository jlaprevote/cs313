  <?php
  $card_id = pg_escape_string($_POST['card_id']);
  $question = pg_escape_string($_POST['question']);
  $answer = pg_escape_string($_POST['answer']);

  require_once('database.php');

  try
  {
  	// Create the PDO connection
  	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

  	// prepare the statement
  	$statement = $db->prepare("UPDATE cards SET (question, answer) = ('$question','$answer') WHERE id = '$card_id'");
  	$statement->execute();

  }
  catch (PDOException $ex)
  {
  	echo "Error connecting to DB. Details: $ex";
  	die();
  }
  ?>
<script type='text/javascript'>alert('Card Updated')</script>

<meta http-equiv="refresh" content="0; URL=flash_cards.php">
