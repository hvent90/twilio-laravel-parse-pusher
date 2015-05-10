<div id="sidenav-jaun" class="col l2 no-padding">
	<div class="sidebar-title valign-wrapper blue darken-1">
		<h2 class="valign">Convos</h2>
	</div>
	<div class="collection no-margin">
    @if ($senders)
  		@foreach ($senders as $senderDude)
        @if ($senderDude['phone_number'] == $sender['phone_number'])
          <a href="/chat/{{ $senderDude['parse_object_id'] }}" class="collection-item waves-effect waves-light waves-green active">{{ $senderDude['phone_number'] }}</a>
        @elseif ($senderDude['unread'] == true)
          <a href="/chat/{{ $senderDude['parse_object_id'] }}" class="collection-item waves-effect waves-light waves-green unread">{{ $senderDude['phone_number'] }}</a>
        @else
          <a href="/chat/{{ $senderDude['parse_object_id'] }}" class="collection-item waves-effect waves-light waves-green">{{ $senderDude['phone_number'] }}</a>
        @endif
  		@endforeach
    @endif
	</div>
</div>