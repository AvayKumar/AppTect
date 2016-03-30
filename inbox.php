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

				        	<div class="row">
				        		
	              			<!-- Drivers -->
	            			<div class="col-md-4">
		            			<div class="box box-success">
					                <div class="box-header">
					                  <i class="fa fa-users"></i>
					                  <h3 class="box-title">Drivers</h3>
					                 
					                </div>
					                <div class="box-body" id="vehiclebox">
						                <div class="box-body no-padding">
						                  <div class="list-group">
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
		              			
					                while ($cursor->hasNext()):
					                    $registration = $cursor->getNext(); 
					                	echo '<a href="javascript:void(0);" class="rowclk list-group-item" data-id="'.$registration['_id'].'">'.$registration['dname'].'</a>';

					                    endwhile; ?> 
			                    				</div>
			                			</div>

		                			</div>
	                			</div>
                			</div> <!-- Driver Box -->

                			<!-- Chat Messages -->
                			<div class="col-md-7">
                			<div class="box box-success">
				                <div class="box-header ui-sortable-handle" style="cursor: move;">
				                  <i class="fa fa-comments-o"></i>
				                  <h3 class="box-title">Chat</h3>
				                </div>
                <div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">
                  
			                  
                  				
                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="input-group">
                    <input class="form-control" id="tmessage" placeholder="Type message...">
                    <div class="input-group-btn">
                      <button class="btn btn-success" id="send"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              </div>
				        </div><!-- row -->

				        </section><!-- Main Content -->

				        </div><!-- content wrapper -->
				        <?php require 'components/footer.php' ?>
				     </div><!-- wrapper -->

				        <?php require 'components/scripts.php' ?>
				        <script type="text/javascript" src="js/inbox.js"></script>
  </body>
</html>
