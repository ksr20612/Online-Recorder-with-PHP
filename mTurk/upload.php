<?php
	print_r($_FILES); //this will print out the received name, temp name, type, size, etc.
	$upload_directory = 'data/';
	
	$size = $_FILES['audio_data']['size']; //the size in bytes
	$input = $_FILES['audio_data']['tmp_name']; //temporary name that PHP gave to the uploaded file
	$output = $_FILES['audio_data']['name'].".wav"; //letting the client control the filename is a rather bad idea
	
	
	echo $size;
	echo " ----- ";
	echo $input;
	echo " ----- ";
	echo $output;
	echo " ----- ";
	echo $upload_directory.$output;
	echo " ----- ";
	echo "\ndone\n";
	
	//move the file from temp name to local folder using $output name
	$r = move_uploaded_file($input, $upload_directory.$output);
	echo "r=";
	echo $r;
?>
