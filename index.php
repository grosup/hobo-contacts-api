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

// Get the API method
$method = get_method();

// GET request
// Get some data and respond with it
if ($method === 'GET') {
	
	// Read the JSON file
	$json = file_get_contents('contacts.json'); 

	// Check if the file was read successfully
	if ($json === false) {
		send_response([
			'message' => 'Error reading the JSON file',
		], "500");
	}

	// Decode the JSON file
	$json_data = json_decode($json, true); 

	// Check if the JSON was decoded successfully
	if ($json_data === null) {
		send_response([
			'message' => 'Error decoding the JSON file',
		], "500");
	}


	// You'd normally do stuff here...
	// Let's just send back a success message
	send_response($json_data);

}