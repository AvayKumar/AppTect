$(function(){


	$('#vehiclebox a:first-child').addClass('active');


$('#vehiclebox a').click(function(){
	$(this).siblings().removeClass('active');
	$(this).addClass('active');
});

//SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '300px'
  });

  

});  