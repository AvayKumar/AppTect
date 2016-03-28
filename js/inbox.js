$(function(){

			//SLIMSCROLL FOR CHAT WIDGET
			  $('#chat-box').slimScroll({
			    height: '300px'
			  });
			$('#chat-box').slimScroll({ scrollTo: $('#chat-box')[0].scrollHeight});
			$('#chat-box').slimScroll({ scrollBy: '50px' });
  

	  		//Scroll setting and send message

			$('#send').click(function(){
				/*var name = $('#vehiclebox a.active').text();*/
				var message = $('#tmessage').val();
				
				
				/*$('#chat-box').animate({scrollTop:$(document).height()}, 'slow');*/
				var id = $('#vehiclebox a.active').attr('data-id');
				var data = $(this).serializeArray();
				data.push({ 'name': 'id', 'value': id});
				data.push({ 'name': 'message', 'value': message});
				data.push({ 'name': 'msname', 'value' : 'Admin'});

				$.post('controllers/messageController.php', data ,function(response){

					if( response.success ){
						console.log(response);
						console.log(response.id['$id']);

						$('#chat-box').append('<div class="item"><img src="img/admin.png" alt="user image" class="online"><p class="message"><a href="#" class="name"><small class="text-muted pull-right"><i class="fa fa-clock-o"></i>'+ response.time +'</small>Admin</a>' + message + '</p></div>');
					}
					var height = $('#chat-box')[0].scrollHeight;
					$('#chat-box').slimScroll({ scrollTo: height});

    			},'JSON');

				
			});

				
				

				$('#vehiclebox a').click(function(){

					$(this).siblings().removeClass('active');
					$(this).addClass('active');
					$('#chat-box').html('');

					var id = $(this).attr('data-id');
			
					var data = [];
					data.push({ 'name': 'id', 'value': id})

					$.post('controllers/messageload.php', data ,function(response){

						if( response.success ){
							console.log(response);
							var count = Object.keys(response).length;
  							console.log(count);


						}
						for (var i=0; i < count-1 ; i++) {
							if (response[i].msname == 'Admin'){
								var img = 'admin';
							}else {
							    img = 'user';
							    } 
						$('#chat-box').append('<div class="item"><img src="img/'+ img +'.png" alt="user image" class="online"><p class="message"><a href="#" class="name"><small class="text-muted pull-right"><i class="fa fa-clock-o"></i>'+ response[i].time +'</small>'+ response[i].msname +'</a>' + response[i].message + '</p></div>');
						}
						var height = $('#chat-box')[0].scrollHeight;
						$('#chat-box').slimScroll({ scrollTo: height});
					

					},'JSON');

				});
				
				// Selcting clicked element
				$('#vehiclebox a:first-child').addClass('active').click();

				
});  