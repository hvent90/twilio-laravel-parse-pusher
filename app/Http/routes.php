<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/admin', function() {
	return view('admin.chat');
});

Route::post('sms/receive', function() {
	Log::info('Webhook activation from Twilio');

	$parseMessage = new Parse\ParseObject('message');

    $incoming = SMS::receive();
    //Get the sender's number.
    $parseMessage->set('from_number', $incoming->from());
    //Get the message sent.
    $parseMessage->set('message', $incoming->message());
    //Get the to unique Twilio ID of the message
    $parseMessage->set('twilio_id', $incoming->id());

    try {
    	$parseMessage->save();
		echo 'New object created with objectId: ' . $parseMessage->getObjectId();
    } catch (ParseException $ex) {
		echo 'Failed to create new object, with error message: ' + $ex->getMessage();
    }
});

Route::get('parse/test', function() {
    $message = new Parse\ParseObject("message");
    $message->set('from_number', '+19998887777');

    try {
    	$message->save();
		echo 'New object created with objectId: ' . $message->getObjectId();
    } catch (ParseException $ex) {
		echo 'Failed to create new object, with error message: ' + $ex->getMessage();
    }
});

Route::get('/env-keys', function() {
	var_dump(getenv('PARSE_APP_ID'));
	var_dump(getenv('PARSE_REST_KEY'));
	var_dump(getenv('PARSE_MASTER_KEY'));
});

Route::get('/twilio', function() {
	//Service Providers Example
	$data = [];
	SMS::send('twilio.send', $data, function($sms) {
	    $sms->to('+14848867635');
	});
});

