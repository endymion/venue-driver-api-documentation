<?php

$venue_id = 410591471; // Test venue ID, change this to your desired venue.

require_once ('VenueDriver.php');


if( $_POST['event'] && $_POST['first'] && $_POST['last'] && $_POST['phone'] && $_POST['email'])
{
	// create a new reservation
	$reservation = new Reservation (array (
	    'account' => $account_id,
	    'event' => $_POST['event'],
		'first' => $_POST['first'],
		'last' => $_POST['last'],
	    'phone' => $_POST['phone'],
	    'email' => $_POST['email']
	));
	$r = $reservation->save ();
?>
	Thanks.  You're signed up.
<?
}
else
{
	if( $_POST['event'] )
	{
?>
		Please provide all required fields.
<?
	}

	// create a reservation form
	$select_tag = event_select_tag(new reservation, $venue_id);
?>
	<form action="#" method="post">
		Event: <? print $select_tag; ?><br/>
		First:  <input type="text" name="first" /><br />
		Last:  <input type="text" name="last" /><br />
		Phone: <input type="text" name="phone" /><br />
		Email: <input type="text" name="email" /><br />
		<input type="submit" name="submit" value="Make Reservation" />
	</form>
<?
}
?>