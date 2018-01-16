<?php 

	function send_notification ($tokens, $message)
	{
		
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			 'registration_ids' => $tokens,
			 'data' => $message
			);

		$headers = array(
			'Authorization:key=AAAAN0KnC1I:APA91bHfmrh1obrGULBXnv4gB_X3dFSD54VH4TahjAai8m6ozxKYaHsFyfumI',
			'Content-Type: application/json'
			);

	   $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);           
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
	}
	

	$conn = mysqli_connect("10.120.1.222","freegbbn_","","freegbbn_");

	$sql = "Select Token From users";

	$result = mysqli_query($conn,$sql);
	$tokens = array();

	if(mysqli_num_rows($result) > 0 ){

		while ($row = mysqli_fetch_assoc($result)) {
			$tokens[] = $row["Token"];
		}
	}

	mysqli_close($conn);
	

	if (isset($_POST["Objet"])) {
		
		$objet=$_POST["Objet"];
		
		$message = array("message" => $objet);
		
		if(sizeof($tokens) > 1000){
		    
            $newId = array_chunk($tokens, 999);
            
            foreach ($newId as $inner_id) {
                
               	$message_status = send_notification($inner_id, $message);
                echo $message_status;
            }
        
        }else {
            
    		$message_status = send_notification($tokens, $message);
    		
    		echo $message_status;
		
        }
        
        }
        
        if (isset($_GET["Objet"])) {
		
		$objet=$_GET["Objet"];
		
		$message = array("message" => $objet);
		
		if(sizeof($tokens) > 1000){
		    
            $newId = array_chunk($tokens, 999);
            
            foreach ($newId as $inner_id) {
                
               	$message_status = send_notification($inner_id, $message);
                echo $message_status;
            }
        
        }else {
            
    		$message_status = send_notification($tokens, $message);
    		
    		echo $message_status;
		
        }

		
		
		
		
		
		
        }


 ?>
