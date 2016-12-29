@extends('main')

@section('content')
	<h2>Beoordeel een project</h2>
		<div id="melding"></div>
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	<div id="melding"></div>
        	{{ Form::open(array('class'=>'uk-form')) }}
        		<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('leerling-search',null,array('placeholder'=>'Zoek een leerling','class'=>'uk-width-1-1', 'id'=>'student-search', 'autofocus'=>'autofocus', 'autocomplete'=>'off')) }}
					</div>
					<div id="student-suggesties">
						
					</div>
					{{ Form::hidden('leerling',null, array('id'=>'student')) }}
				</div>
				<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('project-search',null,array('placeholder'=>'Zoek een project','class'=>'uk-width-1-1', 'id'=>'project-search','autofocus'=>'autofocus',  'autocomplete'=>'off')) }}
					</div>
					<div id="project-suggesties">
						
					</div>
					{{ Form::hidden('project',null, array('id'=>'project')) }}
				</div>
				<div class="uk-form-row">
					{{ Form::select('beoordeling', $ratings, null, array('id'=>'rating'))}}
				</div>
				<div class="uk-form-row">
					{{ Form::text('deadline', null, array('placeholder'=>'Selecteer een deadline', 'id'=>'deadline-select', 'data-uk-datepicker'=>"{format:'YYYY-MM-DD'}")) }}
					<label for="deadline" id="deadline-label"><small>Deadline wijzigen</small></label>
				</div>
				<div class="uk-form-row">
					{{ Form::textarea('commentaar',null,array('placeholder'=>'Commentaar', 'id'=>'commentaar','rows'=>'5','class'=>'uk-width-1-1')) }}
				</div>
				<br>
				<button class="uk-button uk-button-primary">Beoordeel project</button>
			{{ Form::close() }}
        </div>
    </div>
@stop

@section('script')
	<script>
		var field;

		$(document).ready(function(){
			$('#deadline-label').hide();
			$('#student-search').keyup(function(){
				if($(this).val() != ''){
					$.ajax({
						type: "GET",
						url: '/students/search',
						dataType: 'json',
						data: { query:$(this).val() },
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
					$('#student-suggesties').empty();
				}
			});

			$('#project-search').keyup(function(){
				if($(this).val() != ''){
					var studentid = $('#student').val();

					$.ajax({
						type: "GET",
						url: '/projects/searchNotCompletedByStudent',
						dataType: 'json',
						data: { query:$(this).val(),
								studentid: studentid},
						success: function(data){
							
							field = "project";
							var msg = "<table class='suggesties'><tbody>";
							
							if(data.length == 0){
								msg += "<tr><td class='geen-resultaten'>geen resultaten</td></tr>";
							}else if(data == false){
								msg += "<tr><td class='geen-resultaten'>Selecteer eerst een leerling</td></tr>";
							}else{
								$.each(data, function() {
									console.log(this);
									msg += "<tr><td id='search-result'><a onclick='setValue(\"" + this.naam + "\"," + this.id + ",\"" + this.deadline + "\");'><div>" + this.naam + "</div></a></td></tr>";
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

			$('.uk-form').submit(function(e){
				e.preventDefault();

				var leerling = $('#student').val();
				var project = $('#project').val();
				var beoordeling = $('#rating').val();
				var deadline = $('#deadline-select').val();
				var commentaar = $('#commentaar').val();

				$.ajax({
					type: "POST",
					url: '/projects/rateProjectByStudent',
					dataType: 'json',
					data: { leerling:leerling,
							project:project,
							beoordeling:beoordeling,
							deadline:deadline,
							commentaar:commentaar },
					success: function(data){
						if(data == true){
				      		var msg = "<div class='uk-alert uk-alert-success'><a href='' class='uk-alert-close uk-close'></a> <ul><li>Het project is met succes beoordeeld.</li></ul>  </div>";
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

			$('#student-search, #project-search').change(function(){
				if($('#student-search').val() == "" || $('#project-search').val() == ""){
					$('#deadline-select').val(null);
					$('#deadline-label').hide();
				}
			});
		});

		function setValue(naam,id, deadline){
			$('#' + field + '-search').val(naam);
			$('#' + field).val(id);
			$('#' + field + '-suggesties').empty();

			if(deadline){
				$('#deadline-select').val(deadline);
				$('#deadline-label').show();
			}
		}
	</script>
@stop