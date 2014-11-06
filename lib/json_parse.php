<?php 
function json_parse($data) {
	header('Content-Type: application/json; charset=utf-8');
	return json_encode($data);
}