<?php session_start(); ?>

<!doctype html>
<html lang= "en">
<head>
  <title>PHP Survey</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
</head>
<body>
<?php
  include_once 'views/header.php';
  $result_url = 'survey-results.php';
  if ($_SESSION["voted"] == true) {
    header("Location: " . $result_url);
    //exit();
  }
  else {
    $_SESSION["voted"] = false;
  }
?>

<h2 class="cursive-heading">Survey</h2>
    <form action="survey-results.php" method="post">
      <div class="survey-body">

          <h4 class="cursive">What is your gender?</h4>
            <input type="radio" name="gender" value="male"> Male<br>
            <input type="radio" name="gender" value="female"> Female<br>


          <h4 class="cursive">What is your age?</h4>
            <input type="radio" name="age" value="under_18"> Under 18<br>
            <input type="radio" name="age" value="18_22"> 18 to 22<br>
            <input type="radio" name="age" value="23_29"> 23 to 29<br>
            <input type="radio" name="age" value="over_30"> Over 30<br>

          <h4 class="cursive">Where do you live?</h4>
            <select class="button" name="location">
              <option value="west_coast"> West Coast</option>
              <option value="west"> West</option>
              <option value="midwest"> Midwest</option>
              <option value="south"> South</option>
              <option value="east_coast"> East Coast</option>
              <option value="east"> East</option>
              <option value="new_england"> New England</option>
              <option value="not_unitedstates"> Not in the United States</option>
            </select>

          <h4 class="cursive">What is the size of the city you live in?</h4>
            <input type="radio" name="city_size" value="under5"> Under 5,000<br>
            <input type="radio" name="city_size" value="5_25"> 5,000 to 25,000<br>
            <input type="radio" name="city_size" value="25_100"> 25,000 to 100,000<br>
            <input type="radio" name="city_size" value="over100"> Over 100,000<br>
      </div>
      <div>
        <br>
        <input class="button" type="submit" value="Submit">
      </div>
    </form>

    <br>
    <a href="survey-results.php">DIRECTLY TO SURVEY RESULTS</a>


</body>
</html>
