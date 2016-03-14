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
			 		$response['regnum'] = $data['regnum'];
			 		$response['dname'] = $data['dname'];
			 		$response['tname'] = $data['tname'];
			 		$response['ptype'] = $data['ptype'];
			 		$response['prate'] = $data['prate'];
			 		$response['imei'] = $data['imei'];
			 		$response['phone'] = $data['phone'];

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