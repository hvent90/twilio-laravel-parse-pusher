<script>
	$(function() {
		$(".button-collapse").sideNav();

		var chatWindow = document.getElementById('chat-log');
		chatWindow.scrollTop = chatWindow.scrollHeight;

		$('#input').keypress(function (e) {
			if (e.which == 13) {
				var formData = {
					message: $('#input').val(),
					phoneNumber: '{{ $sender['phone_number'] }}',
					parseSenderObjectId: '{{ $sender['parse_object_id'] }}'
				};

				console.log('Form data: ', formData);

				$.ajax({
					type: "POST",
					contentType: "application/json",
    				// dataType: "json",
					url: '/sms/enter',
					data: JSON.stringify(formData),
					success: function (data) {
						$('#input').val('');
						$('#chat-log').append(
							'<div class="collection-item message-container message-me">' +
								'<span class="message-author">Me:</span>' +
								formData.message +
							'</div>'
						);

						$('#chat-log').animate({
								scrollTop: $('#chat-log').scrollHeight
							}, 500);
						var chatWindow = document.getElementById('chat-log');
						chatWindow.scrollTop = chatWindow.scrollHeight;
					}
				});

				return false;
			}
		});

		// window.App = {};

		// App.Notifier = function() {
		// 	this.notify = function(messagePackage) {
		// 		$('#chat-log').append(
		// 			'<div class="collection-item message-container message-them">' +
		// 				'<span class="message-author">+'messagepackage.phone_number'+:</span>' +
		// 				messagePackage.message +
		// 			'</div>'
		// 		);
		// 	};
		// };

		var pusher = new Pusher('8b70545cb1629c2331be');

		var channel = pusher.subscribe('magic-channel');

		channel.bind("{{ $sender['parse_object_id'] }}", function(data) {
			console.log('receiving pusher');
			$('#chat-log').append(
				'<div class="collection-item message-container message-them">' +
					'<span class="message-author">' + data.phone_number + ':</span>' +
					data.message +
				'</div>');

			// $('#chat-log').animate({
			// 		scrollTop: $('#chat-log').scrollHeight
			// 	}, 500);
			// $('.chat-container').scrollTop('100%');
			var chatWindow = document.getElementById('chat-log');
			chatWindow.scrollTop = chatWindow.scrollHeight;
		});
	});
</script>