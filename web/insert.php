<html>
  <body>
    <?php
      $question = pg_escape_string($_POST['question']);
      $answer = pg_escape_string($_POST['answer']);
      $default_id = 'DEFAULT';

      printf("The values are: %s %s", $question, $answer);

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
	        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

          $db->exec("INSERT INTO cards(id, question, answer) VALUES (DEFAULT, '$question', $answer)");

          	$statement = $db->prepare("SELECT question, answer FROM cards");
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
  </body>
</html>
