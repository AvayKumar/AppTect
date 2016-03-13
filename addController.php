<?php

	if( isset($_POST['regnum'], $_POST['dname'], $_POST['tname'], $_POST['ptype'])  ){
	
		$response = array();

		try {
			$connection = new MongoClient();
			$database = $connection->selectDB('apptect');
			$collection = $database->selectCollection('registrations');

			$registration = array(
				'dregnum' => $_POST['regnum'],
				'ddname' => $_POST['dname'],
				'dtname' => $_POST['tname'],
				'dptype' => $_POST['ptype'],
				'saved_at' => new MongoDate()
			);



            if ( $collection->insert($registration) ) {
            	
            	$cursor = $collection->find(array('dregnum' => $_POST['regnum']), array('_id', 'ddname'));
    		
    		 	if( $cursor->hasNext()){
    		 		$data = $cursor->getNext();
    		 		$response['success'] = true;
    		 		$response['id'] = $data['_id'];
    		 		$response['name'] = $data['ddname'];
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

	