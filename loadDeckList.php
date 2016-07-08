<?php
	require_once('db.php');

	// get the q parameter from URL
	$id = $_REQUEST["id"];

	try{
		// SELECT DISTINCT City FROM Customers;
// 		SELECT COUNT(*)   
// FROM (  
// SELECT  DISTINCT agent_code, ord_amount,cust_code  
// FROM orders   
// WHERE agent_code='A002'); 

// SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
// FROM Orders
// INNER JOIN Customers
// ON Orders.CustomerID=Customers.CustomerID;
		// WHERE prod_id &alt;= 5 OR prod_price <= 10;
		// WHERE (vend_id = 1002 OR vend_id = 1003) AND prod_price >= 10;
		// SELECT SUM(column_name) FROM table_name;


	  $statement = $pdo->query("SELECT DISTINCT card_type FROM cards ORDER BY card_type");
	  $types = $statement->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e){
    $display_decklist = "";
	  echo $display_decklist;
    die();
	}

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

	/*
	 list Creature Cards
	 */
  foreach ($pdo->query("SELECT decks_to_cards.qty, cards.card_name, cards.card_image FROM decks_to_cards INNER JOIN cards ON decks_to_cards.card_id=cards.card_id WHERE(cards.card_type = 'Creature' OR cards.card_type = 'Artifact Creature' OR cards.card_type = 'Legendary Creature') AND decks_to_cards.deck_id=$id ORDER BY cards.card_name") as $row) {

  	if (is_int(intval($row['qty']))) {
	  	$counter += intval($row['qty']);
  	}
  	$image = $row['card_image'];
  	$image = "http://static.starcitygames.com/sales/cardscans/MTG/DKA/en/nonfoil/SorinLordOfInnistrad.jpg";
  	// $image = preg_replace('#^https?://#', '', $image);
  	$temp .= $row['qty']." x  <a class='popup' href='$image'>".$row['card_name']."<span><img src='$image'></span></a><br>";
  }	

  // add Creature header
  if ($counter !== 0) {
	  $display_decklist .= buildDeckListString($temp, "Creatures", $counter);
  }

	/*
	 list Planeswalker Cards
	 */
  foreach ($pdo->query("SELECT decks_to_cards.qty, cards.card_name FROM decks_to_cards INNER JOIN cards ON decks_to_cards.card_id=cards.card_id WHERE(cards.card_type = 'Planeswalker') AND decks_to_cards.deck_id=$id ORDER BY cards.card_name") as $row) {

  	if (is_int(intval($row['qty']))) {
	  	$counter += intval($row['qty']);
  	}
  	$temp .= $row['qty']." x ".$row['card_name']."<br>";
  }	

  // add Planeswalker header
  if ($counter !== 0) {
	  $display_decklist .= buildDeckListString($temp, "Planeswalkers", $counter);
  }

	/*
	 list Land Cards
	 */
  foreach ($pdo->query("SELECT decks_to_cards.qty, cards.card_name FROM decks_to_cards INNER JOIN cards ON decks_to_cards.card_id=cards.card_id WHERE(cards.card_type = 'Land' OR cards.card_type = 'Basic Land' OR cards.card_type = 'Land Creature' OR cards.card_type = 'Legendary Land') AND decks_to_cards.deck_id=$id ORDER BY cards.card_name") as $row) {

  	if (is_int(intval($row['qty']))) {
	  	$counter += intval($row['qty']);
  	}
  	$temp .= $row['qty']." x ".$row['card_name']."<br>";
  }	

  // add Land header
  if ($counter !== 0) {
	  $display_decklist .= buildDeckListString($temp, "Lands", $counter);
  }

	/*
	 list Spell Cards
	 */
  foreach ($pdo->query("SELECT decks_to_cards.qty, cards.card_name FROM decks_to_cards INNER JOIN cards ON decks_to_cards.card_id=cards.card_id WHERE(cards.card_type = 'Artifact' OR cards.card_type = 'Enchantment' OR cards.card_type = 'Instant' OR cards.card_type = 'Legendary Artifact' OR cards.card_type = 'Legendary Enchantment' OR cards.card_type = 'Sorcery' OR cards.card_type = 'Tribal Instant') AND decks_to_cards.deck_id=$id ORDER BY cards.card_name") as $row) {

  	if (is_int(intval($row['qty']))) {
	  	$counter += intval($row['qty']);
  	}
  	$temp .= $row['qty']." x ".$row['card_name']."<br>";
  }	

  // add Spell header
  if ($counter !== 0) {
	  $display_decklist .= buildDeckListString($temp, "Spells", $counter);
  }

  echo $display_decklist;
	die();
?>