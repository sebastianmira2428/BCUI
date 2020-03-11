<?php

if (isset($_POST['submit'])) {
	if ($_POST['username'] == 'test' && $_POST['password'] == '12345') {
		session_start();
		$_SESSION['isLogin'] = true;
		header("Location: home.php");
		die();
	}
	else {
		header("Location: index.php");
		die();
	}
}
else {
	header("Location: index.php");
	die();
}
?>