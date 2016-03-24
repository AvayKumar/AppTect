<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>

    <?php require 'components/styles.php' ?>
    <link rel="stylesheet" href="css/customstyle.css" >

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
          <div id="message" style="display:none">
            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
            <p></p>
          </div>

          <!-- Main row -->
          <div class="row">
             <div class="col-md-8">
                <div class="box box-primary">
                <div class="box-header">
                  <i class="fa fa-registered"></i>
                  <h3 class="box-title">Quick Registration</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools" id="addnew" >
                    
                  </div><!-- /. tools -->
                </div>
                <div class="box-body">
                  <form id="regform" name="subform"  action="#" method="post" >
                    <div class="form-group">
                      <input type="text" class="form-control" name="regnum" placeholder="Vehicle Registraion No" id="vname" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="dname" placeholder="Driver Name" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="tname" placeholder="Transport Name" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="imei" placeholder="IMEI Number" required>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">+91</i></span>
                      <input type="text" class="form-control" name="phone" placeholder="SIM Card Number" maxlength="10" required>
                       </div> 
                    </div>

                    <div class="form-group">
                      <div class="input-group" id="radclk"  >
                          <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" style="background:#FFFFFF"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Payment Basis <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a id="option1" data-place="Amount Per Hour" href="javascript:void(0)"> Per Hour </a></li>
                              <li><a id="option2" data-place="Amount Per Kilometer" href="javascript:void(0)"> Per Kilometer </a></li>
                            </ul>
                        </div><!-- /btn-group -->                        
                        <input type="hidden" id="ptype" name="ptype" value=""/>

                        <input type="number" class="form-control"  name="prate" class="form-control" required>
                        <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                      </div> 
                    </div>

                   <input type="submit" name="submit" value="submit" id="submit" style="display:none" />
                   <input type="button" name="update" value="update" id="update" style="display:none" />
                  </form>
                </div>
                <div class="box-footer clearfix">
                  <button id="subbutt" type="button" class="pull-right btn btn-primary" onclick="document.getElementById('submit').click();  ">Submit <i class="fa fa-arrow-circle-right"></i></button>
                </div>
              </div>
          </div> 
            <!-- Left col -->
            <section class="col-lg-4">

<?php
            try {
                  $connection = new MongoClient();
                  $database = $connection->selectDB('apptect');
                  $collection = $database->selectCollection('registrations');

                  $cursor = $collection->find()->sort(array('saved_at'=>-1));

                  } catch(MongoConnectionException $e) {
                    die("Failed to connect to database ".$e->getMessage());
                  } catch(MongoException $e) {
                    die('Failed to insert data '.$e->getMessage());
                  }                    
              ?>
 
              <!-- Chat box -->
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-users"></i>
                  <h3 class="box-title">Registered Driver</h3>
                 
                </div>
                <div class="box-body" id="chat-box">
                  <div class="box-body no-padding">
                                  

                    <div class="list-group" id="reguser">
                      <?php                   

                                    while ($cursor->hasNext()) : 
                                        $registration = $cursor->getNext();
                                        echo '<button type="button" class="close delbutton" data-id="'.$registration['_id'].'">×</button>';
                                       echo '<a href="javascript:void(0);" class="rowclk list-group-item" data-id="'.$registration['_id'].'">'.$registration['dname'].'</a>';
                                       
                 
                                    endwhile; ?> 

                    </div>
                </div>

                </div><!-- /.chat -->
                

 

            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

        <?php require 'components/footer.php' ?>

    </div><!-- ./wrapper -->

   <?php require 'components/scripts.php' ?>
   <script type="text/javascript" src="js/addedit.js"></script>
  </body>
</html>
