<?php 

		if( !empty($_POST['id']) ) {

			$response = array();
	
			try {
				$connection = new MongoClient();
				$database = $connection->selectDB('apptect');
				$collection = $database->selectCollection('registrations');

				$data = $collection->findOne(array('_id' => new MongoId($_POST['id'])));

				if( $data ){	
			 		$response['success'] = true;
			 		$response['regnum'] = $data['dregnum'];
			 		$response['dname'] = $data['ddname'];
			 		$response['tname'] = $data['dtname'];
			 		$response['ptype'] = $data['dptype'];

			 	} else {
			 		$response['success'] = false;
			 	}

			} catch(MongoConnectionException $e) {
				die("Failed to connect to database ".$e->getMessage());
			} catch(MongoException $e) {
				die('Failed to insert data '.$e->getMessage());
			}
			
			echo json_encode( $response );

		
	}
?>