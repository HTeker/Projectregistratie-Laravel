@if($errors->any())
<div class="uk-alert uk-alert-danger">
	<ul>
		{{ implode('', $errors->all('<li>:message</li>')) }}
	</ul>
</div>
@endif