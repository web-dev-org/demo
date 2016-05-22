<?php
	header('Content-Type:text/html; charset=utf-8');
	error_reporting(E_ALL & ~E_NOTICE);
	
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PWD', '');
	define('DB_NAME', 'traveldesgn');
	define('DB_PREFIX', 'vix_');
	
	$conn = @mysql_connect(DB_HOST, DB_USER, DB_PWD) or die('Date Connect fail：'.mysql_error());
	
	@mysql_select_db(DB_NAME) or die('datebase error：'.mysql_error());
	
	@mysql_query('SET NAMES UTF8') or die('字符集错误：'.mysql_error());
?>