<?php
session_start();

include('database.php');
	$inventory_sale_id = $_GET["inventory_sale_id"];
	$session = $_SESSION['db'];

	//echo $session;

	$query = $conn->prepare('select InventorySaleID from '.$session.' where iscurrent = 1 and sent = 1 and InventorySaleID = ?');
	$query->execute(array($inventory_sale_id));
	$rows = $query->fetchAll();
	$num_rows = count($rows);

	if ($num_rows > 0) {
		echo "1";
	} else {
		echo "0";
	}
?>



