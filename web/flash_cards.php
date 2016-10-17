<!doctype html>
<html>
<head>
	<title>Flash Cards</title>
</head>

<body>
<div>

<h1>Flash Cards</h1>

<?php
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
  $dbUrl = "postgres://postgres:password@localhost:5432/flash_cards";
}
$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPass = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

try
{
	// Create the PDO connection
	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

	// prepare the statement
	$statement = $db->prepare('SELECT question, answer FROM cards');
	$statement->execute();

	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['question'] . '<br>' . $row['answer'];
		echo '</p>';
	}

}
catch (PDOException $ex)
{
	echo "Error connecting to DB. Details: $ex";
	die();
}

?>

<a href="assignments.php">Back to Assignments Page</a>

</div>

</body>
</html>
