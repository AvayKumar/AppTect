<?php
               try {
               $connection = new MongoClient();
               $database = $connection->selectDB('apptect');
               $collection = $database->selectCollection('jobs');
               } catch(MongoConnectionException $e) {
               die("Failed to connect to database ".$e->getMessage());
               }
               $cursor = $collection->find();
               ?>


<?php
	// Deleting job from database
	if( isset( $_GET['delete'] ) ) {
		// TODO Delete form database
		$collection->remove(array('_id' => new MongoId($_GET['delete'])));
	}

?>

<html>
<head>
   <title>Jobs</title>
   <link href = "css/bootstrap.min.css" rel = "stylesheet">

   </head>
   <body>
     <h1> Jobs </h1>
     <table class="table">
     <thead>
     	<tr>
     		<th>Vehicle Name</th>
               <th>Job Name</th>
     		<th>Source</th>
               <th>Destination</th>
               <th>Supervisor Name</th>
     		<th>Edit</th>
     		<th>Delete</th>
     	</tr>
     </thead>
     <tbody>
     <?php while ($cursor->hasNext()):
     $job = $cursor->getNext();
     echo '<tr>';
     echo '<td>'.$job['regnum'].'</td>';
     echo '<td>'.$job['jname'].'</td>';
     echo '<td>'.$job['source'].'</td>';
     echo '<td>'.$job['dest'].'</td>';
     echo '<td>'.$job['supname'].'</td>';
     echo '<td><a href="http://localhost/apptect/edit.php?edit='.$job['_id'].'" onclick="test(this)" class="btn btn-warning">Edit</button></td>';
     echo '<td><a href="?delete='.$job['_id'].'" class="btn btn-danger">Delete</a></td>';
	 echo '</tr>'; 
     endwhile; ?>
     </tbody>
     <tfoot>
     	<tr>
     		<th>Vehicle Name</th>
               <th>Job Name</th>
               <th>Source</th>
               <th>Destination</th>
               <th>Supervisor Name</th>
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