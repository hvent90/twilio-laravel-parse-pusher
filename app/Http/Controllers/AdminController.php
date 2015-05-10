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
		$senders = $this->sender->getSendersAndTheirMessages();

		if ($parseUserObjectId) {
			$sender = $this->sender->getSenderByObjectId($parseUserObjectId);
		} else {
			$sender = $senders[0];
		}

		return view('admin.chat', compact('senders', 'sender'));
	}

}
