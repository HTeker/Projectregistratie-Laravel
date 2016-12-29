@extends('main')

@section('content')
	<h2>Wijzig een cohort</h2>
	
	<div class="uk-grid">
        <div class="uk-width-1-1">
        	{{ Form::open(array('class'=>'uk-form', 'id'=>'search-form')) }}
				<div class="uk-form-row">
					<div class="uk-form-icon">
					    <i class="uk-icon-search"></i>
					    {{ Form::text('zoekopdracht',null,array('placeholder'=>'Zoek een cohort','class'=>'uk-width-1-1', 'id'=>'search', 'autofocus'=>'autofocus', 'autocomplete'=>'off')) }}
					</div>
					<div id="suggesties">
						
					</div>
				</div>
			{{ Form::close() }}
			<br>

			{{ Form::open(array('class'=>'uk-form', 'id'=>'editform')) }}
				<div id="formedit">
					<h2 class="text-center">Cohort: <span id="naam"></span></h2>
						<div id="melding"></div>
					{{ Form::hidden('id', null,array('class'=>'id')) }}
					<div class="uk-form-row">
					{{ Form::text('naam',null,array('placeholder'=>'Naam','class'=>'uk-width-1-1 naam', 'autofocus'=>'autofocus')) }}
					</div>
					<div class="uk-form-row">
				        <span id="options"></span>
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
						url: '/cohorts/search',
						datatype: 'html',
						data: { query: $(this).val() },
						success: function(data){


							var msg = "<table class='suggesties'><tbody>";
							
							if(data.length == 0){
								msg += "<tr><td class='geen-resultaten'>geen resultaten</td></tr>";
							}else{
								
								$.each(data, function() {
									
									msg += "<tr><td id='search-result'><a onclick='setValue(\"" + this.naam + "\"," + this.id + ");'><div>" + this.naam + "</div></a></td></tr>";
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
				url: '/cohorts/searchp',
				datatype: 'html',
				data: { query: id },
				success: function(data){

					var crebos = "<select name='crebo' class='crebo'><option value='default'>Selecteer een crebo</option>"; // var to generate options in the select tag
					var selectedCrebo;
					
					if(data.length != 0){
					    $.each(data, function(key, value) {
					        if(key === "crebos"){
					        	for(var i=0; i<this.length; i++){
					        		console.log(this[i]['naam']);
					        		

					        		if(this[i]['id'] == selectedCrebo){
					        			crebos += "<option value='" + this[i]['id'] + "' selected>" + this[i]['naam'] + "</option>";
					        		}else{
					        			crebos += "<option value='" + this[i]['id'] + "'>" + this[i]['naam'] + "</option>";
					        		}
					        			//alert(selectedCrebo);
					        	}
					        }else{
					            // another code
					            $('#formedit').show();
								$('#naam').html(this.naam);
								$('.naam').val(this.naam);
								$('.id').val(this.id);
								selectedCrebo = this.crebo;
					        }
					    });

					    crebos += "</select>";

					    $('#options').html(crebos);
					}
				}
			});
		}

		$('#editform').submit(function(e){
			e.preventDefault();

			var resource = "cohorts";
			var id = $('.id').val();
			var naam = $('.naam').val();
			var crebo = $('.crebo').val();

			if (confirm('Weet u zeker dat u het wilt wijzigen?')) {
			    $.ajax({
			      type: "PUT",
			      url: '/' + resource + '/' + id,
	    		  dataType: "json",
	    		  data: { naam:naam,
	    		  		  crebo:crebo,
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