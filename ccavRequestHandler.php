<?php
include "inc_opendb.php";
//error_reporting( E_ALL );
//ini_set( 'display_errors', 1 );
?>
<html>
<head>
	<title>Autorent</title>
</head>
<body>
<center>
	<?php include( 'Crypto.php' ) ?>
	<?php
	//	error_reporting(0);
	$merchant_data = '';
	$working_key   = PG_WORKINGKEY; //Shared by CCAVENUES
	$access_code   = PG_ACCESSCODE; //Shared by CCAVENUES

	foreach ( $_POST as $key => $value )
	{
		$merchant_data .= $key . '=' . $value . '&';
	}
	$encrypted_data = encrypt( $merchant_data, $working_key ); // Method for encrypting the data.
	?>
	<form method="post" name="redirect" action="https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction">
<!--	<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">-->
		<?php
		echo "<input type=hidden name=encRequest value=$encrypted_data>";
		echo "<input type=hidden name=access_code value=$access_code>";
		//echo "<pre>";
		//print_r($encrypted_data);
		//echo "<br>";
		//print_r($access_code);
		//echo "</pre>";
		?>
	</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>