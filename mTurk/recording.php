<!doctype html>
<html class="no-js" lang="">

	<head>
		<meta charset="utf-8">
		<title> MZ Record </title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta property="og:title" content="">
		<meta property="og:type" content="">
		<meta property="og:url" content="">
		<meta property="og:image" content="">

		<link rel="manifest" href="site.webmanifest">
		<link rel="apple-touch-icon" href="icon.png">
		<!-- Place favicon.ico in the root directory -->

		<link rel="stylesheet" href="css/style_renewal_2.css">		
		<meta name="theme-color" content="#fafafa">
	</head>

	<body>

		<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
		<script>
			window.ga = function() {
				ga.q.push(arguments)
			};
			ga.q = [];
			ga.l = +new Date;
			ga('create', 'UA-XXXXX-Y', 'auto');
			ga('set', 'anonymizeIp', true);
			ga('set', 'transport', 'beacon');
			ga('send', 'pageview')
		</script>
		<script src="https://www.google-analytics.com/analytics.js" async></script>
		<div>
			<h1 class="font_arial">MZ Record</h1>
			<hr/>
		</div>
		<div id="boat">
      <p>
        time remaining 
      </p>
		  <p id="time_text">
				30s
			</p>
			<p>
				files uploaded
			</p>
			<p id="upload_record">
				0
			</p>
		</div>   
		<div>
			<h3 id="title1"> This is MZ record site. </h3>
		</div>
		<div id="count_controls">
			<p id="direction2">
				1. Push the record button and start recording. Each recording must be finished in 30 seconds. <br> After recording, click the upload button to save files.
			</p>
      <p style="color:red">
        Please wait 1~2 seconds after clicking each "record" button and start recording your voice. 
      </p>      
		</div>
		<script src="js/app_renewal.js?10"></script>

		<div id="table_div">
			<table id="recordtable" border="1">
				<thead>
					<tr>
						<th> index </th>
						<th> sentence </th>
						<th> button </th>
						<th> record </th>
					</tr>
				</thead>
				<tfoot>
					<td colspan="6" align="center"></td>
				</tfoot>

				<tbody>
					<?php
				  echo "
					<script>
							var num = new Array();
              var idx = new Array();
              var workerId = window.location.href.substring(window.location.href.indexOf('id')+3);
					</script>";     
               
          $connectionOptions = array(
            "database" => "gnapse",
            "uid" => "SA",
            "pwd" => "Mediazen2020"
          );     
					$db_conn = sqlsrv_connect("localhost", $connectionOptions);
          if($db_conn == false) die(FormatErrors(sqlsrv_errors()));
          
          $workerId = $_GET["id"];
          $param = array($workerId);
          
					$query = "SELECT * FROM command8 where worker_id = ? and is_recorded = 0";
					$stmt = sqlsrv_query($db_conn, $query, $param);
          if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));                 
					}
          $radio_index = 0;
					while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
					?>
					<tr>
						<td class="list"> <?php echo $radio_index+1; ?></td>					
            <script>
              num.push(<?php echo $row['comm_num'] ?>);
              idx.push(<?php echo $row['comm_idx'] ?>);
            </script>
						<td><?= $row['comm_sent'] ?></a></td>
						<td class="list">
						<div id="<?php echo "controls".$radio_index  ?>">
							<button id="<?php echo "recordBtn".$radio_index  ?>" value="<?php echo $radio_index; ?>" onclick="startRecording(this.value)">
								Record
							</button>
							<button id="<?php echo "stopBtn".$radio_index  ?>" value="<?php echo $radio_index; ?>" onclick="stopRecording(this.value)" disabled>
								Stop
							</button>
						</div>
						</td>
						<td class="list"></td>
					</tr>
					<?php
					$recordBtn = "recordBtn".$radio_index;
					$stopBtn = "stopBtn".$radio_index;
					echo "
					<script>
							var record = document.getElementById('$recordBtn');
							var stop = document.getElementById('$stopBtn');
							addControlButton($radio_index, record, stop);
					</script>";

					$r_name = "radio".$radio_index;

					echo "
					<script>
							var radio = document.getElementById('$r_name');
							addRadioButton($radio_index, radio);
					</script>";
					$radio_index++;
					}
          sqlsrv_free_stmt($stmt);         
                        
          // 사용자 정보 가져오기              
					$query = "SELECT worker_name, worker_sex, worker_age, worker_home FROM worker where worker_id = ?";
					$stmt = sqlsrv_query($db_conn, $query, $param);
          if(sqlsrv_fetch($stmt) === false) {
            die(print_r(sqlsrv_errors(), true));
          }
    
          $worker_name = sqlsrv_get_field($stmt, 0);
          $worker_sex = sqlsrv_get_field($stmt, 1);
          $worker_age = sqlsrv_get_field($stmt, 2);  
          $worker_home = sqlsrv_get_field($stmt, 3);                   
          
          sqlsrv_free_stmt($stmt);            
          
          sqlsrv_close($db_conn); 
                           
					?>
           <script type="text/javascript">
             var workerName = "<?php echo $worker_name; ?>";
             var workerSex = "<?php echo $worker_sex; ?>";
             var workerAge = "<?php echo $worker_age; ?>";
             var workerHome = "<?php echo $worker_home; ?>";
             var radio_index = "<?php echo $radio_index; ?>";
           </script>
				</tbody>
			</table>
		</div>
		<div id= "survey_div">
			<p id="direction3">
				2. If you finished the recording, copy the code below and paste it into MTurk Survey Link.
			</p>
			<br/>
			<input id="input_survey_id" type="text" />
		</div>
		<script src="js/record.js"></script>

	</body>
</html>
