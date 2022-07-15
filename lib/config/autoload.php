<?php
function autoload($class) {

	if (file_exists(PATH . BASE_URL . LIBS_PATH . $class . ".php")) {
		require PATH . BASE_URL . LIBS_PATH . $class . ".php";
	} else {       
		exit('The file ' . $class . '.php is missing in the libs folder.');
	}
}
spl_autoload_register("autoload");
