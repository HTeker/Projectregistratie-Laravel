@extends('main')

@section('content')
	<h2>Verwijder een klas</h2>
		<div id="melding"></div>
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	{{ Form::open(array('class'=>'uk-form', 'id'=>'search-form')) }}
				<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('klas',null,array('placeholder'=>'Zoek een klas','class'=>'uk-width-1-1', 'id'=>'search', 'autofocus'=>'autofocus')) }}
					</div>
				</div>
			{{ Form::close() }}
		<br>
			<div id="tabel"></div>
        </div>
    </div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			'use strict';

			$('#search').keyup(function(){
				if($(this).val() != ''){
					$.ajax({
						type: 'GET',
						url: '/classrooms/search',
						datatype: 'html',
						data: { query: $(this).val() },
						success: function(data){
							var msg = '';

							console.log(data);
							
							if(data.length == 0){
								msg += "<h2 class='text-center'>Geen resultaten voor: '" + $('#search').val() + "'</h2>";
							}else{
								msg += "<h2 class='text-center'>Resultaten voor: '" + $('#search').val() + "'</h2><br><table class='uk-table uk-table-hover uk-table-striped uk-table-condensed'><thead><tr><th>ID</th><th>Naam</th><th>Crebo</th><th></th></tr></thead><tbody>";

								var resource = "classrooms";

								$.each(data, function() {
									msg += "<tr><td>" + this.id + "</td><td>" + this.naam + "</td><td>" + this.cohorts.naam + "</td><td><a onclick='deleteRecord( \"" + resource + "\"," + this.id + ");'><i class='uk-icon-trash-o uk-icon c-blue place-right'></i> </a></td></tr>";
								});

								msg += "</tbody></table>";
							}

							
							$('#tabel').html(msg);
						}
					});
				}else{
					$('#tabel').empty();
				}
			});

			$('#search-form').submit(function() {
			  return false;
			});

		});
	</script>

	@include('_partials.deleteRecord')
@stop

