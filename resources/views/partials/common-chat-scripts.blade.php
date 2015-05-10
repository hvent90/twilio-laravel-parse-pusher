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

		var pusher = new Pusher('8b70545cb1629c2331be');

		var channel = pusher.subscribe('magic-channel');

		channel.bind("side-nav", function(data) {
			console.log('side-nav pusher activation');
			var senderListItem = $('#' + data.parse_object_id);

			if (senderListItem.text()) {
				console.log('found existing sender in side menu');
				senderListItem.prependTo($('#sender-list'));
			} else {
				console.log('did not find an existing sender in side menu');
				$('#sender-list').prepend(
					'<a id="'+data.parse_object_id+'" href="/chat/'+data.parse_object_id+'" class="collection-item waves-effect waves-light waves-green unread">'+data.phone_number+'</a>'
				);
			}
		});

		channel.bind("{{ $sender['parse_object_id'] }}", function(data) {
			console.log('receiving pusher');
			$('#chat-log').append(
				'<div class="collection-item message-container message-them">' +
					'<span class="message-author">' + data.phone_number + ':</span>' +
					data.message +
				'</div>');

			var chatWindow = document.getElementById('chat-log');
			chatWindow.scrollTop = chatWindow.scrollHeight;
		});
	});
</script>