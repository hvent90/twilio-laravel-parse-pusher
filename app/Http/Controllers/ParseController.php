<?php namespace App\Http\Controllers;

use App\Message;
use App\Sender;
use Illuminate\Http\Request;
use Parse\ParseException;
use Parse\ParseObject;

class ParseController extends Controller {

	protected $sender;
	protected $message;

	public function __construct(Sender $sender, Message $message)
	{
		$this->sender = $sender;
		$this->message = $message;
	}

	public function testInsertMessage()
	{
		$this->message->storeMessage(
    		'+4848867611',
    		'Helloeeeeoo',
    		'123',
    		'EHzaecd8ia'
    	);
	}

	public function testInsertSender()
	{
		$sender = $this->sender->createNewParseSender('+4848867611');
	}

	public function testRetrieveSender(Request $request)
	{
		$sender = $this->sender->getSenderByPhoneNumber($request->get('phone_number'));

		return $sender ? $sender : 'No senders found by that phone number';
	}

	public function testRetrieveMessagesFromSender()
	{
		$sender = $this->sender->getSenderByPhoneNumber('+4848867611');

		$messages = $this->message->getMessagesByUser($sender['parse_object_id']);

		return $messages;
	}

}
