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
					url: '/sms/enter',
					data: formData,
					success: function (data) {
						console.log(data);
						$('#input').val('');
					}
				});

				return false;
			}
		});
	});
</script>