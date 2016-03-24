$(function(){

    deletion('button.delbutton');
	$('input[name=ptype]').change(function(){

    var value = $( 'input[name=ptype]:checked' ).val();
    alert(value);
});

	function cl(m){
		console.log(m);
	}

	function showMessage(_class, message) {

		if( !$('#message').is(':visible') ){

			$('#message')
			.attr('class','alert ' + _class)
			.find('p').html(message);
			$('#message').slideDown();
			messageTimeout = setTimeout(function(){
                       $('#message').slideUp(function(){
                               $('#message')
                               .addClass(_class)
                               .find('p').empty();
                       });
               }, 3000);

		} else {
			clearTimeout(messageTimeout);
			$('#message')
			.attr('class','alert ' + _class)
			.find('p').html(message);
			$('#message').slideDown();
			messageTimeout = setTimeout(function(){
                       $('#message').slideUp(function(){
                               $('#message')
                               .addClass(_class)
                               .find('p').empty();
                       });
               }, 3000);
		}

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
				
				$('input[name="ptype"]').val(response.ptype);
				$('#radclk .input-group-addon').html('<i class="fa fa-inr"></i><strong>/' + response.ptype +'</strong>')				

			}

		}, 'JSON');
	}

	$('#regform').submit(function(e){
    	e.preventDefault();
    	if ($('#ptype').val() == '') {
    		showMessage('alert-warning', 'Please Select <b>Payment Basis<b>');
    		return;
    	}
    	var data = $(this).serializeArray();

    	console.log(data);

    	$.post('addController.php', data ,function(response){


			if( response.success ){
				console.log(response);
				console.log(response.id['$id']);

				$('#reguser').prepend(
						$('<a href="javascript:void(0);" class="rowclk list-group-item" data-id="'+ response.id['$id'] +'"/>')
						.text(response.name)
						.click(function(){
							
							var id = $(this).attr('data-id');
							fetchdata(id);
								
						})
					);
				$('#reguser').prepend($('<button type="button" class="close delbutton" data-id="'+ response.id['$id'] +'">×</button>'));

				deletion('button.delbutton[data-id=' + response.id['$id'] + ']');
				setRowClick();
				document.subform.reset();

				showMessage('alert-success', 'Registration <b>Successfull</b>');
			}
			

    	},'JSON');

	});


	$('a.rowclk').click(function(){
		id = $(this).attr('data-id');
		console.log(id);
		fetchdata(id);
		var addnewbutton = $('<a  class="btn btn-primary " href="addedit.php"  data-toggle="tooltip" title="" style="margin-right: 5px;" ><i class="fa fa-plus"> Add New </i></a>');
		$('#addnew').empty().append(addnewbutton);	
	});

	$( "#option1, #option2" ).click(function() {
			$('input[name="prate"]').attr("placeholder", $(this).attr('data-place'));
			if ( $(this).attr('data-place') == 'Amount Per Hour' ){
				$('input[name="ptype"]').val('hr');
				$('#radclk .input-group-addon').html('<i class="fa fa-inr"></i><strong>/hr</strong>');
			} else {
				$('input[name="ptype"]').val('km');
				$('#radclk .input-group-addon').html('<i class="fa fa-inr"></i><strong>/km</strong>');
			}
	});
	//Post For Updating Registration
	$('#update').click(function(){
		console.log('clicked successfully');
		var data = $('#regform').serializeArray(); 
		data.push({ 'name': 'id', 'value': id});
		if ($('#ptype').val() == '') {
    		showMessage('alert-warning', 'Please Select <b>Payment Basis<b>');
    		return;
    	}

		$.post('updatecontroller.php', data ,function(response){


			if( response.success ){
				console.log(response);
								
				$('#reguser a[data-id=' + id + ']').text(response.name);
				showMessage('alert-success', 'Updated <b>Successfully</b>');

			}

	},'JSON');

});

  //SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '520px'
  });

 function setRowClick(){
	  	$('#chat-box a').click(function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		var addnewbutton = $('<a  class="btn btn-primary " href="addedit.php"  data-toggle="tooltip" title="" style="margin-right: 5px;" ><i class="fa fa-plus"> Add New </i></a>');
		$('#addnew').empty().append(addnewbutton);
	 });
}



	/*Deletion*/

	function deletion(delclass) {

	$(delclass).click(function(obj){
		var id = $(this).attr('data-id');
		var data = $(this).serializeArray();
		data.push({ 'name': 'id', 'value': id});

		console.log(data);

		if (confirm("Want to delete this registration?")) {
			$.post('controllers/deletecontroller.php', data ,function(response){
				

			if( response = true ){
				console.log('OK');
				$('#reguser a[data-id=' + id + ']').remove();
				$('button.delbutton[data-id=' + id + ']').remove();
				showMessage('alert-success', 'Deletion <b>Successfull</b>');
			}

    	});
		   
		}

	});

}

setRowClick();

});
