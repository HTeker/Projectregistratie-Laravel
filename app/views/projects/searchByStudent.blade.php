@extends('main')

@section('content')
	<h2>Zoek per leerling</h2>
		<div id="melding"></div>
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	@include('_partials.errors')
        	{{ Form::open(array('class'=>'uk-form')) }}
        		<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('student-search',null,array('placeholder'=>'Zoek een leerling','class'=>'uk-width-1-1', 'id'=>'student-search', 'autofocus'=>'autofocus', 'autocomplete'=>'off')) }}
					</div>
					<div id="student-suggesties">
						
					</div>
					{{ Form::hidden('klas',null, array('id'=>'student')) }}
				</div>
				<br>
			{{ Form::close() }}

			{{ Form::open(array('url'=>'/pdf', 'id'=>'pdf-form')) }}
				{{ Form::hidden('html', null, array('id'=>'html-hidden')) }}
				<a id="pdf-icon"><img src="../images/pdf-icon.png"></a>
			{{ Form::close() }}

			<div id="tabel"></div>
        </div>
    </div>
@stop

@section('script')
	<script>
		var field;

		$(document).ready(function(){
			$('#pdf-form').hide();
			$('#student-search').keyup(function(){
				if($(this).val() != ''){
					$.ajax({
						type: "GET",
						url: '/students/search',
						dataType: 'json',
						data: { query:$(this).val() },
						success: function(data){
							field = "student";
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
		});

		function setValue(naam,id){
			$('#' + field + '-search').val(naam);
			$('#' + field).val(id);
			$('#' + field + '-suggesties').empty();

			$('#pdf-form').show();

			var leerling = $('#student').val();

			$.ajax({
				type: 'GET',
				url: '/projects/searchByStudentQuery',
				dataType: 'json',
				data: {leerling:leerling},
				success: function(data){
					var msg = '';

					console.log(data);
							
					if(data.length == 0){
						msg += "<h2 class='text-center'>Geen resultaten</h2>";
					}else{
						var leerlingNaam = data[0].voornaam + " " + data[0].tussenvoegsel + " " + data[0].achternaam;
						var leerlingKlas = data[0].klas;

						msg += "<h2 class='text-center'>" + leerlingNaam + " (" + leerlingKlas + ")</h2><br><table class='uk-table uk-table-hover uk-table-striped uk-table-condensed'><thead><tr><th>Project</th><th>Beoordeling</th><th>Commentaar</th></tr></thead><tbody>";

						$.each(data, function() {
							var beoordeling = (this.beoordelingid == 1) ? "Deadline: "+this.deadline : this.beoordeling;
							var commentaar = (this.beoordelingid == 1) ? "Deadline: "+this.deadline : this.commentaar;

							msg += "<tr><td>" + this.project + "</td><td>" + beoordeling + "</td><td>" + commentaar + "</td></tr>";
						});

						msg += "</tbody></table>";

						var vandaag = new Date();
						var min = vandaag.getMinutes();
						if (min.toString().length == 1){
							min = "0" + min;
						}
						var datum = "<br><small class='aangemaakt'>Aangemaakt op: " + vandaag.getFullYear() + "-" + vandaag.getMonth() + "-" + vandaag.getDate() + " " + vandaag.getHours() + ":" + min + "</small>";
						var css = "<style>table{border-collapse: collapse; width:100%;} table,th,td {border: 1px solid black; padding: 5px;}</style>";
						var html = css + msg + datum;
					
						$('#html-hidden').val(html);
					}

					
					$('#tabel').html(msg);
				}
			});
		}

		$('#pdf-icon').click(function(){
			var form = $(this).closest("form");
 			form.submit();
		});
	</script>
@stop