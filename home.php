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

				        <?php
				            try {
				                  $connection = new MongoClient();
				                  $database = $connection->selectDB('apptect');
				                  $collection = $database->selectCollection('registrations');

				                  $cursor = $collection->find();
				                  $cursor2 = $collection->find();

				                  } catch(MongoConnectionException $e) {
				                  die("Failed to connect to database ".$e->getMessage());
				                  } catch(MongoException $e) {
				                  die('Failed to insert data '.$e->getMessage());
				                  }                    
              			?>

				        <!-- Main Page Content -->
				        <div class="row">
             			<div class="col-md-6">
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

              			<!-- Left col 1 -->
            			<div class="col-md-3">
            			<div class="box box-success">
			                <div class="box-header">
			                  <i class="fa fa-users"></i>
			                  <h3 class="box-title">Drivers</h3>
			                 
			                </div>
			                <div class="box-body" id="vehiclebox">
			                <div class="box-body no-padding">
			                  <table class="table table-striped table-hover">
			                    <thead>

			                 	</thead>
                    				<tbody id="vehicle">
<?php                   

                while ($cursor->hasNext()):
                    $registration = $cursor->getNext(); 
                   echo '<tr class="rowclk" data-id="'.$registration['_id'].'">';
                   echo '<td>'.$registration['dname'].'</td>';
                   echo '</tr>';

                    endwhile; ?> 
                    				</tbody></table>
                			</div>

                			</div><!-- /.chat -->
                			</div>
                			</div>


                			<!-- Left col 2 -->
	            			<div class="col-md-3">
	            			<div class="box box-success">
			                <div class="box-header">
			                  <i class="fa fa-users"></i>
			                  <h3 class="box-title">Jobs</h3>
			                 
			                </div>
			                <div class="box-body" id="jobbox">
			                <div class="box-body no-padding">
			                  <table class="table table-striped table-hover">
			                    <thead>

			                 	</thead>
                    			<tbody id="job">
				<?php                   

                while ($cursor2->hasNext()):
                    $registration = $cursor2->getNext(); 
                   echo '<tr class="rowclk" data-id="'.$registration['_id'].'">';
                   echo '<td>'.$registration['dname'].'</td>';
                   echo '</tr>';

                    endwhile; ?> 
                    				</tbody></table>
                			</div>

                			</div><!-- /.chat -->
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
