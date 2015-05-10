<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Api Inspector</title>

	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">API Inspector</a>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.2/handlebars.min.js"></script>
	<script src="http://js.pusher.com/2.2/pusher.min.js"></script>

	<script>
		(function() {
			window.App = {};

			App.Notifier = function() {
				this.notify = function(message) {
					for (var i in message.input) {
						message.input = $.parseJSON(i);
					}

					var template = Handlebars.compile($('#api-call').html());
					$(template(message)).prependTo('#api-calls').fadeIn(300, function() {
						var jaun = $(this);
						setTimeout(function() {
							console.log($(this));
							jaun.removeClass('panel-success').addClass('panel-default');
						}, 2000);
					});
				};
			};

			var pusher = new Pusher('8b70545cb1629c2331be');

			var channel = pusher.subscribe('apiChannel');

			channel.bind('apiCall', function(data) {
				(new App.Notifier).notify(data);
			});
		})();
	</script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
