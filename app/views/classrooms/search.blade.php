@extends('main')

@section('content')
	<h2>Zoeken per klas</h2>
	
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	{{ Form::open(array('class'=>'uk-form')) }}
			<div class="uk-form-row">
				<div class="uk-form-icon">
				    <i class="uk-icon-search"></i>
				    {{ Form::text('klas',null,array('placeholder'=>'Zoek een klas','class'=>'uk-width-1-1')) }}
				</div>
			</div>
			<div class="uk-form-row">
				<select>
		            <option value="default">Selecteer een leerlingstatus</option>
		            <option value="bezig"><i class="uk-icon-cog"></i>Bezig</option>
		            <option value="uitgeschreven">Uitgeschreven</option>
		            <option value="gediplomeerd">Gediplomeerd</option>
		        </select>
			</div>
			<br>
			{{ Form::close() }}
			<h2 class="text-center">Klas: 4pa1a</h2>
			<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
			    <thead>
			        <tr>
			            <th>Leerling</th>
			            <th>HTML/CSS</th>
			            <th>PHP BASIS</th>
			            <th>PHP OOP</th>
			            <th>UML</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			            <td>Halil Teker</td>
			            <td>6.5</td>
			            <td>6.5</td>
			            <td>6.5</td>
			            <td>16-06-2014</td>
			        </tr>
			        <tr>
			        	<td>Mustafa Ekici</td>
			            <td>6.5</td>
			            <td>6.5</td>
			            <td>6.5</td>
			            <td>6.5</td>
			        </tr>
			        <tr>
			        	<td>Lorem</td>
			            <td>6.5</td>
			            <td>6.5</td>
			            <td>n.v.t.</td>
			            <td>n.v.t.</td>
			        </tr>
			    </tbody>
			</table>
        </div>
    </div>
@stop