<?php
	
	if( isset($_POST) ){
	
		$response = array();

		try {
			$connection = new MongoClient();
			$database = $connection->selectDB('apptect');
			$collection = $database->selectCollection('registrations');

			$registration = array(
				'regnum' => $_POST['regnum'],
				'dname' => $_POST['dname'],
				'tname' => $_POST['tname'],
				'ptype' => $_POST['ptype'],
				'prate' => $_POST['prate'],
				'imei' => $_POST['imei'],
				'phone' => $_POST['phone'],
				'saved_at' => new MongoDate()
			);



            if ( $collection->insert($registration) ) {
            	
            	$cursor = $collection->find(array('regnum' => $_POST['regnum']), array('_id', 'dname'));
    		
    		 	if( $cursor->hasNext()){
    		 		$data = $cursor->getNext();
    		 		$response['success'] = true;
    		 		$response['id'] = $data['_id'];
    		 		$response['name'] = $data['dname'];
    		 	} else {
    		 		$response['success'] = false;
    		 	}
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

	