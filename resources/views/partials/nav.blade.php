<div id="sidenav-jaun" class="col l2 no-padding">
	<div class="sidebar-title valign-wrapper blue darken-1">
		<h2 class="valign">Convos</h2>
	</div>
	<div class="collection no-margin">
    @if ($senders)
  		@foreach ($senders as $sender)
        @if ($sender['unread'] == true)
          <a href="/chat/{{ $sender['parse_object_id'] }}" class="collection-item waves-effect waves-light waves-green active unread">{{ $sender['phone_number'] }}</a>
        @else
          <a href="/chat/{{ $sender['parse_object_id'] }}" class="collection-item waves-effect waves-light waves-green">{{ $sender['phone_number'] }}</a>
        @endif
  		@endforeach
    @endif
	</div>
</div>