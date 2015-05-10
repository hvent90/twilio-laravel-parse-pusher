@extends('api-inspector::template')

@section('content')
<style>
.panel-heading, .panel-success {
    -webkit-transition: background-color 10000ms linear;
    -moz-transition: background-color 10000ms linear;
    -o-transition: background-color 10000ms linear;
    -ms-transition: background-color 10000ms linear;
    transition: background-color 10000ms linear;
    word-wrap: break-word;
}
li {
	word-wrap: break-word;
}
</style>
<div class="container">
	<div class="row">
		<div id="api-calls" class="col-md-10 col-md-offset-1">
			<script id="api-call" type="text/x-handlebars-template" style="display: none;">
				<div class="panel panel-success" style="display: none;">
					<div class="panel-heading">
						<strong>Method:</strong> @{{ method }}<br/>
						<strong>Request URL:</strong> @{{ url }}<br/>
						<strong>Requestee IP:</strong> @{{ ip }}<br/>
					</div>
					<div class="panel-body">
						<h2>Headers</h2>
						@{{#each header}}
							<li><strong>@{{@key}}:</strong> @{{this}}</li>
						@{{/each}}
					</div>
					<hr>
					<div class="panel-body">
						<h3>Input</h3>
						@{{#each input}}
							<li><strong>@{{@key}}:</strong> @{{this}}</li>
						@{{else}}
							No input
						@{{/each}}
						<h3>JSON Input</h3>
						@{{#each input-json}}
							<li><strong>@{{@key}}:</strong> @{{this}}</li>
						@{{else}}
							No JSON input
						@{{/each}}
					</div>
					<hr>
					<div class="panel-body">
						<strong>Is Ajax:</strong> @{{ ajax }} <br />
						<strong>Is JSON:</strong> @{{ is-json }} <br />
						<strong>Wants JSON:</strong> @{{ wants-json }} <br />
						<strong>Format:</strong> @{{ format }} <br />
						<strong>Session:</strong> @{{ session }} <br />
					</div>
				</div>
			</script>
		</div>
	</div>
</div>
@endsection

