<?php namespace App;

use SMS;
use Parse\ParseQuery;
use Parse\ParseObject;

class Message  {

	public function storeMessage($phoneNumber, $message, $twilioId, $userParseId)
	{
		$parseMessage = new ParseObject('Message');
	    $parseMessage->set('from_number', $phoneNumber);

	    //Get the message sent.
	    $parseMessage->set('message', $message);
	    //Get the to unique Twilio ID of the message
	    $parseMessage->set('twilio_id', $twilioId);
	    $parseMessage->set('createdBy', $userParseId);

	    try {
	    	$parseMessage->save();
	    } catch (ParseException $ex) {
			echo 'Failed to create new object, with error message: ' + $ex->getMessage();
	    }
	}

	public function getMessagesByUser($parseObjectId)
	{
		$query = new ParseQuery("Message");
		$query->equalTo("createdBy", $parseObjectId);
	  	$result = ($query->find());
	  	$messages = [];

		for ($i = 0; $i < count($result); $i++) {
		  $messages[] = [
		  	'message'     => $result[$i]->get("message"),
		  	'from_number' => $result[$i]->get("from_number"),
		  	'createdBy'   => $result[$i]->get("createdBy"),
		  	'twilio_id'   => $result[$i]->get('twilio_id'),
		  	'created_at'  => $result[$i]->getCreatedAt()
		  ];
		}

		return $messages;
	}

	public function sendMessage($message, $phoneNumber)
	{
		$data = ['sendingMessage' => $message];

		SMS::send('twilio.send', $data, function($sms) use ($phoneNumber) {
		    $sms->to($phoneNumber);
		});
	}
}
