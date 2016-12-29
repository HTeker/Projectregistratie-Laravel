@extends('main')

@section('content')
	@if(!$cohorts->isEmpty())
		<div id="pdf-header">
			<h2>Alle cohorten</h2>
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
			            <th>Cohort</th>
			            <th>Crebo</th>
			        </tr>
			    </thead>
			    <tbody>
			        @foreach($cohorts as $cohort)
				        <tr>
				            <td> {{ $cohort->id }} </td>
				            <td> {{ $cohort->naam }} </td>
				            <td> {{ $cohort->crebos->naam }} ({{ $cohort->crebos->nummer }}) </td>
				        </tr>
			        @endforeach
			    </tbody>
			</table>
		</div>
	@else
		nog geen cohorten
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