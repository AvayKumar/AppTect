<?php

	if( !isset( $_POST['imei'] ) && !isset( $_POST['mno'] ) ) {

		// TODO Query database 
		
		$resposne = array();

		$resposne['result'] = 'ok';
		$resposne['authentiacion'] = 'sdfasf546';

		echo json_encode( $resposne );

	}