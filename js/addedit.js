$(function(){

	$('#regform').submit(function(e){
    	e.preventDefault();

    	var data = $(this).serializeArray();

    	console.log(data);

    	$.post('addEditController.php',data,function(response){
			console.log(response);

			if( response.success ){
				
			}

    	},'JSON');

    	

	})

});
