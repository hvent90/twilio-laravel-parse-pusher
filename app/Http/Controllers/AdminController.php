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

	public function chat()
	{
		$senders = $this->sender->getSendersAndTheirMessages();
		$sender = $senders[0];

		return view('admin.chat', compact('senders', 'sender'));
	}

}
