<?php
$file_id = $_REQUEST['file_id'];

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
$query = "SELECT file_id, name_orig, name_save FROM upload_file WHERE file_id = ?";
$stmt = sqlsrv_prepare($db_conn, $query, $file_id);
$exec = sqlsrv_execute($stmt);

$row = sqlsrv_fetch_array($stmt);

$name_orig = $row['name_orig'];
$name_save = $row['name_save'];

$fileDir = "data/";
$fullPath = $fileDir."/".$name_save;
$length = filesize($fullPath);

header("Content-Type: application/octet-stream");
header("Content-Length: $length");
header("Content-Disposition: attachment; filename=".iconv('utf-8','euc-kr',$name_orig));
header("Content-Transfer-Encoding: binary");

$fh = fopen($fullPath, "r");
fpassthru($fh);

sqlsrv_free_stmt($stmt);
sqlsrv_close($db_conn);

exit;
?>