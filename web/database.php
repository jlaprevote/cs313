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

?>
