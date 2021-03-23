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

		if (isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") {
			$file = $_FILES['upfile'];
			$upload_directory = 'data/';
			$ext_str = "hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
			$allowed_extensions = explode(',', $ext_str);

			$max_file_size = 5242880;
			$ext = substr($file['name'], strrpos($file['name'], '.') + 1);

			// check extensions
			//if (!in_array($ext, $allowed_extensions)) {
		//		echo "the filename extension is not allowed";
		//	}

			// check file size
			if ($file['size'] >= $max_file_size) {
				echo "file size must be smaller than 5MB. please record it again";
			}

			//$path = md5(microtime()) . '.' . $ext;
			$path = $file['name'].'.wav';
			if (move_uploaded_file($file['tmp_name'], $upload_directory . $path)) {
				$query = "INSERT INTO upload_file(file_id, survey_code, num, name_orig, name_save, reg_time) VALUES(?,?,?,?,?,getdate())";
				$file_id = md5(uniqid(rand(), true));
				$survey_code = $_POST['survey_code'];
				$num = $_POST['num'];
        $idx = $_POST['idx'];
				//$name_orig = $file['name'];
				$name_orig = $path;
				$name_save = $path;
        $params = array($file_id, $survey_code, $num, $name_orig, $name_save);

        $stmt = sqlsrv_query($db_conn, $query, $params);
				if($stmt === false) { 
          echo "fail INSERT"; 
          die( print_r( sqlsrv_errors(), true));
        }
        
				sqlsrv_free_stmt($stmt);    
        
        $param = array($idx);
        $query = "UPDATE command8 set is_recorded = 1 where comm_idx = ?";
        $stmt = sqlsrv_query($db_conn, $query, $param);
				if($stmt === false) { 
          echo "fail UPDATE"; 
          die( print_r( sqlsrv_errors(), true));
        }        
        
				sqlsrv_free_stmt($stmt); 
                
				echo "upload finished";

			}
		} else {
			echo "Please record it again";
		}

		sqlsrv_close($db_conn);
		?>
