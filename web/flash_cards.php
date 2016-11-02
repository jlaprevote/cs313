<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheets/flash_card.css">
	<title>Flash Cards</title>
</head>

<body>
<div>

<h1>Flash Cards</h1>

<?php
require_once('database.php');

try
{
	// create the PDO connection
	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

	//clear guess table
	$db->exec("DELETE FROM guess");
	//reset sequence
	$db->exec("ALTER SEQUENCE guess_id_seq RESTART WITH 1");

	$statement = $db->prepare("SELECT id, question, answer FROM cards ORDER BY id ASC");
	$statement->execute();

	// display each flashcard
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

$db = null;

?>

<html>
	<body>
		<form action="insert.php" method="post">
			<p>Question: <input type="text" name="question" size="40" length="40" value=""></p>
			<p>Answer: <input type="text" name="answer" size="40" length= "40" value=""></p>
			<input type="submit" name="submit" value="Submit"><br><br>
		</form>
		<form>
			<p>Click to begin your test:
			<input type="button" value="Begin Test" onclick="window.location.href='test.php'"/></p>
		</form>
		<form>
			<p>Click to change a flash card:
			<input type="button" value="Edit/Update" onclick="window.location.href='update.php'"/></p>
		</form>
		<form>
			<p>Click to delete a flash card:
			<input type="button" value="Delete" onclick="window.location.href='delete.php'"/></p>
		</form>
	</body>
</html>

<a href="assignments.php">Back to Assignments Page</a>

</div>

</body>
</html>
