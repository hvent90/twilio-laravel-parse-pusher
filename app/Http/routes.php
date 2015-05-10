<?php

App::bind('Pusher', function($app) {
	$keys = $this->app['config']->get('services.pusher');

    return new \Pusher($keys['public'], $keys['secret'], $keys['app_id']);
});

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

Route::get('/chat', 'AdminController@chat');
Route::get('/chat/{parseUserObjectId}', 'AdminController@chat');

Route::group(['prefix' => 'sms'], function() {
	Route::post('receive', 'TwilioController@receive');
	Route::post('enter', 'TwilioController@enter');
});

Route::group(['prefix' => 'parse'], function() {
	Route::get('/test-insert-message', 'ParseController@testInsertMessage');
	Route::get('/test-insert-sender', 'ParseController@testInsertSender');
	Route::post('/test-retrieve-sender', 'ParseController@testRetrieveSender');
	Route::get('/test-retrieve-messages-from-sender', 'ParseController@testRetrieveMessagesFromSender');
});

Route::get('test', function() {
	// var_dump(getenv('PUSHER_PUBLIC'));
	// var_dump(getenv('PUSHER_SECRET'));
	// var_dump(getenv('PUSHER_APP_ID'));

	App::make('Pusher')->trigger('magic-channel', 'receive-sms', [
		'phone_number' => 'fasdfa',
		'message' 	   => 'asdfasdfasdf'
	]);
});

Route::get('/twilio', function() {
	//Service Providers Example
	$data = ['sendingMessage' => 'test'];
	$phoneNumber = '+14848867635';

	SMS::send('twilio.send', $data, function($sms) use ($phoneNumber) {
	    $sms->to($phoneNumber);
	});
});

