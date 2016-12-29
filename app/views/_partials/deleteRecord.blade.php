<script>
	function deleteRecord(resource,id){
		if (confirm('Weet u zeker dat u het wilt verwijderen?')) {
		    $.ajax({
		      type: "DELETE",
		      url: '/' + resource + '/' + id,
    		  dataType: "html",
    		  data: {},
		      success: function(data) {
		      	
				var msg = "<div class='uk-alert uk-alert-success'><a href='' class='uk-alert-close uk-close'></a> <ul><li>Het gegeven is met succes verwijderd.</li></ul>  </div>";

				$('#melding').html(msg);
		      }
		    });
	  	}
	}
</script>