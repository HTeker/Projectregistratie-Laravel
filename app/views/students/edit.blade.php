@extends('main')

@section('content')
	<h2>Wijzig een leerling</h2>
	
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	{{ Form::open(array('class'=>'uk-form', 'id'=>'search-form')) }}
				<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('zoekopdracht',null,array('placeholder'=>'Zoek een leerling','class'=>'uk-width-1-1', 'id'=>'search', 'autofocus'=>'autofocus', 'autocomplete'=>'off')) }}
					</div>
					<div id="suggesties">
						
					</div>
				</div>
			{{ Form::close() }}
			<br>

			{{ Form::open(array('class'=>'uk-form', 'id'=>'editform')) }}
				<div id="formedit">

					<h2 class="text-center">Leerling: <span id="naam"></span></h2>
						<div id="melding"></div>
					{{ Form::hidden('id', null,array('class'=>'id')) }}
					<div class="uk-form-row">
					{{ Form::text('voornaam',null,array('placeholder'=>'Vooraam','class'=>'uk-width-1-1 voornaam', 'autofocus'=>'autofocus')) }}
					</div>
					<div class="uk-form-row">
					{{ Form::text('tussenvoegsel',null,array('placeholder'=>'Tussenvoegsel','class'=>'uk-width-1-1 tussenvoegsel', 'autofocus'=>'autofocus')) }}
					</div>
					<div class="uk-form-row">
					{{ Form::text('achternaam',null,array('placeholder'=>'Achternaam','class'=>'uk-width-1-1 achternaam', 'autofocus'=>'autofocus')) }}
					</div>
					<div class="uk-form-row">
				        <span id="status-options"></span>
					</div>
					<div class="uk-form-row">
				        <span id="classroom-options"></span>
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
						url: '/students/search',
						datatype: 'html',
						data: { query: $(this).val() },
						success: function(data){

							var msg = "<table class='suggesties'><tbody>";
							
							if(data.length == 0){
								msg += "<tr><td class='geen-resultaten'>geen resultaten</td></tr>";
							}else{
								
								$.each(data, function() {

									var naam = this.voornaam + " " + this.tussenvoegsel + " " + this.achternaam;
									
									msg += "<tr><td id='search-result'><a onclick='setValue(\"" + naam + "\"," + this.id + ");'><div>" + naam + "</div></a></td></tr>";
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
				url: '/students/searchp',
				datatype: 'html',
				data: { query: id },
				success: function(data){

					console.log(data);

					var statuses = "<select name='status' class='status'><option value='default'>Selecteer een status</option>"; // var to generate status-options in the select tag
					var selectedStatus;

					var classrooms = "<select name='klas' class='klas'><option value='default'>Selecteer een klas</option>"; // var to generate classroom-options in the select tag
					var selectedClassroom;
					
					if(data.length != 0){
					    $.each(data, function(key, value) {
					        if(key === "classrooms"){
					        	for(var i=0; i<this.length; i++){
					        		
					        		if(this[i]['id'] == selectedClassroom){
					        			classrooms += "<option value='" + this[i]['id'] + "' selected>" + this[i]['naam'] + "</option>";
					        		}else{
					        			classrooms += "<option value='" + this[i]['id'] + "'>" + this[i]['naam'] + "</option>";
					        		}
					        	}
					        }else if(key === "statuses"){
					        	for(var i=0; i<this.length; i++){
					        		
					        		if(this[i]['id'] == selectedStatus){
					        			statuses += "<option value='" + this[i]['id'] + "' selected>" + this[i]['naam'] + "</option>";
					        		}else{
					        			statuses += "<option value='" + this[i]['id'] + "'>" + this[i]['naam'] + "</option>";
					        		}
					        	}
					        }else{
					            // another code
					            $('#formedit').show();
								$('#naam').html(this.naam); // titel
								$('.voornaam').val(this.voornaam);
								$('.tussenvoegsel').val(this.tussenvoegsel);
								$('.achternaam').val(this.achternaam);
								$('.id').val(this.id);
								selectedStatus = this.status;
								selectedClassroom = this.klas;
					        }
					    });

					    statuses += "</select>";
					    $('#status-options').html(statuses);

					    classrooms += "</select>";
					    $('#classroom-options').html(classrooms);
					}
				}
			});
		}

		$('#editform').submit(function(e){
			e.preventDefault();

			var resource = "students";
			var id = $('.id').val();
			var voornaam = $('.voornaam').val();
			var tussenvoegsel = $('.tussenvoegsel').val();
			var achternaam = $('.achternaam').val();
			var naam = $('.naam').val();
			var status = $('.status').val();
			var klas = $('.klas').val();

			if (confirm('Weet u zeker dat u het wilt wijzigen?')) {
			    $.ajax({
			      type: "PUT",
			      url: '/' + resource + '/' + id,
	    		  dataType: "json",
	    		  data: { voornaam:voornaam,
			    		  tussenvoegsel:tussenvoegsel,
			    		  achternaam:achternaam,
			    		  status:status,
	    		  		  klas:klas,
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