<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>

    <?php require 'components/styles.php' ?>
        <link rel="stylesheet" href="css/customstyle.css" >
        <link rel="stylesheet" type="text/css" media="screen" title="User Defined Style" href="css/jquery-ui-1.8.16.custom.css" >

  </head>
			    <body class="hold-transition skin-blue sidebar-mini">
			    <div class="wrapper">

			      <?php require 'components/header.php' ?>
			      
			      <?php require 'components/sidebar.php' ?>

				      <!-- Content Wrapper. Contains page content -->
				      <div class="content-wrapper">
				        <!-- Content Header (Page header) -->
				        <section class="content-header">
				          <h1>
				            Dashboard
				            <small>Control panel</small>
				          </h1>
				          <ol class="breadcrumb">
				            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				            <li class="active">Dashboard</li>
				          </ol>
				        </section>

                		<!-- Main content -->
				        <section class="content">

				        <!-- Main Page Content -->
				        <div class="row">
             			<div class="col-md-7">
             			<div class="box box-primary">
		                  <div class="box-header">
		                    <i class="fa fa-map-marker"></i>
		                    <h3 class="box-title">Map Of JOBS</h3>
		                  </div>

		                  <div class="box-body">
		                    <div class='gmaps'>
		                        <div id='gmaps-error'></div>
		                        <div id='gmaps-canvas' class="col-xs-12"></div>
		                    </div>
              			</div>
                 		</div> 
              			</div>
        
          				</div><!-- /.row (main row) -->

        				</section><!-- /.content -->

				        </div>
				        <?php require 'components/footer.php' ?>
				        </div>

				        <?php require 'components/scripts.php' ?>
						   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
						   <script type="text/javascript" src="js/job.js"></script>
						   <script type="text/javascript" src="js/addedit.js"></script>
						   <script type="text/javascript" src="js/gmap.js"></script>

  </body>
</html>
