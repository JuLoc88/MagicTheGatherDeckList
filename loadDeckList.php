<?php
	require_once('db.php');

	// get the q parameter from URL
	$id = $_REQUEST["id"];

  // build return string
  $temp = "";
  $display_decklist = "";

  // card counter
  $counter = 0;


  function buildDeckListString(&$temp, $card_type, &$counter){
	  $str = "<h4>$card_type ($counter)</h2>".$temp;
	  $temp = "";
	  $counter = 0;
	  return $str;
  }

	try{
		/***********************
		 * LIST CREATURE CARDS *
		 ***********************/
	  foreach ($pdo->query("SELECT decks_to_cards.qty, cards.card_name, cards.card_image FROM decks_to_cards INNER JOIN cards ON decks_to_cards.card_id=cards.card_id WHERE(cards.card_type = 'Creature' OR cards.card_type = 'Artifact Creature' OR cards.card_type = 'Legendary Creature') AND decks_to_cards.deck_id=$id ORDER BY cards.card_name") as $row) {

	  	if (is_int(intval($row['qty']))) {
		  	$counter += intval($row['qty']);
	  	}
	  	$image = $row['card_image'];
	  	$temp .= $row['qty']." x  <a class='popup' href='$image'>".$row['card_name']."<span><img src='$image'></span></a><br>";
	  }	

	  // add Creature header
	  if ($counter !== 0) {
		  $display_decklist .= buildDeckListString($temp, "Creatures", $counter);
	  }

		/***************************
		 * LIST PLANESWALKER CARDS *
		 ***************************/

	  foreach ($pdo->query("SELECT decks_to_cards.qty, cards.card_name, cards.card_image FROM decks_to_cards INNER JOIN cards ON decks_to_cards.card_id=cards.card_id WHERE(cards.card_type = 'Planeswalker') AND decks_to_cards.deck_id=$id ORDER BY cards.card_name") as $row) {

	  	if (is_int(intval($row['qty']))) {
		  	$counter += intval($row['qty']);
	  	}
	  	$image = $row['card_image'];
	  	$temp .= $row['qty']." x  <a class='popup' href='$image'>".$row['card_name']."<span><img src='$image'></span></a><br>";
	  }	

	  // add Planeswalker header
	  if ($counter !== 0) {
		  $display_decklist .= buildDeckListString($temp, "Planeswalkers", $counter);
	  }

		/*******************
		 * LIST LAND CARDS *
		 *******************/

	  foreach ($pdo->query("SELECT decks_to_cards.qty, cards.card_name, cards.card_image FROM decks_to_cards INNER JOIN cards ON decks_to_cards.card_id=cards.card_id WHERE(cards.card_type = 'Land' OR cards.card_type = 'Basic Land' OR cards.card_type = 'Land Creature' OR cards.card_type = 'Legendary Land') AND decks_to_cards.deck_id=$id ORDER BY cards.card_name") as $row) {

	  	if (is_int(intval($row['qty']))) {
		  	$counter += intval($row['qty']);
	  	}
	  	$image = $row['card_image'];
	  	$temp .= $row['qty']." x  <a class='popup' href='$image'>".$row['card_name']."<span><img src='$image'></span></a><br>";
	  }	

	  // add Land header
	  if ($counter !== 0) {
		  $display_decklist .= buildDeckListString($temp, "Lands", $counter);
	  }

		/********************
		 * LIST SPELL CARDS *
		 ********************/
		
	  foreach ($pdo->query("SELECT decks_to_cards.qty, cards.card_name, cards.card_image FROM decks_to_cards INNER JOIN cards ON decks_to_cards.card_id=cards.card_id WHERE(cards.card_type = 'Artifact' OR cards.card_type = 'Enchantment' OR cards.card_type = 'Instant' OR cards.card_type = 'Legendary Artifact' OR cards.card_type = 'Legendary Enchantment' OR cards.card_type = 'Sorcery' OR cards.card_type = 'Tribal Instant') AND decks_to_cards.deck_id=$id ORDER BY cards.card_name") as $row) {

	  	if (is_int(intval($row['qty']))) {
		  	$counter += intval($row['qty']);
	  	}
	  	$image = $row['card_image'];
	  	$temp .= $row['qty']." x  <a class='popup' href='$image'>".$row['card_name']."<span><img src='$image'></span></a><br>";
	  }	

	  // add Spell header
	  if ($counter !== 0) {
		  $display_decklist .= buildDeckListString($temp, "Spells", $counter);
	  }

	  echo $display_decklist;
	  $pdo = null;
		die();
	} catch (PDOException $e){
    $display_decklist = "";
	  echo $display_decklist;
	  $pdo = null;
    die();
	}
?>