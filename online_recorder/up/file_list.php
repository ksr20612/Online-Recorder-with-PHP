<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>?�로???�일 목록</title>
</head>
<body>
<h3>?�로???�일 목록</h3>
<table border="1">
<tr>
	<th>?�일 ?�이??/th>
	<th>?�?�된 ?�일�?/th>
</tr>
<?php
$db_conn = mysqli_connect("localhost", "root", "root1234", "gnapse");
$query = "SELECT file_id, name_orig, name_save FROM upload_file ORDER BY reg_time DESC";
$stmt = mysqli_prepare($db_conn, $query);
$exec = mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($result)) {
?>
<tr>
  <td><?= $row['file_id'] ?></td>
  <td><a href="download.php?file_id=<?= $row['file_id'] ?>" target="_blank"><?= $row['name_orig'] ?></a></td>
</tr>
<?php
} 

mysqli_free_result($result); 
mysqli_stmt_close($stmt);
mysqli_close($db_conn);
?>
</table>
</body>
</html>
