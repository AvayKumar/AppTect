	var skip = 0;
	var limit = 10;
	var firstLoad = true;


	function load(obj){

		var id = $('#vehiclebox a.active').attr('data-id');

		$.get('controllers/messageload.php?id=' + id + '&skip=' + skip + '&limit=' + limit, function(response){

			if( response.success ) {
				console.log(response);
				var count = Object.keys(response).length;
				console.log(count);

				for (var i=0; i < count-1 ; i++) {
					if (response[i].msname == 'Admin'){
						var img = 'admin';
						_class = 'online';
					}else {
					    img = 'user';
					    _class = 'offline';
					} 
					$('#load').after('<div class="item"><img src="img/'+ img +'.png" alt="user image" class="' + _class +'"><p class="message"><a href="#" class="name"><small class="text-muted pull-right"><i class="fa fa-clock-o"></i>'+ response[i].time +'</small>'+ response[i].msname +'</a>' + response[i].message + '</p></div>');
				}

				skip = skip + limit;

				if( count == 1 ) {
					$(obj).remove();
				}

				if( firstLoad){
					var height = $('#chat-box')[0].scrollHeight;
					$('#chat-box').slimScroll({ scrollTo: height});
					firstLoad = false;
				}
				
			}

		},'JSON');
	}


$(function(){

			//SLIMSCROLL FOR CHAT WIDGET
			  $('#chat-box').slimScroll({
			    height: '300px'
			  });
			$('#chat-box').slimScroll({ scrollTo: $('#chat-box')[0].scrollHeight});
			$('#chat-box').slimScroll({ scrollBy: '50px' });
  

	  		//Scroll setting and send message

			$('#send').click(function() {
				/*var name = $('#vehiclebox a.active').text();*/
				var message = $('#tmessage').val();
				
				/*$('#chat-box').animate({scrollTop:$(document).height()}, 'slow');*/
				var id = $('#vehiclebox a.active').attr('data-id');
				var data = $(this).serializeArray();
				data.push({ 'name': 'id', 'value': id});
				data.push({ 'name': 'message', 'value': message});
				data.push({ 'name': 'msname', 'value' : 'Admin'});

				$.post('controllers/messagecontroller.php', data ,function(response){

					if( response.success ) {
						$('#chat-box').append('<div class="item"><img src="img/admin.png" alt="user image" class="online"><p class="message"><a href="#" class="name"><small class="text-muted pull-right"><i class="fa fa-clock-o"></i>'+ response.time +'</small>Admin</a>' + message + '</p></div>');
					}
					var height = $('#chat-box')[0].scrollHeight;
					$('#chat-box').slimScroll({ scrollTo: height});

    			},'JSON');

			});
				

			$('#vehiclebox a').click(function() {

				$(this).siblings().removeClass('active');
				$(this).addClass('active');
				$('#chat-box').html('<button id="load" type="button" class="btn btn-block btn-default" onclick="load(this)" style="margin-bottom: 15px">Load More</button>');
				skip = 0;
				limit = 10;
				firstLoad = true;
				load();

			});
				
			// Selcting clicked element
			$('#vehiclebox a:first-child').click();
				
});  