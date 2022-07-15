<?php
include "inc_opendb.php";

unset($_SESSION[ USER_EMAIL ]);
unset($_SESSION[ FIRSTNAME ] );
unset($_SESSION[ LASTNAME ]  );
unset($_SESSION[ LOGGED_IN ] );
session_destroy();
header( "location:/" );
?>