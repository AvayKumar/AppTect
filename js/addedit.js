$(function(){

	$('input[name=ptype]').change(function(){

    var value = $( 'input[name=ptype]:checked' ).val();
    alert(value);
});

	function cl(m){
		console.log(m);
	}

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
				$('#regform input[name="prate"]').val(response.prate);
				$('#regform input[name="imei"]').val(response.imei);
				$('#regform input[name="phone"]').val(response.phone);

				$('#subbutt').attr('onclick','document.getElementById("update").click();');
				$('#subbutt').empty().append('Update <i class="fa fa-arrow-circle-right"></i>');
				if( response.ptype == 'hr' ) {
					$('#option1').prop("selected", true);
				}else if ( response.ptype == 'km'){
					$('#option2').prop("selected", true);	
				}
					
				

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

	$('.rowclk').click(function(){
		id = $(this).attr('data-id');
		console.log(id);
		fetchdata(id);	
	});

	$( "select" ).change(function() {
	$( "select option:selected" ).each(function() {
  
	$('input[name="prate"]').attr("placeholder", $(this).attr('data-place'));
	});
});
	//Post For Updating Registration
	$('#update').click(function(){
		console.log('clicked successfully');
		var data = $('#regform').serializeArray();
		data.push({ 'name': 'id', 'value': id});

		$.post('updatecontroller.php', data ,function(response){

			console.log(response);

			if( response.success ){
				console.log(response);
				
				document.subform.reset();
				$('#reguser tr[data-id=' + id + '] td:first-child').text(response.name);
				showMessage('alert-success', 'Updated <b>Successfull</b>');
			}

	},'JSON');

});

  //SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '520px'
  });



});
