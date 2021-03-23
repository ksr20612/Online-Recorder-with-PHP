		<?php
          $connectionOptions = array(
            "database" => "gnapse",
            "uid" => "SA",
            "pwd" => "Mediazen2020"
          );     
					$db_conn = sqlsrv_connect("localhost", $connectionOptions);
          if($db_conn == false) {
            echo "could not connect. \n";
            die( print_r( sqlsrv_errors(), true));
          }
          
		//echo $_POST['file'];
		$file = $_POST['file'].'.wav';
    $comm_idx = $_POST['comm_idx'];


    $query = "SELECT * from upload_file WHERE name_save = ?";
    $param = array($file);
		$stmt = sqlsrv_query($db_conn, $query, $param);
   if($stmt == false){
     die( print_r( sqlsrv_errors(), true));
   }

		$result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
   
		if($result == true){

				sqlsrv_free_stmt($stmt);
				
				$query = "DELETE FROM upload_file WHERE name_save = '$file'";
				$stmt = sqlsrv_prepare($db_conn, $query);
        if($stmt == false){
           die( print_r( sqlsrv_errors(), true));
        }       
				$exec = sqlsrv_execute($stmt);
         if($exec == false){
           die( print_r( sqlsrv_errors(), true));
        }    
        
				sqlsrv_free_stmt($stmt);
        
        $query = "UPDATE command8 SET is_recorded = 0 WHERE comm_idx = ?";
        $param2 = array($comm_idx);
        
        $stmt = sqlsrv_query($db_conn, $query, $param2);
				if($stmt === false) { 
          echo "fail UPDATE recorded"; 
          die( print_r( sqlsrv_errors(), true));
        }        
        
				sqlsrv_free_stmt($stmt);                
        
        unlink("data/".$file);
        
				echo "file deleted";

			
		}else{
			 die( print_r( sqlsrv_errors(), true));
		}
		sqlsrv_close($db_conn);
		?>
