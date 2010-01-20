<?php

$username = 'yoursite';
$password = 'password';
$account_id = 14; // Test account ID, change this to your desired account ID.
$venue_id = 327; // Test venue ID, change this to your desired venue.

$server = 'venuedriver.com';
// $server = 'localhost:3000'; // For testing.

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
  date_default_timezone_set('America/Los_Angeles');
  $cachepath = "/var/tmp/";

  $cachefile = $cachepath . "cached_venue_".$venue_id."_event_select.html";
  $cachetime = 60 * 60 * 24; // 24 hours.
  // Serve from the cache if it is younger than $cachetime
  if (file_exists($cachefile) && (time() - $cachetime
     < filemtime($cachefile))) 
  {
    include($cachefile);
    return;
  }
  $response = $resource->_fetch ($resource->site .
    'venues/' . $venue_id . "/events/select_tag.html",
    'get', nil);
  list($headers, $select_tag) = explode ("\r\n\r\n", $response, 2);
  $fp = fopen($cachefile, 'w'); 
  fwrite($fp, $select_tag);
  fclose($fp); 
  return $select_tag;
}

?>

