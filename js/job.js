$(function(){

				function showMessage(_class, message){
					$('#message')
					.addClass(_class)
					.find('p').append(message);
					$('#message').slideDown();
					setTimeout(function(){
						$('#message').slideUp(function(){
							$('#message')
							.addClass(_class)
							.find('p').empty();	
						});
					}, 10000);

				}





				  $('#jobform').submit(function(e){
					    e.preventDefault();

					    var data = $(this).serializeArray();
					    console.log( data );


    				$.post('jobcontroller.php', data ,function(response){
    					if( response.success ){
							console.log(response);
							document.subform.reset();
							showMessage('alert-success', 'Job Registration <b>Successfull</b>');
						}
						
						},'JSON');

					});
});

