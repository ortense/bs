<?php
function db_connect($config) {
	
	$connection = new mysqli(
		$config['db']['server'],
		$config['db']['user'],
		$config['db']['password'],
		$config['db']['database']
	);

	return $connection;
}