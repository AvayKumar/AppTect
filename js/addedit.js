$(function(){

	$('#regform').submit(function(e){
    	e.preventDefault();

    	var data = $(this).serializeArray();

    	console.log(data);

    	$.post('addEditController.php',data,function(response){
			console.log(response);

			if( response.success ){
				console.log(data[1].value);
				
			}

    	},'JSON');

    	

	});

  //SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '250px'
  });



});
