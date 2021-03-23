<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/style.css">
<meta name="theme-color" content="#fafafa">
<title>File List</title>
</head>
<body>
<h3>File List</h3>
<table border="1">
<tr>
	<th>survey_code</th>
	<th>number</th>
	<th>file name</th>
</tr>
<?php
          $connectionOptions = array(
            "database" => "gnapse",
            "uid" => "SA",
            "pwd" => "Mediazen2020"
          );     
					$db_conn = sqlsrv_connect("localhost", $connectionOptions);
          if($db_conn == false) die(FormatErrors(sqlsrv_errors()));
$query = "SELECT file_id, survey_code, num, name_orig, name_save FROM upload_file ORDER BY reg_time DESC";
					$stmt = sqlsrv_query($db_conn, $query);
          if ($stmt == FALSE) die(FormatErrors(sqlsrv_errors()));
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
?>
<tr>
  <td><?= $row['survey_code'] ?></td>
  <td><?= $row['num'] ?></td>
  <td><a href="up/download.php?file_id=<?= $row['file_id'] ?>" target="_blank"><?= $row['name_orig'] ?></a></td>
</tr>
<?php
} 

					sqlsrv_free_stmt($stmt);
					sqlsrv_close($db_conn);  
?>
</table>
</body>
</html>
