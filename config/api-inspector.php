<?php
return [

	/*
	|--------------------------------------------------------------------------
	| API Inspector Quick Enable/Disable
	|--------------------------------------------------------------------------
	|
	| Enter a value of 'false' to quickly disable this package.
	| Valid options are 'true' and 'false' (without quotes).
	|
	*/

	'active' => true,


	/*
	|--------------------------------------------------------------------------
	| Pusher Integration
	|--------------------------------------------------------------------------
	|
	| This package uses Pusher for showing data on the view
	| without refreshing the browser.
	|
	| Visit https://pusher.com for more details.
	|
	| This package by default is searching for the keys in your
	| .env file. I have included a snippet of code below
	| for you to copy and paste in to your .env file
	| if you so choose to adhere to this practice.
	|
    | PUSHER_PUBLIC=12345
    | PUSHER_SECRET=123456
    | PUSHER_APP_ID=1234567
	|
	*/
	'public' => getenv('PUSHER_PUBLIC'),
	'secret' => getenv('PUSHER_SECRET'),
	'app_id' => getenv('PUSHER_APP_ID'),


	/*
	|--------------------------------------------------------------------------
	| Route Configuration
	|--------------------------------------------------------------------------
	|
	| You can customize the route endpoint
	| for accessing the API Inspector.
	|
    | The array of 'route-modifiers' is directly injected in to the first argument
    | for Route Groups (http://laravel.com/docs/5.0/routing#route-groups).
    | You can add custom key/value pairs in this array.
    |
	| The default endpoint is '/api/inspect'.
	|
	*/
    'uri' => 'api/inspect',
    'route-modifiers' => [
	    // 'prefix' => '',
	    // 'domain' => '',
	    // 'middleware' => []
    ],

];