<?php

/**
 * Get the API method
 * @return String The API method
 */
function get_method () {
	return $_SERVER['REQUEST_METHOD'];
}

/**
 * Send an API response
 * @param  *       $response The API response
 * @param  integer $code     The response code
 * @param  boolean $encode   If true, encode response
 */
function send_response ($response, $code = 200) {
	http_response_code($code);
	die(json_encode($response));
}


$method = get_method();

if ($method === 'GET') {
	$json = file_get_contents('contacts.json'); 
	if ($json === false) {
		send_response([
			'message' => 'Error reading the JSON file',
		], "500");
	}
	$json_data = json_decode($json, true); 
	if ($json_data === null) {
		send_response([
			'message' => 'Error decoding the JSON file',
		], "500");
	}

	send_response($json_data);
}