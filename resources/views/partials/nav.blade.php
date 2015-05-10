<div id="sidenav-jaun" class="col l2 no-padding">
	<div class="sidebar-title valign-wrapper blue darken-1">
		<h2 class="valign">Convos</h2>
	</div>
	<div id="sender-list" class="collection no-margin">
    @if ($senders)
  		@foreach ($senders as $senderDude)
        @if ($senderDude['phone_number'] == $sender['phone_number'])
          <a id="{{ $senderDude['parse_object_id'] }}" href="/chat/{{ $senderDude['parse_object_id'] }}" class="collection-item waves-effect waves-light waves-green active">{{ $senderDude['phone_number'] }}</a>
        @elseif ($senderDude['unread'] == true)
          <a id="{{ $senderDude['parse_object_id'] }}" href="/chat/{{ $senderDude['parse_object_id'] }}" class="collection-item waves-effect waves-light waves-green unread">{{ $senderDude['phone_number'] }}</a>
        @else
          <a id="{{ $senderDude['parse_object_id'] }}" href="/chat/{{ $senderDude['parse_object_id'] }}" class="collection-item waves-effect waves-light waves-green">{{ $senderDude['phone_number'] }}</a>
        @endif
  		@endforeach
    @endif
	</div>
</div>