<?php
	
	if( isset($_POST['id']) ) {
	
		$response = array();
		$TimeZoneNameFrom="UTC";
		$TimeZoneNameTo="Asia/Kolkata";
		

		$ctime = new MongoDate();
		$cctime = (array) $ctime;
		$epoch = $cctime['sec'];
		$dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
		$fdt = $dt->setTimezone(new DateTimeZone($TimeZoneNameTo))->format(' h:i A, d-M-Y '); // output = 2012-08-15 00:00:00


		try {
			$connection = new MongoClient();
			$database = $connection->selectDB('apptect');
			$collection = $database->selectCollection($_POST['id']);
			

			$message = array(
				'msname' => $_POST['msname'],
				'message' => $_POST['message'],
				'saved_at' => new MongoDate(),
				'time' => $fdt
			);



            $collection->insert($message);
            	
        	$data = $collection->findOne(array('saved_at' => new MongoDate() ), array('_id', 'message' , 'msname' , 'time'));
		
	 		$response['success'] = true;
	 		$response['id'] = $data['_id'];
	 		$response['msname'] = $data['msname'];
	 		$response['message'] = $data['message'];
	 		$response['time'] = $data['time'];

		} catch(MongoConnectionException $e) {
			$response['success'] = false;
			die("Failed to connect to database ".$e->getMessage());
		} catch(MongoException $e) {
			$response['success'] = false;
			die('Failed to insert data '.$e->getMessage());
		}
		
		echo json_encode( $response );

		
	}
					

?>