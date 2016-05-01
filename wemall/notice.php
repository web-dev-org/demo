<?php
header("Content-type: text/html; charset=utf-8");

if (ini_get('magic_quotes_gpc')) {
	function stripslashesRecursive(array $array){
		foreach ($array as $k => $v) {
			if (is_string($v)){
				$array[$k] = stripslashes($v);
			} else if (is_array($v)){
				$array[$k] = stripslashesRecursive($v);
			}
		}
		return $array;
	}
	$_GET = stripslashesRecursive($_GET);
	$_POST = stripslashesRecursive($_POST);
}

file_put_contents('aaa.txt',json_encode($_GET));

$_GET['g'] = 'App';
$_GET['m'] = 'Cart';
$_GET['a'] = 'new_return_url';

$array_data = json_decode(json_encode(simplexml_load_string($GLOBALS['HTTP_RAW_POST_DATA'], 'SimpleXMLElement', LIBXML_NOCDATA)), true);

$_GET['out_trade_no'] = $array_data['out_trade_no'];
$_GET['total_fee'] = $array_data['total_fee'];
$_GET['trade_state'] = $array_data['result_code'];
$_GET['transaction_id'] = $array_data['transaction_id'];
$get_arr = explode('&',$array_data['attach']);
foreach($get_arr as $value){
	$tmp_arr = explode('=',$value);
	$_GET[$tmp_arr[0]] = $tmp_arr[1];
}


//ThinkPHP初始化
if (file_exists ( './Install/install.lock' )) {

	define ( 'APP_NAME', 'Application' );
	
	define( 'APP_SITE', getcwd());
	
	define ( 'APP_PATH', APP_SITE.'/Application/' );
	
	define ( 'APP_DEBUG', true );

	require './Core/index.php';
}else{
	header("location:./Install/index.php");
}
?>

<?php

$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
logger2($postStr);

?>