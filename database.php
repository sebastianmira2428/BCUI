<?php
	//$database = new PDO ("mysql:host=localhost;dbname=db_md5", 'root', '' );

	$serverName = 'Reg10dbs23bi\analysis';
	$database = "Pricing";
	// Get UID and PWD from application-specific files.

	try {
	 $conn = new PDO( "sqlsrv:server=$serverName;Database = $database");
	 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
	 $conn->setAttribute(PDO::SQLSRV_ENCODING_SYSTEM, PDO::ERRMODE_EXCEPTION);

	 //$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8, PDO::SQLSRV_ENCODING_SYSTEM );

	// $serverName = "Reg10dbs23bi\analysis";
	// $connectionInfo = array( "Database"=>"Pricing", "CharacterSet" =>"UTF-8");
	// $conn = sqlsrv_connect( $serverName, $connectionInfo);

	}
	catch( PDOException $e ) {
	 die( "Error connecting to SQL Server: $e" );
	}











?>
