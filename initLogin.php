<?php
require "DBConnect.php";

$login = $_POST['username'];
$senha = $_POST['password'];

$DBConnect = new DBConnect();

if (isset($_POST['login']) && !empty($login) && !empty($senha)) {
	$currentDate = new DateTime();
	$_SESSION['valid'] = true;
	$_SESSION['timestamp'] = $currentDate->format('Y-m-d H:i:s');
	$_SESSION['username'] = $login;

	$status = $DBConnect->initDBConnection();
	if (!!$status) {
		$DBConnect->selectAllData();
	}
}
?>
