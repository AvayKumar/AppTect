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
          <div id="message" class="alert" style="display:none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p></p>
          </div>
<?php
            try {
                  $connection = new MongoClient();
                  $database = $connection->selectDB('apptect');
                  $collection = $database->selectCollection('registrations');

                  $cursor = $collection->find();

                  } catch(MongoConnectionException $e) {
                  die("Failed to connect to database ".$e->getMessage());
                  } catch(MongoException $e) {
                  die('Failed to insert data '.$e->getMessage());
                  }                    
              ?>

          <!-- Main Page Content -->
                    <div class="row">
             <div class="col-md-5">
                <div class="box box-primary">
                <div class="box-header">
                  <i class="fa fa-registered"></i>
                  <h3 class="box-title">Create New Job</h3>
                </div>
                <div class="box-body">

                  <form id="jobform" name="subform"  action="#" method="post" >

                    <div class="form-group">
                      <select id="dropdown" name="regnum" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="" disabled selected>Select A Vehicle</option>
<?php                   

                    while ($cursor->hasNext()):
                        $registration = $cursor->getNext(); 
                       echo '<option  value="'.$registration['regnum'].'">'.$registration['regnum'].'</option>';

                    endwhile; ?> 

                      </select>
                    </div>

                    <div class="form-group">
                      <input type="text" id="sourceLoc" class="form-control" name="jloc" placeholder="Source Location" required>
                    </div>

                    <div class="form-group">
                      <input type="text" id="destLoc" class="form-control" name="jloc" placeholder="Destination Location" required>
                    </div>


                    <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="ptype" id="optionsRadios1" data-place="Amount Per Hour" value="hr" required>
                          Hour Based
                        </label>
                      </div>

                      <div class="radio">
                        <label>
                          <input type="radio" name="ptype" id="optionsRadios2" data-place="Amount Per Kilometer" value="km" required>
                          Kilometer Based
                        </label>
                      </div>

                      <input type="text" class="form-control" id="radclk" name="prate" class="form-control" style="display:none"> 
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" name="supname" placeholder="Supervisor Name" required>
                    </div>

                   <input type="submit" name="submit" value="submit" id="submit" style="display:none" />
                  </form>
                </div>

                <div class="box-footer clearfix">
                  <button id="subbutt" type="button" class="pull-right btn btn-primary" onclick="document.getElementById('submit').click();  ">Submit <i class="fa fa-arrow-circle-right"></i></button>
                </div>
              </div>
              </div>
              <div class="col-md-7">
                <div class="box box-primary">
                  <div class="box-header">
                    <i class="fa fa-map-marker"></i>
                    <h3 class="box-title">Map For JOB</h3>
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
      </div><!-- /.content-wrapper -->

        <?php require 'components/footer.php' ?>

    </div><!-- ./wrapper -->

   <?php require 'components/scripts.php' ?>
   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
   <script type="text/javascript" src="js/job.js"></script>
   <script type="text/javascript" src="js/addedit.js"></script>
   <script type="text/javascript" src="js/gmap.js"></script>

  </body>
</html>
