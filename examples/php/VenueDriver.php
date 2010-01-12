<?php

$username = 'venuesite';
$password = 'password';
$account_id = 914358341; // Test account ID, change this to your desired venue.

//$server = 'venuedriver.com'
$server = 'localhost:3000'; // For testing.

require_once ('ActiveResource.php');
define ('SERVICE_URL', "http://$username:$password@$server/api/");

class Guest extends ActiveResource {
    var $site = SERVICE_URL;
}

class Reservation extends ActiveResource {
    var $site = SERVICE_URL;
}

// special convenience action for getting a list of events as a select tag.
function event_select_tag($resource, $venue_id) {
	$response = $resource->_fetch ($resource->site .
		'venues/' . $venue_id . "/events/select_tag.html",
		'get', nil);
	list($headers, $select_tag) = explode ("\r\n\r\n", $response, 2);
	return $select_tag;
}

?>

