<?php
$card_id = pg_escape_string($_POST['card_id']);
$delete_all = strcmp("delete",$card_id);

require_once('database.php');

try
{
  // Create the PDO connection
  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

  if ($delete_all === 0) {
    $statement = $db->prepare("DELETE FROM cards");
    $statement->execute();
    $statement = $db->prepare("ALTER SEQUENCE cards_id_seq RESTART WITH 1");
    $statement->execute();

    echo "<script type='text/javascript'>alert('All Cards Deleted')</script>";

  } else {
    $statement = $db->prepare("DELETE FROM cards WHERE cards.id = '$card_id'");
    $statement->execute();

    echo "<script type='text/javascript'>alert('Card Deleted')</script>";
  }

    //after delete, reset order of cards
    $statement = $db->prepare("ALTER SEQUENCE cards_id_seq RESTART WITH 1");
    $statement->execute();

    $statement = $db->prepare("UPDATE cards SET id=nextval('cards_id_seq')");
    $statement->execute();

}
catch (PDOException $ex)
{
  echo "Error connecting to DB. Details: $ex";
  die();
}
?>

<meta http-equiv="refresh" content="0; URL=flash_cards.php">
