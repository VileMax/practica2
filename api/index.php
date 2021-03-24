<?php
/**
 * Core bootloader
 *
 * @author Serhii Shkrabak
 */

/* RESULT STORAGE */
$RESULT = [
	'state' => 0,
	'data' => [],
	'debug' => []
];

/* ENVIRONMENT SETUP */
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/'); // Unity entrypoint;

register_shutdown_function('shutdown', 'OK'); // Unity shutdown function

spl_autoload_register('load'); // Class autoloader

set_exception_handler('handler'); // Handle all errors in one function

/* HANDLERS */

/*
 * Class autoloader
 */
function load (String $class):void {
	$class = strtolower(str_replace('\\', '/', $class));
	$file = "$class.php";
	if (file_exists($file))
		include $file;
}

/*
 * Error logger
 */
function handler (Throwable $e):void {
	global $RESULT;
	$codes = [0 => 'lol', 1 => 'REQUEST_INCOMPLETE', 2 => 'REQUEST_INCORRECT', 4 => 'RESOURCE_LOST', 6 => 'INTERNAL_ERROR'];
	while($e!==null){
		$message = $codes[$e -> getCode()];
		$code = $e -> getCode();
		$RESULT['state'] = (isset($codes[$code])) ? $code : 6;
		$RESULT[ 'errors' ][] = [
			'state' => $code,
			'details' => $message,
			'data' => $e -> getMessage()
			];
		$RESULT[ 'debug' ][] = [
			'type' => get_class($e),
			'details' => $message,
			'file' => $e -> getFile(),
			'line' => $e -> getLine(),
			'trace' => $e -> getTrace()
			];
		
		$e = $e -> getPrevious();
	}
}
/*
 * Shutdown handler
 */
function shutdown():void {
	global $RESULT;
	$error = error_get_last();
	if ( ! $error ) {
		header("Content-Type: application/json");
		echo json_encode($GLOBALS['RESULT'], JSON_UNESCAPED_UNICODE);
	}
}

$CORE = new Controller\Main;
$data = $CORE->exec();

if ($data !== null)
	$RESULT['data'] = $data;
else { // Error happens
	throw new \Exception('data', 4);
}
