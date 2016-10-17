<!doctype html>
<html>
<head>
	<title>Flash Cards</title>
</head>

<body>
<div>

<h1>Flash Cards</h1>

<?php
include 'db.php';

try
{
	// Create the PDO connection
	$db = new PDO("postgres:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

	// prepare the statement
	$statement = $db->prepare('SELECT question, answer FROM cards');
	$statement->execute();

	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['question'] . ' ' . $row['answer'];
		echo '</p>';
	}

}
catch (PDOException $ex)
{
	echo "Error connecting to DB. Details: $ex";
	die();
}

?>

</div>

</body>
</html>
