<?php 
	require_once('db.php');

	// get the q parameter from URL
	$id = $_REQUEST["id"];

  // card counter
  $counter = 0;
	$deck = [];

  // Not using best pratices here, but we know what the data is going to be
  foreach ($pdo->query("SELECT decks_to_cards.qty, cards.card_name, cards.card_image FROM decks_to_cards INNER JOIN cards ON decks_to_cards.card_id=cards.card_id WHERE decks_to_cards.deck_id=$id ORDER BY cards.card_name") as $row) {

  	if (is_int(intval($row['qty']))) {
  		for ($i=0; $i < intval($row['qty']); $i++) { 
  			array_push($deck, $row['card_image']);
  		}
  	}
  }	

	echo json_encode($deck);
  $pdo = null;
	die();
?>
