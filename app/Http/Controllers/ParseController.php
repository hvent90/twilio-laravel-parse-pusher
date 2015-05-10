<?php namespace App\Http\Controllers;

use App\Sender;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Parse\ParseException;
use Parse\ParseObject;
// use Symfony\Component\HttpFoundation\Response;

class ParseController extends Controller {

	protected $sender;

	public function __construct(Sender $sender)
	{
		$this->sender = $sender;
	}

	public function testInsertMessage()
	{
		$message = new ParseObject("Message");
	    $message->set('from_number', '+19998887777');

	    try {
	    	$message->save();
			echo 'New object created with objectId: ' . $message->getObjectId();
	    } catch (ParseException $ex) {
			echo 'Failed to create new object, with error message: ' + $ex->getMessage();
	    }
	}

	public function testInsertSender()
	{
		$message = new ParseObject("Sender");
	    $message->set('phone_number', '+19998887777');

	    try {
	    	$message->save();
			echo 'New object created with objectId: ' . $message->getObjectId();
	    } catch (ParseException $ex) {
			echo 'Failed to create new object, with error message: ' + $ex->getMessage();
	    }
	}

	public function testRetrieveSender(Request $request)
	{
		$sender = $this->sender->getSenderByPhoneNumber($request->get('phone_number'));

		return $sender ? $sender : 'No senders found by that phone number';
	}

}
