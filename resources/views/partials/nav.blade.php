<div id="sidenav-jaun" class="col l2 no-padding">
	<div class="sidebar-title valign-wrapper blue darken-1">
		<h2 class="valign">Convos</h2>
	</div>
	<div class="collection no-margin">
		@foreach ($senders as $sender)
			<a href="#!" class="collection-item">{{ $sender['phone_number'] }}</a>
		@endforeach
	</div>
</div>
{{--
<nav id="sidenav-jaun">
  <ul id="slide-out" class="side-nav fixed">
  	<li class="collection-header"><h4>Conversations</h4></li>
  	<div class="collection">
  		<a href="#!" class="collection-item">Alvin</a>
  	</div>
    <li><a href="#!">First Sidebar Link</a></li>
    <li><a href="#!">Second Sidebar Link</a></li>
  </ul>
  <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
</nav> --}}