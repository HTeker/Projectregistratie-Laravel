@extends('main')

@section('content')
	@if(!$students->isEmpty())
		<div id="pdf-header">
			<h2>Alle leerlingen</h2>
		</div>
			{{ Form::open(array('url'=>'/pdf')) }}
				{{ Form::hidden('html', null, array('id'=>'html-hidden')) }}
				<a id="pdf-icon"><img src="images/pdf-icon.png"></a>
			{{ Form::close() }}
		<div id="pdf-content">
			<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
			    <thead>
			        <tr>
			            <th>ID</th>
			            <th>Voornaam</th>
			            <th>Tussenvoegsel</th>
			            <th>Achternaam</th>
			            <th>Klas</th>
			            <th>Status</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($students as $student)
				        <tr>
				            <td> {{ $student->id }} </td>
				            <td> {{ $student->voornaam }} </td>
				            <td> {{ $student->tussenvoegsel }} </td>
				            <td> {{ $student->achternaam }} </td>
				            <td> {{ $student->klas }} </td>
				            <td> {{ $student->status }} </td>
				        </tr>
			        @endforeach
			    </tbody>
			</table>
		</div>
	@else
		nog geen studenten
	@endif
@stop

@section('script')
	<script>
		$(document).ready(function(){
			var vandaag = new Date();

			var min = vandaag.getMinutes();

			if (min.toString().length == 1){
				min = "0" + min;
			}

			var datum = "<br><small class='aangemaakt'>Aangemaakt op: " + vandaag.getFullYear() + "-" + vandaag.getMonth() + "-" + vandaag.getDate() + " " + vandaag.getHours() + ":" + min + "</small>";

			var htmlHeader = $('#pdf-header').html();
			var htmlContent = $('#pdf-content').html();
			var css = "<style>table{border-collapse: collapse; width:100%;} table,th,td {border: 1px solid black; padding: 5px;}</style>";

			var html = css + htmlHeader + htmlContent + datum;
			
			$('#html-hidden').val(html);

			$('#pdf-icon').click(function(){
				var form = $(this).closest("form");
     			form.submit();
			});
		});
	</script>
@stop