@extends('main')

@section('content')
	<h2>Voeg een nieuwe account toe</h2>
	
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	@include('_partials.errors')
        	{{ Form::open(array( 'route'=>'accounts.store', 'class'=>'uk-form')) }}
	            <div class="uk-form-row">
					{{ Form::text('voornaam',null,array('placeholder'=>'Voornaam','class'=>'uk-width-1-1', 'autofocus'=>'autofocus')) }}
				</div>
				<div class="uk-form-row">
					{{ Form::text('tussenvoegsel',null,array('placeholder'=>'Tussenvoegsel','class'=>'uk-width-1-1')) }}
				</div>
				<div class="uk-form-row">
					{{ Form::text('achternaam',null,array('placeholder'=>'Achternaam','class'=>'uk-width-1-1')) }}
				</div>
				<div class="uk-form-row">
					{{ Form::text('email',null,array('placeholder'=>'E-mailadres','class'=>'uk-width-1-1')) }}
				</div>
				<div class="uk-form-row">
					{{ Form::password('wachtwoord',array('placeholder'=>'Wachtwoord','class'=>'uk-width-1-1')) }}
				</div>
				<div class="uk-form-row">
					{{ Form::password('wachtwoord_confirmation',array('placeholder'=>'Wachtwoord herhalen','class'=>'uk-width-1-1')) }}
				</div>
				<br>
				<button class="uk-button uk-button-primary">Voeg toe</button>
			{{ Form::close() }}
        </div>
    </div>
	
@stop