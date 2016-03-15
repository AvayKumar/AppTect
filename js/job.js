$(function(){

				$('#jobform').submit(function(e){
				    	e.preventDefault();
				    	var data = $(this).serializeArray();
				    	console.log(data);

    				$.post('jobcontroller.php', data ,function(response){
    					if( response.success ){
							console.log(response);
							document.subform.reset();
						}
						
						},'JSON');

					});
});

