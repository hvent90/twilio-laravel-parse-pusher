<?php namespace App\Http\Controllers;

use App\Message;
use App\Sender;

class AdminController extends Controller {

	protected $message;

	public function __construct(Sender $sender, Message $message)
	{
		$this->message = $message;
		$this->sender = $sender;
	}

	public function chat($parseUserObjectId = null)
	{
		// $senders = $this->sender->getSendersAndTheirMessages();
		$senders = $this->sender->getSendersOrderedByMessages();

		if ($parseUserObjectId) {
			$sender = $this->sender->getSenderByObjectId($parseUserObjectId, false, true);
		} else {
			if ($senders) {
				$sender = $senders[0];
			} else {
				$sender = false;
				$senders = false;
			}
		}


		return view('admin.chat', compact('senders', 'sender'));
	}

}
