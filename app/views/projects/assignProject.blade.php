@extends('main')

@section('content')
	<h2>Wijs een project toe</h2>
		<div id="melding"></div>
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	@include('_partials.errors')
        	{{ Form::open(array('class'=>'uk-form')) }}
				<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('project-search',null,array('placeholder'=>'Zoek een project','class'=>'uk-width-1-1', 'id'=>'project-search', 'autofocus'=>'autofocus', 'autocomplete'=>'off')) }}
					</div>
					<div id="project-suggesties">
						
					</div>
					{{ Form::hidden('project',null, array('id'=>'project')) }}
				</div>
				<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('leerling-search',null,array('placeholder'=>'Zoek een leerling','class'=>'uk-width-1-1', 'id'=>'student-search', 'autocomplete'=>'off')) }}
					</div>
					<div id="student-suggesties">
						
					</div>
					{{ Form::hidden('leerling',null, array('id'=>'student')) }}
				</div>
				<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('docent-search',null,array('placeholder'=>'Zoek een docent','class'=>'uk-width-1-1', 'id'=>'teacher-search', 'autocomplete'=>'off')) }}
					</div>
					<div id="teacher-suggesties">
						
					</div>
					{{ Form::hidden('docent',null, array('id'=>'teacher')) }}
				</div>
				<div class="uk-form-row">
					{{ Form::text('begin_datum', null, array('placeholder'=>'Selecteer een begin datum', 'id'=>'begin_datum-select', 'data-uk-datepicker'=>"{format:'YYYY-MM-DD'}")) }}
				</div>
				<div class="uk-form-row">
					{{ Form::text('deadline', null, array('placeholder'=>'Selecteer een deadline', 'id'=>'deadline-select', 'data-uk-datepicker'=>"{format:'YYYY-MM-DD'}")) }}
				</div>
				<br>
				<button class="uk-button uk-button-primary">Wijs toe</button>
			{{ Form::close() }}
        </div>
    </div>
	
@stop

@section('script')
	<script>
		var field;

		$(document).ready(function(){
			
			$('#project-search').keyup(function(){
				if($(this).val() != ''){
					$.ajax({
						type: "GET",
						url: '/projects/search',
						dataType: 'json',
						data: { query:$(this).val() },
						success: function(data){
							field = "project";
							var msg = "<table class='suggesties'><tbody>";
							
							if(data.length == 0){
								msg += "<tr><td class='geen-resultaten'>geen resultaten</td></tr>";
							}else{
								
								$.each(data, function() {
									
									msg += "<tr><td id='search-result'><a onclick='setValue(\"" + this.naam + "\"," + this.id + ");'><div>" + this.naam + "</div></a></td></tr>";
								});	
							}

							msg += "</tbody></table>";

							$('#project-suggesties').html(msg);
						}
					});	
				}else{
					$('#project-suggesties').empty();
				}
			});

			$('#student-search').keyup(function(){
				var project = $('#project').val();
				if($(this).val() != ''){
					if(project){
						$.ajax({
							type: "GET",
							url: '/students/searchNotAssigned',
							dataType: 'json',
							data: { query:$(this).val(),
									project:project },
							success: function(data){
								field = 'student';
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

								$('#student-suggesties').html(msg);
							}
						});	
					}else{
						var msg = "Selecteer eerst een project";
						$('#student-suggesties').html(msg);
					}
				}else{
					$('#student-suggesties').empty();
				}
			});

			$('#teacher-search').keyup(function(){
				if($(this).val() != ''){
					$.ajax({
						type: "GET",
						url: '/teachers/search',
						dataType: 'json',
						data: { query:$(this).val() },
						success: function(data){
							field = 'teacher';
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

							$('#teacher-suggesties').html(msg);
						}
					});	
				}else{
					$('#teacher-suggesties').empty();
				}
			});

			$('.uk-form').submit(function(e) {
			  	e.preventDefault();

			  	var project = $('#project').val();
			  	var leerling = $('#student').val();
			  	var docent = $('#teacher').val();
				var begin_datum = $('#begin_datum-select').val();
			  	var deadline = $('#deadline-select').val();

			  	$.ajax({
			  		type: 'POST',
			  		url: '/projects/postAssign',
			  		dataType: 'json',
			  		data: {project:project,
					       leerling:leerling,
					       docent:docent,
					       begin_datum:begin_datum,
					       deadline:deadline},
			  		success: function(data){
			  			console.log(data);

			  			if(data == true){
				      		var msg = "<div class='uk-alert uk-alert-success'><a href='' class='uk-alert-close uk-close'></a> <ul><li>Het gegeven is met succes opgeslagen in het database.</li></ul>  </div>";
				      	}else{
				      		var msg = "<div class='uk-alert uk-alert-danger'><a href='' class='uk-alert-close uk-close'></a> ";

				      		$.each(data, function(value){
				      			msg += "<ul><li>" + this + "</li></ul>";

				      		});

				      		msg += "</div>";
				      	}

				      	$('#melding').html(msg);
			  		}
			  	});
			});

		});

		function setValue(naam,id){
			$('#' + field + '-search').val(naam);
			$('#' + field).val(id);
			$('#' + field + '-suggesties').empty();
		}
	</script>
@stop