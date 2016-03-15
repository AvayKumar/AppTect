<?php
	
	if( isset($_POST) ){
	
		$response = array();

		try {
			$connection = new MongoClient();
			$database = $connection->selectDB('apptect');
			$collection = $database->selectCollection('jobs');

			$job = array(
				'regnum' => $_POST['regnum'],
				'jloc' => $_POST['jloc'],
				'ptype' => $_POST['ptype'],
				'prate' => $_POST['prate'],
				'supname' => $_POST['supname'],
				'saved_at' => new MongoDate()
			);



            if ( $collection->insert($job) ) {
            	
            	$cursor = $collection->find(array('regnum' => $_POST['regnum']), array('_id', 'jloc'));
    		
    		 	if( $cursor->hasNext()){
    		 		$data = $cursor->getNext();
    		 		$response['success'] = true;
    		 		$response['id'] = $data['_id'];
    		 		$response['name'] = $data['jloc'];
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