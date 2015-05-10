<?php namespace App;

use Parse\ParseQuery;
use Parse\ParseObject;

class Sender  {

	public function getSenderByPhoneNumber($phoneNumber)
	{
		$query = new ParseQuery("Sender");
		$query->equalTo("phone_number", $phoneNumber);

		$results = $query->find();

		if ($results) {
			$sender = [];
			for ($i = 0; $i < count($results); $i++) {
				$object = $results[$i];
				$sender[] = [
					'phone_number' => $object->get('phone_number')
				];
			}

			return $sender;
		}

		return false;
	}


}
