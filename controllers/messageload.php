<?php 
		
		if( isset($_GET['id']) /*, $_GET['skip'], $_GET['limit']*/ ) {

			$response = array();
			$response['success'] = true;
			try {
				$connection = new MongoClient();
				$database = $connection->selectDB('apptect');
				$collection = $database->selectCollection($_GET['id']);

				$cursor = $collection->find()->sort(array('saved_at'=>-1))->skip($_GET['skip'])->limit($_GET['limit']);

				$i = 0;
				while ($cursor->hasNext()):
				    $data = $cursor->getNext();	
			 		$response[$i]['msname'] = $data['msname'];
			 		$response[$i]['message'] = $data['message'];
			 		$response[$i++]['time'] = $data['time'];
			 	endwhile;

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