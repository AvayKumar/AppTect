<?php
		$connection = new MongoClient();
		$database = $connection->selectDB('apptect');
		$collection = $database->selectCollection('tokenreg');
		
		 if( isset( $_GET['imei'], $_GET['token'] ) ) {

			$response = array();
			$response['success'] = true;

			try {

				
				

				$row = $collection->findOne( array('imei' => $_GET['imei']) );

				if( empty( $row['token'] ) ) {
					// Create new entry
					$collection->createIndex(array('imei' => 1), array('unique' => true));
					$data = array(
						'imei' => $_GET['imei'],
						'token' => $_GET['token'],
						'saved_at' => new MongoDate()
					);
					$collection->insert( $data );
				} else {

					if( $row['token'] != $_GET['token'] ){
						//Update entry
						$values = array(
							'imei' => $_GET['imei'],
							'token' => $_GET['token'],
							'saved_at' => new MongoDate()
						);
						$collection->update( array('imei' => $row['imei']), $values);
					}

				}

			} catch(MongoConnectionException $e) {
				echo "Failed to connect to database ".$e->getMessage().'<br/>';
				$response['success'] = false;
			} catch(MongoException $e) {
				echo 'Failed to insert data '.$e->getMessage().'<br/>';
				$response['success'] = false;
			}

			echo json_encode( $response );
		}

	$res = $collection->find();

	while ($res->hasNext()){
       $reg = $res->getNext();
       echo '</br>'.$reg['_id'].' '.$reg['imei'].' '.$reg['token'].'<br/>';
    }

?>		
