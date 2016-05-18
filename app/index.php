
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AppTectMessage">
    <meta name="author" content="Avay Kumar Das">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<style>		
		body{
			background:#ebeef0;
		}
		.nano {
			width: 100%;
		}
		.nano>.nano-content {
			position: absolute;
			overflow: scroll;
			overflow-x: hidden;
			width: 100%;
		}
		.pad-all {
			padding: 18px 15px 50px 15px;
		}
		.mar-btm {
			margin-bottom: 15px;
		}
		.media-block .media-left {
			display: block;
			float: left;
		}
		.img-sm {
			width: 46px;
			height: 46px;
		}
		.media-block .media-body {
			display: block;
			width: auto;
		}
		.pad-hor {
			padding-left: 15px;
			padding-right: 15px;
		}
		.speech {
			position: relative;
			background: #b7dcfe;
			color: #317787;
			display: inline-block;
			border-radius: 0;
			padding: 12px 20px;
		}
		.speech:before {
			content: "";
			display: block;
			position: absolute;
			width: 0;
			height: 0;
			left: 0;
			top: 0;
			border-top: 7px solid transparent;
			border-bottom: 7px solid transparent;
			border-right: 7px solid #b7dcfe;
			margin: 15px 0 0 -6px;
		}
		.speech-right>.speech:before {
			left: auto;
			right: 0;
			border-top: 7px solid transparent;
			border-bottom: 7px solid transparent;
			border-left: 7px solid #ffdc91;
			border-right: 0;
			margin: 15px -6px 0 0;
		}
		.speech .media-heading {
			font-size: 1.2em;
			color: #317787;
			display: block;
			border-bottom: 1px solid rgba(0,0,0,0.1);
			margin-bottom: 10px;
			padding-bottom: 5px;
			font-weight: 300;
		}
		.speech-time {
			margin-top: 20px;
			margin-bottom: 0;
			font-size: .8em;
			font-weight: 300;
		}
		.media-block .media-right {
			float: right;
		}
		.speech-right {
			text-align: right;
		}
		.pad-hor {
			padding-left: 15px;
			padding-right: 15px;
		}
		.speech-right>.speech {
			background: #ffda87;
			color: #a07617;
			text-align: right;
		}
		.speech-right>.speech .media-heading {
			color: #a07617;
		}
		.btn-primary, .btn-primary:focus, .btn-hover-primary:hover, .btn-hover-primary:active, .btn-hover-primary.active, .btn.btn-active-primary:active, .btn.btn-active-primary.active, .dropdown.open>.btn.btn-active-primary, .btn-group.open .dropdown-toggle.btn.btn-active-primary {
			background-color: #579ddb;
			border-color: #5fa2dd;
			color: #fff !important;
		}
		.btn {
			cursor: pointer;
			color: inherit;
			padding: 6px 12px;
			border-radius: 0;
			border: 1px solid 0;
			font-size: 11px;
			line-height: 1.42857;
			vertical-align: middle;
			-webkit-transition: all .25s;
			transition: all .25s;
		}
		.form-control {
			font-size: 11px;
			height: 100%;
			border-radius: 14px;
			box-shadow: none;
			border: 1px solid #e9e9e9;
			transition-duration: .5s;
		}
		/* My custom styles */
		.container-fluid{
			padding-right: 0px;
			padding-left: 0px;
		}
		.panel-footer{
			position: fixed;
			bottom: 0px;
			left: 0px;
			right: 0px;
			z-index:50;
			box-shadow: 0px -1px 17px #888888;
		}
		.chat-btn{
			border-radius: 14px;
		}
	</style>
  </head>

  <body>

		<div class="container-fluid">
		    
			<!--Widget body-->
			<div class="nano">
				<div class="nano-content pad-all">
					<ul id="chat-box" class="list-unstyled media-block">
					</ul>
				</div>

				<!--Widget footer-->
				<div class="panel-footer">
					<div class="row">
						<div class="col-xs-9">
							<input id="message" type="text" placeholder="Enter your text" class="form-control chat-input">
						</div>
						<div class="col-xs-3">
							<button id="send" class="btn chat-btn btn-primary btn-block" type="button">Send</button>
						</div>
					</div>
				</div>
			</div>
		</div><!-- container-fluid -->
<script type="text/javascript" src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">

	var skip = 0;
	var limit = 5;
	var firstLoad = true;
	var id = '';

	function setId(cId){
		id = cId;
	}

	function reload() {

		$.get('../controllers/messageload.php?id=' + id +'&skip=' + skip + '&limit=' + limit, function(response){

			if( response.success ) {
				console.log(response);

				for (var i=0; response[i] != undefined; i++) {
					if ( response[i].msname == 'Admin' ){
						$('#chat-box').prepend('<li class="mar-btm"><div class="media-left"><img src="../img/admin.png" class="img-circle img-sm" alt="Profile Picture"></div><div class="media-body pad-hor"><div class="speech"><a href="javascript:void(0)" class="media-heading">Admin</a><p>' + response[i].message + '</p><p class="speech-time"><i class="fa fa-clock-o fa-fw"></i> ' + response[i].time + '</p></div></div></li>');
					} else {
						$('#chat-box').prepend('<li class="mar-btm"><div class="media-right"><img src="../img/user.png" class="img-circle img-sm" alt="User Profile Picture"></div><div class="media-body pad-hor speech-right"><div class="speech"><a href="javascript:void(0)" class="media-heading">Me</a><p>' + response[i].message + '</p><p class="speech-time"><i class="fa fa-clock-o fa-fw"></i> ' + response[i].time + '</p></div></div></li>');
					} 
				}
				skip = skip + limit;
				if( firstLoad ){
					$("html, body").animate({ scrollTop: $(document).height() }, 1000);
					firstLoad = false;
				}
			}
			Android.dismissLoader();
		},'JSON');
			
	}

	$(function() {

		$('#send').click(function() {

			var message = $('#message').val();
			var data = $(this).serializeArray();
			data.push({ 'name': 'id', 'value': id});
			data.push({ 'name': 'message', 'value': message});
			data.push({ 'name': 'msname', 'value' : 'User'});
			if( message != '' ) {
				
				$.post('../controllers/messagecontroller.php', data ,function(response){

					if( response.success ) {
						$('#chat-box').append('<li class="mar-btm"><div class="media-right"><img src="../img/user.png" class="img-circle img-sm" alt="User Profile Picture"></div><div class="media-body pad-hor speech-right"><div class="speech"><a href="#" class="media-heading">Me</a><p>' + message + '</p><p class="speech-time"><i class="fa fa-clock-o fa-fw"></i> ' + response.time + '</p></div></div></li>');
						$('#message').val('');
						$("html, body").animate({ scrollTop: $(document).height() }, 1000);
					}

    			},'JSON');

			}
		});
	});
</script>

</body>
</html>
