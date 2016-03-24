<?php
               try {
               $connection = new MongoClient();
               $database = $connection->selectDB('apptect');
               $collection = $database->selectCollection('registrations');
               } catch(MongoConnectionException $e) {
               die("Failed to connect to database ".$e->getMessage());
               }

               $cursor = $collection->find()->sort(array('saved_at'=>-1));
               ?>


<?php
	// Deleting registration from database
	if( isset( $_GET['delete'] ) ) {
		// TODO Delete form database
		$collection->remove(array('_id' => new MongoId($_GET['delete'])));
	}

?>

<html>
<head>
   <title>Registrations</title>
   <link href = "css/bootstrap.min.css" rel = "stylesheet">

   </head>
   <body>
     <h1> Registrations </h1>
     <table class="table">
     <thead>
     	<tr>
     		<th>Vehicle Name</th>
     		<th>Driver Name</th>
     		<th>Transporter Name</th>
     		<th>Payment Type</th>
     		<th>Edit</th>
     		<th>Delete</th>
     	</tr>
     </thead>
     <tbody>
     <?php while ($cursor->hasNext()):
     $registration = $cursor->getNext();
     echo '<tr>';
     echo '<td>'.$registration['regnum'].'</td>';
     echo '<td>'.$registration['dname'].'</td>';
     echo '<td>'.$registration['tname'].'</td>';
     echo '<td>'.$registration['ptype'].'</td>';
     echo '<td><a href="http://localhost/apptect/edit.php?edit='.$registration['_id'].'" onclick="test(this)" class="btn btn-warning">Edit</button></td>';
     echo '<td><a href="?delete='.$registration['_id'].'" class="btn btn-danger">Delete</a></td>';
	 echo '</tr>'; 
     endwhile; ?>
     </tbody>
     <tfoot>
     	<tr>
     		<th>Vehicle Name</th>
     		<th>Driver Name</th>
     		<th>Transporter Name</th>
     		<th>Payment Type</th>
     		<th>Edit</th>
     		<th>Delete</th>
     	</tr>
     </tfoot>
     </table>
     <script type="text/javascript">
     	function test(obj){
     		console.log(obj);
     	}

     </script>
</body>