@extends('layout-chat')

@section('content')

<div class="chat-container">
		<div id="chat-log" class="message-history-container collection no-margin">
			<div class="collection-item message-container message-me">
				<span class="message-author">Me:</span>
				Hello there
			</div>
			<div class="collection-item message-container message-them">
				<span class="message-author">+1 484-886-7635:</span>
				Why yes Hello there
			</div>
			<div class="collection-item message-container message-me">
				<span class="message-author">Me:</span>
				Hello there
			</div>
			<div class="collection-item message-container message-them">
				<span class="message-author">+1 484-886-7635:</span>
				Why yes Hello there
			</div>
			<div class="collection-item message-container message-me">
				<span class="message-author">Me:</span>
				Hello there
			</div>
			<div class="collection-item message-container message-them">
				<span class="message-author">+1 484-886-7635:</span>
				Why yes Hello there
			</div>
		</div>
		<div class="chat-input-container">
			{!! Form::open() !!}
				{!! Form::text('send_message', '', ['placeholder' => 'Enter a message...']) !!}
			{!! Form::close() !!}
		</div>
</div>

@endsection

@section('scripts')
<script>
</script>
@endsection