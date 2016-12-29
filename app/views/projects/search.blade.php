@extends('main')

@section('content')
	<h2>Zoeken per afgeronde project</h2>
	
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	{{ Form::open(array('class'=>'uk-form')) }}
			<div class="uk-form-row">
				<div class="uk-form-icon">
				    <i class="uk-icon-search"></i>
				    {{ Form::text('projectnaam',null,array('placeholder'=>'Zoek een project','class'=>'uk-width-1-1')) }}
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
			<h2 class="text-center">Project: PHP OOP</h2>
			<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
			    <thead>
			        <tr>
			            <th>Leerling</th>
			            <th>Beoordeling</th>
			            <th>Commentaar</th>
			            <th>Deadline</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			            <td>Halil Teker</td>
			            <td>6.5</td>
			            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus faucibus, lectus vel vulputate vulputate, metus est sollicitudin turpis, at rutrum elit enim a lacus.</td>
			            <td>16-06-2014</td>
			        </tr>
			        <tr>
			        	<td>Mustafa Ekici</td>
			            <td>n.v.t.</td>
			            <td>n.v.t.</td>
			            <td>16-06-2014</td>
			        </tr>
			        <tr>
			        	<td>Lorem</td>
			            <td>n.v.t.</td>
			            <td>n.v.t.</td>
			            <td>n.v.t.</td>
			        </tr>
			    </tbody>
			</table>
        </div>
    </div>
@stop