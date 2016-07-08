
function loadDeckList(id) {
  if (!Number.isInteger(parseInt(id))) {
    document.getElementById("name-format").innerHTML = "";
    document.getElementById("decklist").innerHTML = "";
  } else {
    getDeckNameAndFormat(id);
    getDeckList(id);
    getHand();
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

function getHand(){
  $id = document.getElementById("deck-selector").value;

  if (!Number.isInteger(parseInt($id))) {
    document.getElementById("hand").innerHTML = "<h1 id='hand-title'>Sample Hand</h1>";
    alert("Please Select A Deck");
  } else {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        drawn = [];
        document.getElementById("draw").innerHTML = "<h1 id='hand-title'>Drawn Cards</h1>";
        document.getElementById("draw").innerHTML += "<div class='col-md-2 card'></div>";

        deck = JSON.parse(xhttp.responseText);
        var hand = [];

        deck.sort(function() { return 0.5 - Math.random() });
        for (var i = 0; i < 7; i++) { hand.push(deck.shift()); }

        var strBuilder = "";
        strBuilder += "<h1 id='hand-title'>Sample Hand</h1>";

        for (var i = 0; i < hand.length; i++) { 
          strBuilder += "<span class='popup'><img class='card' src='"+hand[i]+"'/><span><img src='"+hand[i]+"'></span></span>";
        }
        
        document.getElementById("hand").innerHTML = strBuilder;
      }
    };
    xhttp.open("GET", "createDeck.php?id="+$id, true);
    xhttp.send();
  }
}

function getDraw(){
  $id = document.getElementById("deck-selector").value;

  if (!Number.isInteger(parseInt($id))) {
    document.getElementById("draw").innerHTML = "<h1 id='hand-title'>Drawn Cards</h1>";
    deck = [];
    drawn = [];
    alert("Please Select A Deck");
  } else {
    if (deck.length !== 0) {
      drawn.push(deck.shift());
      console.log(deck.length);

      var strBuilder = "";
      strBuilder += "<h1 id='hand-title'>Drawn Cards</h1>";

      for (var i = 0; i < drawn.length; i++) { 
        strBuilder += "<span class='popup'><img class='card' src='"+drawn[i]+"'/><span><img src='"+drawn[i]+"'></span></span>";
      }
      
      document.getElementById("draw").innerHTML = strBuilder;
    } else {
      alert("Ran out of cards to draw. Deck is empty!");
    }
  }
}

deck = [];
drawn = [];