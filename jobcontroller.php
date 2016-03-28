<?php
	

	require_once 'gcm/Gcm.php';

	if( isset($_POST) ){
	
		$response = array();

		try {
			$connection = new MongoClient();
			$database = $connection->selectDB('apptect');
			$collection = $database->selectCollection('jobs');
			$jobstatus = 'pending';
			$job = array(
				'regnum' => $_POST['regnum'],
				'jname' => $_POST['jname'],
				'source' => $_POST['source'],
				'sourcelat' => $_POST['sourcelat'],
				'sourcelng' => $_POST['sourcelng'],
				'dest' => $_POST['dest'],
				'destlat' => $_POST['destlat'],
				'destlng' => $_POST['destlng'],
				'distance' => $_POST['distance'],
				'time' => $_POST['time'],
				'amount' => $_POST['amount'],
				'supname' => $_POST['supname'],
				'jobstatus' => $jobstatus,
				'saved_at' => new MongoDate()
			);



            if ( $collection->insert($job) ) {
            	
            	$cursor = $collection->find(array('regnum' => $_POST['regnum']), array('_id', 'jname','jobstatus'));
    		
    		 	/*if( $cursor->hasNext()){
    		 		$data = $cursor->getNext();
    		 		$response['success'] = true;
    		 		$response['id'] = $data['_id'];
    		 		$response['name'] = $data['jname'];
    		 		$response['jobstatus'] = $data['jobstatus'];
    		 	} else {
    		 		$response['success'] = false;
    		 	}*/
		 		$registrations = $database->selectCollection('registrations');
    		 	$tokenreg = $database->selectCollection('tokenreg');
    		 	$data = $registrations->findOne(array('regnum'=>$job['regnum']), array('imei'));
    		 	$tokenData = $tokenreg->findOne(array('imei'=> $data['imei']));

    		 	Gcm::sendNotifcation('Hello this is AppTech' ,$tokenData['imei']);

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