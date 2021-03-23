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
    };

    $query = "select count(*) from command8 where worker_id = ?";
    $worker_id = $_POST['loginId'];
    $param = array($worker_id);
    
    $stmt = sqlsrv_query($db_conn, $query, $param);
    if($stmt === false ){
        echo "login fail";
        die (print_r(sqlsrv_errors(), true));
    };

    //$row = sqlsrv_fetch($stmt, SQLSRV_FETCH_ASSOC);
    
    if(sqlsrv_fetch($stmt) === false) {
      die(print_r(sqlsrv_errors(), true));
    }
    
    $col1 = sqlsrv_get_field($stmt, 0);
    
    if($col1 != "0"){
        echo "1";
    }else{
        echo "0";
    };

    sqlsrv_free_stmt($stmt);    
    sqlsrv_close($db_conn);  
?>