<?php
$action = (!empty($_POST['btn_submit']) && ($_POST['btn_submit'] === 'Save')) ? 'save_reg' : 'show_form';
	$connection = new MongoClient();
	$database = $connection->selectDB('apptect');
	$collection = $database->selectCollection('registrations');
	

	//Update existing data
	if( isset($_POST['update']) ) {
      $collection->update(array('_id' => new MongoId($_POST['id'])),
      			array( 
      			'dregnum' => $_POST['regnum'],
				'ddname' => $_POST['dname'],
				'dtname' => $_POST['tname'],
				'dptype' => $_POST['ptype'],
				'saved_at' => new MongoDate() ));
	}
	if( isset($_GET['edit']) ) 
		$_POST['id'] = $_GET['edit'];
	$registration = $collection->findOne(array('_id' => new MongoId($_POST['id'])));

?>


<html>
<head>
<title>New Registration</title>
<link href = "css/bootstrap.min.css" rel = "stylesheet">
</head>
  <body>
  <?php if ($action === 'show_form'): ?>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  	 <input type="hidden" name="id" value="<?php if( isset($_GET['edit']) ) echo $_GET['edit']?>" />
     <h4> Please Fill out the form for new registration </h4>
     <form class="form-group" form method="post">
     Vehicle Registration Number:
     <input type="text" name="regnum" class="form-control" value="<?php echo $registration['dregnum']  ?>" required><br>
     Driver Name:
     <input type="text" name="dname"  class="form-control" value="<?php echo $registration['ddname']  ?>" required><br>
     Transporter Name:
     <input type="text" name="tname" class="form-control" value="<?php echo $registration['dtname'] ?>" required><br>
     <div class="radio">
     Select A Payment Method:
     <label><input type="radio" name="ptype" value="hrbasis" checked>Hour Basis</label>
     <label><input type="radio" name="ptype" value="kmbasis" >Kilometer Basis</label>
     </div>
     <input type="submit" name="update" value="Update">
     </form> 
     <?php else: ?>
     <p>
     Registration saved. _id:<?php echo $registration['_id'];?>.
     <a href="newreg.php">
     New Registration</a>
     </p>
     <?php endif;?>
  </body></html>
