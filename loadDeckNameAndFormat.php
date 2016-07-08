<?php
	require_once('db.php');

	// get the q parameter from URL
	$id = $_REQUEST["id"];

	try{
		// get the deck name and format
	  $statement = $pdo->query("SELECT deck_name, deck_format FROM decks WHERE deck_id = ".$id);
	  $row = $statement->fetch(PDO::FETCH_ASSOC);

	  // build return string
	  $display_name_format = "<h5 id='deck-name'>Deck Name: ".$row['deck_name']."</h5>";
	  $display_name_format .= "<h5 id='deck-format'>Format: ".$row['deck_format']."</h5>";

	  echo $display_name_format;
	  $pdo = null;
	  die();
	} catch (PDOException $e){
    $display_name_format = "";
	  echo $display_name_format;
	  $pdo = null;
    die();
	}
?>