<?php
$action = (!empty($_POST['btn_submit']) &&
($_POST['btn_submit'] === 'Save')) ? 'save_reg'
: 'show_form';
switch($action){
case 'save_reg':
try {
$connection = new MongoClient();
$database = $connection->selectDB('apptect');
$collection = $database->
selectCollection('registrations');
$registration = array(
'dregnum' => $_POST['regnum'],
'ddname' => $_POST['dname'],
'dtname' => $_POST['tname'],
'dptype' => $_POST['ptype'],

'saved_at' => new MongoDate()
);
$collection->insert($registration);
} catch(MongoConnectionException $e) {
die("Failed to connect to database ".
$e->getMessage());
}
catch(MongoException $e) {
die('Failed to insert data '.$e->getMessage());
}
break;
case 'show_form':
default:
}
?>

<html>
<head>
<title>New Registration</title>
<link href = "css/bootstrap.min.css" rel = "stylesheet">
</head>
  <body>
  <?php if ($action === 'show_form'): ?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>"
method="post">
     <h4> Please Fill out the form for new registration </h4>
     <form class="form-group" form method="post">
     Vehicle Registration Number:
     <input type="text" name="regnum" class="form-control" required><br>
     Driver Name:
     <input type="text" name="dname"  class="form-control" required><br>
     Transporter Name:
     <input type="text" name="tname" class="form-control" required><br>
     <div class="radio">
     Select A Payment Method:
     <label><input type="radio" name="ptype" value="hrbasis" checked>Hour Basis</label>
     <label><input type="radio" name="ptype" value="kmbasis" >Kilometer Basis</label>
     </div>
     <input type="submit" name="btn_submit" value="Save">
     </form> 
     <?php else: ?>
     <p>
     Registration saved. _id:<?php echo $registration['_id'];?>.
     <a href="newreg.php">
     New Registration</a>
     </p>
     <?php endif;?>
  </body></html>

