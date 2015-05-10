<?php namespace App;

use App\Message;
use Parse\ParseObject;
use Parse\ParseQuery;

class Sender  {

	protected $message;

	public function __construct(Message $message)
	{
		$this->message = $message;
	}

	public function getSendersAndTheirMessages()
	{
		$query = new ParseQuery("Sender");
		$query->descending("createdAt");
		$senderResults = $query->find();
		$senders = [];

		for ($i = 0; $i < count($senderResults); $i++) {
			// This does not require a network access.
			$sendersMessages = $this->message->getMessagesByUser($senderResults[$i]->getObjectId());

			$senders[] = [
				'parse_object_id' => $senderResults[$i]->getObjectId(),
				'phone_number' => $senderResults[$i]->get("phone_number"),
				'messages' => $sendersMessages
			];
		}

		return $senders;
	}

	public function getSenderByPhoneNumber($phoneNumber)
	{
		$query = new ParseQuery("Sender");
		$query->equalTo("phone_number", $phoneNumber);

		$results = $query->find();

		if ($results) {
			for ($i = 0; $i < count($results); $i++) {
				$object = $results[$i];

				$sender = [
					'parse_object_id' => $object->getObjectId(),
					'phone_number' => $object->get('phone_number')
				];
			}

			return $sender;
		}

		return false;
	}

	public function createNewParseSender($phoneNumber)
	{
		$parseMessage = new ParseObject('Sender');
		$parseMessage->set('phone_number', $phoneNumber);

		try {
	    	$parseMessage->save();

			return [
				'parse_object_id' => $parseMessage->getObjectId(),
				'phone_number' => $phoneNumber
			];
	    } catch (ParseException $ex) {
			echo 'Failed to create new object, with error message: ' + $ex->getMessage();
	    }
	}
}
