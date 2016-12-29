@extends('main')

@section('content')
	<h2>Voeg een nieuw project toe</h2>
	
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	@include('_partials.errors')
        	{{ Form::open(array('route'=>'projects.store','class'=>'uk-form')) }}
	            <div class="uk-form-row">
					{{ Form::text('naam',null,array('placeholder'=>'Naam','class'=>'uk-width-1-1', 'autofocus'=>'autofocus')) }}
				</div>
				<div class="uk-form-row">
					{{ Form::textarea('beschrijving',null,array('placeholder'=>'Beschrijving', 'rows'=>'5','class'=>'uk-width-1-1')) }}
				</div>
			<br>
				<button class="uk-button uk-button-primary">Voeg toe</button>
			{{ Form::close() }}
        </div>
    </div>
	
@stop