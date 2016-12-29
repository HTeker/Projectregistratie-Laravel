@extends('main')

@section('content')
	<h2>Zoek per afgeronde project</h2>
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
					{{ Form::select('status', $statuses, null, array('id'=>'status'))}}
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

			$('#status').change(function(){
				if(!$('#project').val()){
					var msg = "<div class='uk-alert uk-alert-danger'><a href='' class='uk-alert-close uk-close'></a> <ul><li>U heeft nog geen project gekozen.</li></ul>  </div>";
					$('#melding').html(msg);
				}else if($('#status').val() == 'default'){
					var msg = "<div class='uk-alert uk-alert-danger'><a href='' class='uk-alert-close uk-close'></a> <ul><li>U heeft geen geldige status gekozen.</li></ul>  </div>";
					$('#melding').html(msg);
				}else{
					$('#melding').empty();

					var project = $('#project').val();
					var status = $('#status').val();

					$.ajax({
						type: "GET",
						url: '/projects/searchByCompletedQuery',
						dataType: 'json',
						data: { project:project,
								status:status },
						success: function(data){
							var msg = '';
							console.log(data);

							$('#pdf-form').show();
							
							if(data.length == 0){
								msg += "<h2 class='text-center'>Geen resultaten</h2>";
							}else{
								msg += "<h2 class='text-center'>Project: " + data[0]['project'] + "</h2><br><table class='uk-table uk-table-hover uk-table-striped uk-table-condensed'><thead><tr><th>Leerling</th><th>Beoordeling</th><th>Commentaar</th></tr></thead><tbody>";

								$.each(data, function() {
									msg += "<tr><td>" + this.voornaam + " " + this.tussenvoegsel + " " + this.achternaam + "</td><td>" + this.beoordeling +  "</td><td>" + this.commentaar + "</td></tr>";
									console.log(this);
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
			});

		});

		$('#pdf-icon').click(function(){
			var form = $(this).closest("form");
 			form.submit();
		});

		function setValue(naam,id){
			$('#' + field + '-search').val(naam);
			$('#' + field).val(id);
			$('#' + field + '-suggesties').empty();
		}
	</script>
@stop