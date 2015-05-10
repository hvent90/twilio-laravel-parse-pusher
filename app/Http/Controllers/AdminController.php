<?php namespace App\Http\Controllers;

use \App;
use App\Message;
use App\Sender;

class AdminController extends Controller {

	protected $message;

	public function __construct(Sender $sender, Message $message)
	{
		$this->message = $message;
		$this->sender = $sender;
		$this->keys = app()['config']->get('services.pusher');
	}

	public function chat($parseUserObjectId = null)
	{
		$senders = $this->sender->getSendersOrderedByMessages();

		if ($parseUserObjectId) {
			$sender = $this->sender->getSenderByObjectId($parseUserObjectId, false, true);
		} else {
			if ($senders) {
				$sender = $this->sender->getSenderByObjectId($senders[0]['parse_object_id'], false, true);
			} else {
				$sender = false;
				$senders = false;
			}
		}


		return view('admin.chat', compact('senders', 'sender'))
			->with('pusherPublicKey', $this->keys['public']);
	}

}
