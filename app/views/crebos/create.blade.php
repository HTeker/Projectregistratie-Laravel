@extends('main')

@section('content')
	<h2>Voeg een nieuwe crebo toe</h2>
	
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	@include('_partials.errors')
        	{{ Form::open(array('route'=>'crebos.store','class'=>'uk-form')) }}
        		<div class="uk-form-row">
					{{ Form::text('nummer',null,array('placeholder'=>'Nummer','class'=>'uk-width-1-1', 'autofocus'=>'autofocus')) }}
				</div>
	            <div class="uk-form-row">
					{{ Form::text('naam',null,array('placeholder'=>'Naam','class'=>'uk-width-1-1')) }}
				</div>
				<br>
				<button class="uk-button uk-button-primary">Voeg toe</button>
			{{ Form::close() }}
        </div>
    </div>
	
@stop