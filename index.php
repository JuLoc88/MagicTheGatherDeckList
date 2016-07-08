<!DOCTYPE html>
<html>
<head>
	<title>Decklist</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="app.css">
</head>
<body>
<?php
  $username   = "db_user";
  $password   = "Ku6Hoo4MJ3";

  try {
      $pdo = new PDO('mysql:host=45.56.114.155:3306;dbname=db', $username, $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }  
?>
<h1>StarCityGames.com Web Developer Test - By: Julian Locke</h1>
<div id="wrapper">
  <div id="sidebar-wrapper">
    <select id="deck-selector" onchange="loadDeckList(this.value)">
      <option selected>- Select a Deck to Display -</option>
      <?php
        foreach ($pdo->query('SELECT deck_id, deck_name FROM decks') as $row) {
          echo "<option value=".$row['deck_id'].">".$row['deck_name'].$row['deck_format']."</option>";
        }
      ?>
    </select>
    <section id="name-format"></section>
    <section id="decklist"></section>
  </div>
  <div id="page-content-wrapper">
      <div class="page-content">
          <div class="container">
              <div id="deck-controls" class="row">
                <div class="col-md-6">
                  <button>New Hand</button>
                  &nbsp;&nbsp;
                  <button>Draw Card</button>
                </div>
              </div>
              <div class="row hand-section">
                <h1 id="hand-title">Sample Hand</h1>
                <div class="col-md-2 card">
                1
                </div>
                <div class="col-md-2 card">
                2
                </div>
                <div class="col-md-2 card">
                3
                </div>
                <div class="col-md-2 card">
                4
                </div>
                <div class="col-md-2 card">
                5
                </div>
                <div class="col-md-2 card">
                6
                </div>
                <div class="col-md-2 card">
                7
                </div>
              </div>
              <div class="row hand-section">
                <h1 id="hand-title">Drawn Cards</h1>
                <div class="col-md-2 card">
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
<script>
function loadDeckList(id) {
  if (!Number.isInteger(parseInt(id))) {
    document.getElementById("name-format").innerHTML = "";
    document.getElementById("decklist").innerHTML = "";
  } else {
    getDeckNameAndFormat(id);
    getDeckList(id);
  }
}

function getDeckNameAndFormat(id){
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("name-format").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "loadDeckNameAndFormat.php?id="+id, true);
  xhttp.send();
}

function getDeckList(id){
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("decklist").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "loadDeckList.php?id="+id, true);
  xhttp.send();
}
</script>
</body>
</html>