<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
  <title>PHP Survey Results</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="stylesheet/css" href="stylesheets/main.css">
</head>
<body>
<?php
  include 'views/header.php';

  if (isset($_POST["gender"])) {
    $_SESSION["voted"] = true;
  }
 ?>

<h2 class ="cursive-heading">Survey Results</h2>

<?php

  file_put_contents("results.txt",$_POST["gender"],FILE_APPEND);
  file_put_contents("results.txt"," ",FILE_APPEND);
  file_put_contents("results.txt",$_POST["age"],FILE_APPEND);
  file_put_contents("results.txt"," ",FILE_APPEND);
  file_put_contents("results.txt",$_POST["location"],FILE_APPEND);
  file_put_contents("results.txt"," ",FILE_APPEND);
  file_put_contents("results.txt",$_POST["city_size"],FILE_APPEND);
  file_put_contents("results.txt"," ",FILE_APPEND);

  $results = file_get_contents("results.txt");
  $results_array = explode(" ", $results);

  $countMale = 0;
  $countFemale = 0;

  $countU_18 = 0;
  $count18_22 = 0;
  $count23_29 = 0;
  $countO_30 = 0;

  $countWestCoast = 0;
  $countWest = 0;
  $countMidwest = 0;
  $countSouth = 0;
  $countEastCoast = 0;
  $countEast = 0;
  $countNewEngland = 0;
  $countNotUnitedstates = 0;

  $countU_5 = 0;
  $count5_25 = 0;
  $count25_100 = 0;
  $countO_100 = 0;

  for ($num = 0; $num < sizeof($results_array); $num++)
  {
    if ($results_array[$num] == "male")
      $countMale++;
    if ($results_array[$num] == "female")
      $countFemale++;
    if ($results_array[$num] == "under_18")
      $countU_18++;
    if ($results_array[$num] == "18_22")
      $count18_22++;
    if ($results_array[$num] == "23_29")
      $count23_29++;
    if ($results_array[$num] == "over_30")
      $countO_30++;
    if ($results_array[$num] == "west_coast")
      $countWestCoast++;
    if ($results_array[$num] == "west")
      $countWest++;
    if ($results_array[$num] == "midwest")
      $countMidwest++;
    if ($results_array[$num] == "south")
      $countSouth++;
    if ($results_array[$num] == "east_coast")
      $countEastCoast++;
    if ($results_array[$num] == "east")
      $countEast++;
    if ($results_array[$num] == "new_england")
      $countNewEngland++;
    if ($results_array[$num] == "not_unitedstates")
      $countNotUnitedstates++;
    if ($results_array[$num] == "under5")
      $countU_5++;
    if ($results_array[$num] == "5_25")
      $count5_25++;
    if ($results_array[$num] == "25_100")
      $count25_100++;
    if ($results_array[$num] == "over100")
      $countO_100++;
  }

  $countGender = $countMale + $countFemale;
  $countAge = $countU_18 + $count18_22 + $count23_29 + $countO_30;
  $countLocation = $countWestCoast + $countWest + $countMidwest + $countSouth +
    $countEastCoast + $countEast + $countNewEngland + $countNotUnitedstates;
  $countCitySize = $countU_5 + $count5_25 + $count25_100 + $countO_100;

 ?>
<div class="survey-body">
 <h4 class="cursive">Gender Results</h4>
 <?php
    echo "$countMale of you are male <br>";
    echo "$countFemale of you are female <br>";
?>
  <h4 class="cursive">Age Results</h4>
  <?php
    echo "$countU_18 of you are under 18 years old <br>";
    echo "$count18_22 of you are between 18 and 22 years old <br>";
    echo "$count23_29 of you are between 23 and 29 years old <br>";
    echo "$countO_30 of you are over 30 years old <br>";
?>
  <h4 class="cursive">Location Results</h4>
  <?php
    echo "$countWestCoast of you live on the west coast <br>";
    echo "$countWest of you live out west <br>";
    echo "$countMidwest of you live in the midwest <br>";
    echo "$countSouth of you live down south <br>";
    echo "$countEastCoast of you live on the east coast <br>";
    echo "$countEast of you live back east <br>";
    echo "$countNewEngland of you live in new england <br>";
    echo "$countNotUnitedstates of you don't live in the US <br>";
?>
  <h4 class="cursive">City Size Results</h4>
  <?php
    echo "$countU_5 of you live in a small town with under 5,000 people <br>";
    echo "$count5_25 of you live in a small city with between 5,000 and 25,000 people <br>";
    echo "$count25_100 of you live in a city with between 25,000 and 100,000 people <br>";
    echo "$countO_100 of you live in a large city with over 100,000 people <br>";

?>
</div>

</body>
</html>
