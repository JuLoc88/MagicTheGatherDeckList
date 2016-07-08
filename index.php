<!DOCTYPE html>
<html>
<head>
	<title>Decklist</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="app.css">
  <script type="text/javascript" src="app.js"></script>
</head>
<body>
<h1>StarCityGames.com Web Developer Test - By: Julian Locke</h1>
<div id="wrapper">
  <div id="sidebar-wrapper">
    <select id="deck-selector" onchange="loadDeckList(this.value)">
      <option value="false" selected>- Select a Deck to Display -</option>
      <?php include ('loadSelector.php') ?>
    </select>
    <section id="name-format"></section>
    <section id="decklist"></section>
  </div>
  <div id="page-content-wrapper">
      <div class="page-content">
          <div class="container">
              <div id="deck-controls" class="row">
                <div class="col-md-6">
                  <button onclick="getHand()">New Hand</button>
                  &nbsp;&nbsp;
                  <button onclick="getDraw()">Draw Card</button>
                </div>
              </div>
              <div id="hand" class="row hand-section">
                <h1 id="hand-title">Sample Hand</h1>
                <div class="col-md-2 card"></div>
              </div>
              <div id="draw" class="row hand-section">
                <h1 id="hand-title">Drawn Cards</h1>
                <div class="col-md-2 card"></div>
              </div>
          </div>
      </div>
  </div>
</div>
</body>
</html>