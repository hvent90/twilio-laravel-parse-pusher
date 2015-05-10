<?php namespace App\Http\Controllers;

use Log, SMS;

use App\Sender;
use Illuminate\Http\Request;

use Parse\ParseException;
use Parse\ParseObject;

class TwilioController extends Controller {

	protected $sender;

	public function __construct(Sender $sender)
	{
		$this->sender = $sender;
	}

	public function receive()
	{
		Log::info('Webhook activation from Twilio');

		$parseMessage = new ParseObject('message');

	    $incoming = SMS::receive();
	    //Get the sender's number.
	    $parseMessage->set('from_number', $incoming->from());
	    //Get the message sent.
	    $parseMessage->set('message', $incoming->message());
	    //Get the to unique Twilio ID of the message
	    $parseMessage->set('twilio_id', $incoming->id());

	    try {
	    	$parseMessage->save();
			echo 'New object created with objectId: ' . $parseMessage->getObjectId();
	    } catch (ParseException $ex) {
			echo 'Failed to create new object, with error message: ' + $ex->getMessage();
	    }
	}

}
