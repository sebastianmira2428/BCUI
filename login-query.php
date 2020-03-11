
<?php
include('database.php');

$email = $_POST['email'];
$password = $_POST['password'];

$query = $conn->query("Select * from BCA.Checking_Login where Chk_Username = '$email' and Chk_Password ='$password' ");
$count = $query->fetchColumn();
$row = $query->nextrowset();
$row = $query->fetch();
$_SESSION['access'] = '';
$_SESSION['user'] = '';


if ($count > 0){

	session_start();
	$_SESSION['id'] = $row['id'];
	$_SESSION['isLogin'] = true;

	$_SESSION['environment'] = '';
	$_SESSION['db'] = '';
	$_SESSION['auditdb'] = '';

	// ----- CHANGE SESSION HERE  ----- //
	//$_SESSION['environment'] = 'dev';
	$_SESSION['environment'] = 'live';

	header("Location: tab_invoice_review.php?user=".$email);

	$auditDb = '';

	if ($_SESSION['environment'] == 'live'){
		$auditDb = "BCA.Checking_Audit_Log";
		$_SESSION['db'] = 'BCA.Commission_Data_1';
		$_SESSION['auditdb'] = 'BCA.Checking_Audit_Log';
	} else {
		$auditDb = "BCA.TESTChecking_Audit_Log";
		$_SESSION['db'] = 'BCA.TESTCommission_Data_1';
		$_SESSION['auditdb'] = 'BCA.TESTChecking_Audit_Log';
	}

	$query = $conn->prepare('Select * from BCA.Checking_Login where Chk_Username = ?');
	$query->execute(array($email));
	$result1 = $query->fetch(PDO::FETCH_LAZY, 0);
	$Chk_Name = $result1['Chk_Name'];
	$Chk_Username = $result1['Chk_Username'];
	$Chk_Position = $result1['Chk_Position'];

	$_SESSION['position'] = $result1['Chk_Position'];
	$_SESSION['name'] = $result1['Chk_Name'];
	$_SESSION['access'] = $result1['Chk_Access_Level'];
	$_SESSION['user'] = $result1['Chk_Username'];

	$save_db = $conn->query("INSERT INTO ".$auditDb." (Chk_Name, Chk_Username, Chk_Position, Chk_Log_Description, Chk_Log_Time) VALUES ('$Chk_Name', '$Chk_Username', '$Chk_Position', 'Logged in to the system', getdate());");

}else{
	//Redirect back to main page
	echo '<script language="javascript">';
	echo 'alert("Invalid Username/Password")';
	echo '</script>';

	if ($_SESSION['environment'] == 'live'){
		//print("<script>window.location = 'http://10.254.250.189/--LIVE--/regus.bca/index.php';</script>");
		//note: this IP is on glenns pc!
		print("<script>window.location = 'http://10.254.248.250:8080/--LIVE--/regus.bca/index.php';</script>");

	} else {
		// ----- FOR LOCAL HOST GLENN CHANGE SESSION HERE  ----- //
		//print("<script>window.location = 'http://localhost:8080/--Development--/regus-bca/index.php';</script>");
		//note: this IP is on glenns pc!
		print("<script>window.location = 'http://10.254.248.250:8080/--LIVE--/regus.bca/index.php';</script>");
	}
 	die();
}
?>
