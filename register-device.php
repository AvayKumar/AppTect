
<?php

	if( isset( $_GET ) ) {

		$response = array();
	
			try {

				$connection = new MongoClient();
				$database = $connection->selectDB('apptect');
				$collection = $database->selectCollection('tokenreg');

				$data = array(
					'imei' => $_GET['imei'],
					'token' => $_GET['token'],
					'saved_at' => new MongoDate()
				);

				if( $collection->insert( $data ) ){	
			 		$response['success'] = true;
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

	$res = $collection->find();

	while ($res->hasNext()){
       $reg = $res->getNext(); 
       echo $reg['_id'].' '.$reg['imei'].' '.$reg['token'].'<br/>';
    }