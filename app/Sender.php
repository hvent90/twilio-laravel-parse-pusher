<?php namespace App;

use App\Message;
use Parse\ParseObject;
use Parse\ParseQuery;

class Sender  {

	// protected $message;

	// public function __construct(Message $message)
	// {
	// 	$this->message = $message;
	// }

	public function getSendersAndTheirMessages()
	{
		$query = new ParseQuery("Sender");
		$query->descending("createdAt");
		$senderResults = $query->find();
		$senders = [];

		$message = new Message;

		for ($i = 0; $i < count($senderResults); $i++) {
			// This does not require a network access.
			$sendersMessages = $message->getMessagesByUser($senderResults[$i]->getObjectId());

			$senders[] = [
				'parse_object_id' => $senderResults[$i]->getObjectId(),
				'phone_number' => $senderResults[$i]->get("phone_number"),
				'unread' => $senderResults[$i]->get('unread'),
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
					'phone_number' => $object->get('phone_number'),
					'unread' => $object->get('unread')
				];
			}

			return $sender;
		}

		return false;
	}

	public function getSenderByObjectId($objectId, $returnParseObject = false, $markAsRead = false)
	{
		$query = new ParseQuery("Sender");
		$query->equalTo("objectId", $objectId);

		$results = $query->find();

		if ($markAsRead == true) {
			foreach ($results as $result) {
				$result->set('unread', false);
				$result->save();
			}
		}

		if ($returnParseObject == true) {
			return $results[0];
		}

		$message = new Message;

		if ($results) {
			for ($i = 0; $i < count($results); $i++) {
				$object = $results[$i];

				$sendersMessages = $message->getMessagesByUser($object->getObjectId());

				$sender = [
					'parse_object_id' => $object->getObjectId(),
					'phone_number' => $object->get('phone_number'),
					'unread' => $object->get('unread'),
					'messages' => $sendersMessages
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
		$parseMessage->set('unread', true);

		try {
	    	$parseMessage->save();

			return [
				'parse_object_id' => $parseMessage->getObjectId(),
				'phone_number' => $phoneNumber,
				'unread' => true
			];
	    } catch (ParseException $ex) {
			echo 'Failed to create new object, with error message: ' + $ex->getMessage();
	    }
	}

	public function getSendersOrderedByMessages()
	{
		$query = new ParseQuery("Message");
		$query->descending("createdAt");
		$messageResults = $query->find();
		$uniqueNumbers = [];
		$senders = [];

		foreach ($messageResults as $message) {
			if (! in_array($message->get('from_number'), $uniqueNumbers) &&
				$message->get('from_number') != 'admin') {
				$uniqueNumbers[] = $message->get('from_number');
				// First get the sender to retrieve if he
				//  has been marked as having unread messages.
				$sender = $this->getSenderByObjectId($message->get('createdBy'));

				$senders[] = [
					'phone_number' => $message->get('from_number'),
					'unread' => $sender['unread'],
					'parse_object_id' => $sender['parse_object_id']
				];
			}
		}

		return $senders;
	}
}
