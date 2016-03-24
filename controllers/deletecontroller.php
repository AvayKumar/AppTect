<?php

				/*For Deleting Registration*/

	      if( isset($_POST) ){
				
				$response = null;

		try {
			$connection = new MongoClient();
			$database = $connection->selectDB('apptect');
			$collection = $database->selectCollection('registrations');


			$deletion = $collection->remove(array('_id' => new MongoId($_POST['id'])));

            if ( $deletion ) {
            	$response = true;
            } else {
            	$response = false;
            }

		} catch(MongoConnectionException $e) {
			die("Failed to connect to database ".$e->getMessage());
		} catch(MongoException $e) {
			die('Failed to delete data '.$e->getMessage());
		}
		

		
	}