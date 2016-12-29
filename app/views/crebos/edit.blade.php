@extends('main')

@section('content')
	<h2>Wijzig een crebo</h2>
	
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	{{ Form::open(array('class'=>'uk-form', 'id'=>'search-form')) }}
				<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('zoekopdracht',null,array('placeholder'=>'Zoek een crebo','class'=>'uk-width-1-1', 'id'=>'search', 'autofocus'=>'autofocus', 'autocomplete'=>'off')) }}
					</div>
					<div id="suggesties">
						
					</div>
				</div>
			{{ Form::close() }}
			<br>

			{{ Form::open(array('class'=>'uk-form', 'id'=>'editform')) }}
				<div id="formedit">
					<h2 class="text-center">Crebo: <span id="naam"></span></h2>
						<div id="melding"></div>
					{{ Form::hidden('id', null,array('class'=>'id')) }}
					<div class="uk-form-row">
					{{ Form::label('nummer', 'Nummer:') }}
					{{ Form::text('nummer', null,array('class'=>'uk-width-1-1 nummer')) }}
				</div>
	            <div class="uk-form-row">
	            	{{ Form::label('naam', 'Naam:') }}
					{{ Form::text('naam', null,array('class'=>'uk-width-1-1 naam')) }}
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
						url: '/crebos/search',
						datatype: 'html',
						data: { query: $(this).val() },
						success: function(data){


							var msg = "<table class='suggesties'><tbody>";
							
							if(data.length == 0){
								msg += "<tr><td class='geen-resultaten'>geen resultaten</td></tr>";
							}else{
								
								$.each(data, function() {
									
									msg += "<tr><td id='search-result'><a onclick='setValue(\"" + this.naam + "\"," + this.id + ");'><div>" + this.naam + " (" + this.nummer + ")</div></a></td></tr>";
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
				url: '/crebos/searchp',
				datatype: 'html',
				data: { query: id },
				success: function(data){
					console.log(data);

					
					if(data.length != 0){
						$.each(data, function() {

							$('#formedit').show();
							$('#naam').html(this.naam);
							$('.nummer').val(this.nummer);
							$('.naam').val(this.naam);
							$('.id').val(this.id);
						});	
					}
				}
			});
		}

		$('#editform').submit(function(e){
			e.preventDefault();

			var resource = "crebos";
			var id = $('.id').val();
			var naam = $('.naam').val();
			var nummer = $('.nummer').val();

			if (confirm('Weet u zeker dat u het wilt wijzigen?')) {
			    $.ajax({
			      type: "PUT",
			      url: '/' + resource + '/' + id,
	    		  dataType: "json",
	    		  data: { naam:naam,
	    		  		  nummer:nummer,
	    		   },
			      success: function(data) {

			      	//console.log(data);

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