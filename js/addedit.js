$(function(){

	$('#regform').submit(function(e){
    	e.preventDefault();

    	var data = $(this).serializeArray();

    	console.log(data);

    	$.post('addEditController.php', data ,function(response){

			if( response.success ){
				console.log(response);
				
				$('#reguser').prepend(
						$('<tr/>',{'data-id': response.id['$id']})
						.append('<td>' + response.name + '</td>')
						.click(function(){
							$()

						})
					);

			}

    	},'JSON');

    	

	});

  //SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '520px'
  });



});
