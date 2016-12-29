@extends('main')

@section('content')
	<h2>Wijzig een account</h2>
	
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	{{ Form::open(array('class'=>'uk-form', 'id'=>'search-form')) }}
				<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('zoekopdracht',null,array('placeholder'=>'Zoek een account','class'=>'uk-width-1-1', 'id'=>'search', 'autofocus'=>'autofocus', 'autocomplete'=>'off')) }}
					</div>
					<div id="suggesties">
						
					</div>
				</div>
			{{ Form::close() }}
			<br>

			{{ Form::open(array('class'=>'uk-form', 'id'=>'editform')) }}
				<div id="formedit">
					<h2 class="text-center">Account: <span id="naam"></span></h2>
						<div id="melding"></div>
					{{ Form::hidden('id', null,array('class'=>'id')) }}
					<div class="uk-form-row">
						{{ Form::label('voornaam', 'Voornaam:') }}
						{{ Form::text('voornaam',null,array('class'=>'uk-width-1-1 voornaam')) }}
					</div>
					<div class="uk-form-row">
						{{ Form::label('tussenvoegsel', 'Tussenvoegsel:') }}
						{{ Form::text('tussenvoegsel',null,array('class'=>'uk-width-1-1 tussenvoegsel')) }}
					</div>
					<div class="uk-form-row">
						{{ Form::label('achternaam', 'Achternaam:') }}
						{{ Form::text('achternaam', null,array('class'=>'uk-width-1-1 achternaam')) }}
					</div>
					<div class="uk-form-row">
						{{ Form::label('email', 'E-mail:') }}
						{{ Form::text('email', null,array('class'=>'uk-width-1-1 email')) }}
					</div>
					<div class="uk-form-row">
						{{ Form::label('wachtwoord', 'Nieuw wachtwoord:') }}
						{{ Form::password('wachtwoord',array('class'=>'uk-width-1-1 wachtwoord')) }}
					</div>
					<div class="uk-form-row">
						{{ Form::label('wachtwoord_confirmation', 'Nieuw wachtwoord herhalen:') }}
						{{ Form::password('wachtwoord_confirmation',array('class'=>'uk-width-1-1 wachtwoord_confirmation')) }}
					</div>
				<br>
					<button class="uk-button uk-button-primary">Wijzig</button>
				</div>
			{{ Form::close() }}
        </div>
    </div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			'use strict';

			$('#formedit').hide();

			$('#search').keyup(function(){
				if($(this).val() != ''){
					$.ajax({
						type: 'GET',
						url: '/accounts/search',
						datatype: 'html',
						data: { query: $(this).val() },
						success: function(data){


							var msg = "<table class='suggesties'><tbody>";
							
							if(data.length == 0){
								msg += "<tr><td class='geen-resultaten'>geen resultaten</td></tr>";
							}else{
								
								$.each(data, function() {
									this['naam'] = this.voornaam + " " + this.tussenvoegsel + " " + this.achternaam;

									msg += "<tr><td id='search-result'><a onclick='setValue(\"" + this.naam + "\"," + this.id + ");'><div>" + this.naam + "</div></a></td></tr>";
								});	
							}

							msg += "</tbody></table>";

							$('#suggesties').html(msg);
						}
					});
				}else{
					$('#suggesties').empty();
				}
			});

			

			$('#search-form').submit(function() {
			  	return false;
			});

		});

		function setValue(naam,id){
			$('#search').val(naam);
			$('#suggesties').empty();

			$.ajax({
				type: 'GET',
				url: '/accounts/searchp',
				datatype: 'html',
				data: { query: id },
				success: function(data){
					console.log(data);

					
					if(data.length != 0){
						$.each(data, function() {
							this['naam'] = this.voornaam + " " + this.tussenvoegsel + " " + this.achternaam;

							$('#formedit').show();
							$('#naam').html(this.naam);
							$('.voornaam').val(this.voornaam);
							$('.tussenvoegsel').val(this.tussenvoegsel);
							$('.achternaam').val(this.achternaam);
							console.log(this);
							$('.id').val(this.id);
						});	
					}
				}
			});
		}

		$('#editform').submit(function(e){
			e.preventDefault();

			var resource = "accounts";
			var id = $('.id').val();
			var voornaam = $('.voornaam').val();
			var tussenvoegsel = $('.tussenvoegsel').val();
			var achternaam = $('.achternaam').val();
			var email = $('.email').val();
			var wachtwoord = $('.wachtwoord').val();
			var wachtwoord_confirmation = $('.wachtwoord_confirmation').val();

			if (confirm('Weet u zeker dat u het wilt wijzigen?')) {
			    $.ajax({
			      type: "PUT",
			      url: '/' + resource + '/' + id,
	    		  dataType: "json",
	    		  data: { voornaam:voornaam,
	    		  		  tussenvoegsel:tussenvoegsel,
	    		  		  achternaam:achternaam,
	    		  		  email:email,
	    		  		  wachtwoord:wachtwoord,
	    		  		  wachtwoord_confirmation:wachtwoord_confirmation
	    		   },
			      success: function(data) {
			      	if(data == true){
			      		var msg = "<div class='uk-alert uk-alert-success'><a href='' class='uk-alert-close uk-close'></a> <ul><li>Het gegeven is met succes bewerkt.</li></ul>  </div>";
			      	}else{
			      		var msg = "<div class='uk-alert uk-alert-danger'><a href='' class='uk-alert-close uk-close'></a> ";

			      		$.each(data, function(value){
			      			msg += "<ul><li>" + this + "</li></ul>";

			      		});

			      		msg += "</div>";
			      	}

			      	$('#melding').html(msg);

			      	//console.log(msg);

			      }
			    });
		  	}
		});
	</script>
@stop