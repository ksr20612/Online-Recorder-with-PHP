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

    // worker???•ë³´ ?…ë ¥
    $query = "insert into worker values(?,?,?,?,?,?,?,?)";
    
    $worker_id = $_POST['workerId'];
    $worker_name = $_POST['name'];
    $worker_sex = $_POST['gender'];
    $worker_age = $_POST['age'];
    $worker_home = $_POST['home'];
    $worker_loc = $_POST['location'];
    $worker_tool = $_POST['tool'];
    $worker_dialect = $_POST['dialect'];
    
    $params = array($worker_id, $worker_name, $worker_sex, $worker_age, $worker_home, $worker_loc, $worker_tool, $worker_dialect);
    
    $stmt = sqlsrv_query($db_conn, $query, $params);
    if($stmt === false){
        echo "fail insert";
        die (print_r(sqlsrv_errors(), true));
    }

    // command ??? ë‹¹
    $query = "update command8 set worker_id = ? where comm_idx in (select top(10) comm_idx from command8 where worker_id is null)";
    $param = array($worker_id);
    $stmt = sqlsrv_query($db_conn, $query, $param);
    if($stmt === false){
        echo "fail insert";
        die (print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);    
    sqlsrv_close($db_conn);    

    echo "insert finished";

?>