<!doctype html>
<html>
<head>
	<title>Scripture List</title>
</head>

<body>
<div>

<h1>Scripture Resources</h1>
<?php
$dbUser = '313db';
$dbPass = '';
$dbName = '313db';
$dbHost = 'localhost';
try
{
	// Create the PDO connection
$db = new PDO("mysql:host=$dbHost;dbName=$dbName", $dbUser, $dbPass);
} catch (PDOException $e) {
    echo "Error connecting to DB. Details: $ex";
    die();
}
$db->query("CREATE TABLE IF NOT EXISTS `topics`
    ( id SERIAL
    , topicName VARCHAR(100)
    , PRIMARY KEY (id)
    )
");

$db->query("TRUNCATE TABLE `topics`");
$db->query("INSERT INTO topics (topicName) VALUES ('faith')");
$db->query("INSERT INTO topics (topicName) VALUES ('sacrifice')");
$db->query("INSERT INTO topics (topicName) VALUES ('charity')");

$db->query("CREATE TABLE IF NOT EXISTS scriptureTopics
    ( id          SERIAL
    , scriptureID BIGINT UNSIGNED
    , topicID     BIGINT UNSIGNED
    , PRIMARY KEY (id)
    , FOREIGN KEY (scriptureID) REFERENCES Scriptures(id)
    , FOREIGN KEY (topicID)     REFERENCES topics(id)
    )
");

if (isset($_POST['book'])) {
    $statement = $db->prepare("INSERT INTO Scriptures (book, chapter, verse, content) VALUES (:b, :ch, :v, :co)");
    $statement->bindValue(':b', $_POST['book'], PDO::PARAM_STR);
    $statement->bindValue(':ch', $_POST['chapter'], PDO::PARAM_STR);
    $statement->bindValue(':v', $_POST['verse'], PDO::PARAM_STR);
    $statement->bindValue(':co', $_POST['content'], PDO::PARAM_STR);
    $statement->execute();
    $id = $pdo->lastInsertId();

    foreach($_POST['topic'] as $t) {
        $statement = $db->prepare("INSERT INTO scriptureTopics (scriptureID, topicID) VALUES (:sid, :tid)");
        $statement->bindValue(':sid', $id, PDO::PARAM_INT);
        $statement->bindValue(':tid', $t, PDO::PARAM_INT);
        $statement->execute();
    }

    header("Location: ./database.php");
    die();
}
$statement = $db->prepare("SELECT * FROM topics");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$topics = '';
foreach($rows as $row) {
    $topics .= '<p><input type="checkbox" name="topic[]" value="'.$row['id'].'" />'.$row['topicName'].'</p>';
}
?>
<!doctype html>
    <html>
<head>
    <title></title>
</head>
<body>
    <form action="scripture.php" method="post">
        <p>Book</p>
        <p><input type="text" name="book" /></p>
        <p>Chapter</p>
        <p><input type="text" name="chapter" /></p>
        <p>Verse</p>
        <p><input type="text" name="verse" /></p>
        <p>Content</p>
        <p><textarea name="content"></textarea></p>
        <p>Topics</p>
        <?php echo $topics; ?>
        <p><input type="submit" name="Submit Verse" /></p>
    </form>
</body>
    </html>
