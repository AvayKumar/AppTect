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

	function fetchdata(id){

		var data = {'id': id};
		console.log(data);
		$.post('editcontroller.php', data, function(response){
			console.log(response);	
			if( response.success ) {
				$('#regform input[name="regnum"]').val(response.regnum);
				$('#regform input[name="dname"]').val(response.dname);
				$('#regform input[name="tname"]').val(response.tname);
				$('#regform input[name="ptype"]').val(response.ptype);
				$('#subbutt').empty().append('Update <i class="fa fa-arrow-circle-right"></i>');			
			}
		}, 'JSON');
	}

	$('#regform').submit(function(e){
    	e.preventDefault();

    	var data = $(this).serializeArray();

    	console.log(data);



    	$.post('addController.php', data ,function(response){

			if( response.success ){
				console.log(response);
				
				$('#reguser').prepend(
						$('<tr/>',{'data-id': response.id['$id']})
						.append('<td>' + response.name + '</td>')
						.click(function(){
							
							var id = $(this).attr('data-id');
							console.log(id);
							fetchdata(id);	
						})
					);
				document.subform.reset();
				showMessage('alert-success', 'Registration <b>Successfull</b>');
			}

    	},'JSON');

    	

	});

  //SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '520px'
  });



});
