<html>
  <body>
    <?php
      $guess_answer = pg_escape_string($_POST['guess_answer']);
      $card_id = pg_escape_string($_POST['card_id']);

      require_once('database.php');

      try
      {
	        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

          //delete duplicate answer
          $db->exec("DELETE FROM guess WHERE card_id = '$card_id'");

  	      $statement = $db->prepare("SELECT answer FROM cards WHERE cards.id = '$card_id'");
  	      $statement->execute();
          $row = $statement->fetch(PDO::FETCH_ASSOC);
          $answer = $row['answer'];


          $is_correct = strcmp(strtolower($guess_answer),strtolower($answer));

          $db->exec("INSERT INTO guess(id, card_id, guess_answer, is_correct) VALUES (DEFAULT, '$card_id', '$guess_answer', '$is_correct')");

      }
      catch (PDOException $ex)
      {
	       echo "Error connecting to DB. Details: $ex";
	        die();
      }

    ?>

  </body>
</html>

<?php echo '<meta http-equiv="refresh" content="0; URL=test.php">'; ?>
