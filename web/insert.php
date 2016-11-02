<html>
  <body>
    <?php
      $question = pg_escape_string($_POST['question']);
      $answer = pg_escape_string($_POST['answer']);

      require_once('database.php');

      try
      {
	        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

          $db->exec("INSERT INTO cards(id, question, answer) VALUES (DEFAULT, '$question', '$answer')");

      }
      catch (PDOException $ex)
      {
	       echo "Error connecting to DB. Details: $ex";
	        die();
      }

    ?>
  </body>
</html>

<meta http-equiv="refresh" content="0; URL=flash_cards.php">
