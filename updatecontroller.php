<?php

if( isset($_POST) ) {

			$response = array();
			$response['success'] = true;
			try {
				$connection = new MongoClient();
				$database = $connection->selectDB('apptect');
				$collection = $database->selectCollection('registrations');
				$newob = array(
					'regnum' => $_POST['regnum'],
					'dname' => $_POST['dname'],
					'tname' => $_POST['tname'],
					'ptype' => $_POST['ptype'],
					'prate' => $_POST['prate'],
					'imei' => $_POST['imei'],
					'phone' => $_POST['phone'],
					'saved_at' => new MongoDate()
				);

				$collection->update(array('_id' => new MongoId($_POST['id'])), $newob);
				$response['name'] = $_POST['dname'];
			} catch(MongoConnectionException $e) {
				$response['success'] = false;
				die("Failed to connect to database ".$e->getMessage());
			} catch(MongoException $e) {
				$response['success'] = false;
				die('Failed to update data '.$e->getMessage());
			}
			
			echo json_encode( $response );

		
	}
?>