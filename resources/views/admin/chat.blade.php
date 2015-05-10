@extends('layout-chat')

@section('content')

<div class="chat-container">
		<div id="chat-log" class="message-history-container collection no-margin">
			@if ($sender)
				@foreach ($sender['messages'] as $message)
					@if ($message['from_number'] == 'admin')
						<div class="collection-item message-container message-them">
							<span class="message-author">Me:</span>
							{{ $message['message'] }}
						</div>
					@else
						<div class="collection-item message-container message-them">
							<span class="message-author">{{ $message['from_number'] }}:</span>
							{{ $message['message'] }}
						</div>
					@endif
				@endforeach
			@endif
		</div>
		<div class="chat-input-container">
			{!! Form::open() !!}
				{!! Form::text('send_message', '', ['id' => 'input', 'placeholder' => 'Enter a message...']) !!}
			{!! Form::close() !!}
		</div>
</div>

@endsection