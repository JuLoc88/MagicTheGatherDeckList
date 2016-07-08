<?php
	require_once('db.php');

  foreach ($pdo->query('SELECT deck_id, deck_name FROM decks') as $row) {
    echo "<option value=".$row['deck_id'].">".$row['deck_name'].$row['deck_format']."</option>";
  }
  $pdo = null;
?>