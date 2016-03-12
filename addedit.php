<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>

    <?php require 'components/styles.php' ?>

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
          <!-- Small boxes (Stat box) -->

          <!-- Main row -->
          <div class="row">
             <div class="col-md-8">
                <div class="box box-primary">
                <div class="box-header">
                  <i class="fa fa-registered"></i>
                  <h3 class="box-title">Quick Registration</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /. tools -->
                </div>
                <div class="box-body">
                  <form id="regform" action="#" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control" name="regnum" placeholder="Vehicle Registraion No" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="dname" placeholder="Driver Name" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="tname" placeholder="Transport Name" required>
                    </div>
                    <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="ptype" id="optionsRadios1" value="hr" checked="">
                          Hour Based
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="ptype" id="optionsRadios2" value="km">
                          Kilometer Based
                        </label>
                      </div>
                    </div>
                   <input type="submit" id="submit" style="display:none">
                  </form>
                </div>
                <div class="box-footer clearfix">
                  <button type="button" class="pull-right btn btn-primary" onclick="document.getElementById('submit').click()">Submit <i class="fa fa-arrow-circle-right"></i></button>
                </div>
              </div>
          </div> 
            <!-- Left col -->
            <section class="col-lg-4">
  
              <!-- Chat box -->
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-users"></i>
                  <h3 class="box-title">Registered Driver</h3>
                 
                </div>
                <div class="box-body" id="chat-box">
                  <div class="box-body no-padding">
                  <table class="table table-striped table-hover">
                  <thead><tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                    </tr>
               
                
                   
                  
                      
                  </tbody></table>
                </div>

                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="input-group">
                    <input class="form-control" placeholder="Type message...">
                    <div class="input-group-btn">
                      <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div><!-- /.box (chat box) -->

 

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
