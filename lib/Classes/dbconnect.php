<?php
class dbconnect {

	function Connect() {

		require PATH.BASE_URL.'/config_202.php';
		$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
		return $db = new PDO($dsn, $username, $password);
	}
}
?>