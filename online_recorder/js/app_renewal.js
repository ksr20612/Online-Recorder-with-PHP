//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;
var gumStream;
//stream from getUserMedia()
var rec;
//Recorder.js object
var input;
//MediaStreamAudioSourceNode we'll be recording
//shim for AudioContext when it's not avb.
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext;
//audio context to help us record

var isRecording = false;

//var recordButton = document.getElementById("recordButton");
//var stopButton = document.getElementById("stopButton");
//var pauseButton = document.getElementById("pauseButton");
//
//recordButton.addEventListener("click", startRecording);
//stopButton.addEventListener("click", stopRecording);
//pauseButton.addEventListener("click", pauseRecording);

var table = document.getElementById('board');
var radio_array = [];
// number is temp value.

var str_dom_ID = "99_99";

/*SURVEY CODE */
var survey_code;
var survey_code_input = document.getElementById("input_survey_id");
//createSurveyCode();
//function createSurveyCode() {
//	var length = 6;
//	var result = '';
//	var characters = '0123456789';
//	var charactersLength = characters.length;
//	for (var i = 0; i < length; i++) {
//		result += characters.charAt(Math.floor(Math.random() * charactersLength));
//	}
//	survey_code = result;
//}

function makeid(length) {
	var result = '';
	var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	var charactersLength = characters.length;
	for (var i = 0; i < length; i++) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
	}
	return result;
}

/* WORKER_ID & HIT ID */
var worker_ID;
var hit_ID;

var str_worker_id = "Worker ID: ";
var str_hit_id = "Hit ID: ";
function spaceCheck(str) {
    if(str.search(/\s/) != -1) {
    	 return false; 
    	 }
    else { 
    	return true; 
    	}
} 
function getWorkerId(event) {
	
	var worker_id = document.getElementById("input_worker_id").value;
	var hit_id = document.getElementById("input_hit_id").value;
	var space_check = spaceCheck(worker_id) && spaceCheck(hit_id);
	console.log("worker"+worker_id + "hit id"+ hit_id);
	if(!space_check || !worker_id || !hit_id){
		alert("Fill the blank or remove space, please.");
		document.getElementById("input_worker_id").value = "";
		document.getElementById("input_hit_id").value = "";

		console.log(document.getElementById("input_worker_id").value + " + " + document.getElementById("input_hit_id").value);
		return;
	}

	hit_ID = hit_id;
	worker_ID = worker_id;
	alert(" saved " + str_worker_id + worker_ID + str_hit_id + hit_ID);
	document.getElementById("input_worker_id").value = worker_ID;
	document.getElementById("input_hit_id").value = hit_ID;

	return;

}

/* Total number of intent. you can change this.*/
var total_intent = 0;

var upload_file_count = 0;

var number = 1;
var rows = total_intent;
var cols = 5;

var currentRadioValue = 0;

function set_uploadfilecount() {
	
  var upload_txt = upload_file_count;
	document.getElementById("upload_record").innerHTML = upload_txt;

	if (Number(upload_file_count) == Number(radio_index)) {
		enable_mTurkCode();
		alert("Upload all file is finished");
	}
}

function enable_mTurkCode() {
	document.getElementById("input_survey_id").value = workerId;
}

function addRadioButton(index, radio) {
	radio_array.push(radio);
}

var control_array = [];
function Controls(index, recordBtn, stopBtn) {
	this.index = index;
	this.recordBtn = recordBtn;
	this.stopBtn = stopBtn;

	this.getIndex = function() {
		return this.index;
	};
	this.getRecordBtn = function() {
		return this.recordBtn;
	};
	this.getStopBtn = function() {
		return this.stopBtn;
	};
	//this.recordBtn.addEventListener("click", startRecording);
	//this.stopBtn.addEventListener("click", stopRecording);

}

Controls.prototype.getIndex = function() {
};
Controls.prototype.getRecordBtn = function() {
};
Controls.prototype.getDeleteBtn = function() {
};

function addControlButton(index, recordBtn, stopBtn) {
	var obj = new Controls(index, recordBtn, stopBtn);
	control_array.push(obj);
	console.log("index == " + index + ", id record==" + recordBtn.id + ", id stop == " + stopBtn.id);

}

function radioCheck(event) {
	if (isRecording) {
		alert("while recording, you cannot choose another select button");
		event.preventDefault();
		return;
	} else {
		currentRadioValue = Number(event.value);
	}

}

/* This is a recording time. Recording time is finished in this */

var recording_time = 30;

function inputCell(index, input) {
	console.log("inputCell called with index::" + input);
	var table = document.getElementById("recordtable");
	var tbody = table.children[2];
	tbody.rows[index].cells[3].appendChild(input);

	//console.log("index=" + (index + 1));
	//radio_array[index + 1].checked = true;
	//currentRadioValue = index + 1;
	//console.log("currentRadioValue=" + currentRadioValue);
}

//var token = setInterval(timer, 1000);
var token;
// Set the timer function to run every 1000ms until we tell it to stop.
var time_count = document.getElementById("time_text");
var count = 30;
//recording limit time.
var isTimeOverStop = false;
function timer() {
	if (count <= 0) {
		stopCount();
		// Stop counting down.
	} else {
		count -= 1;
		// Count down.
		time_count.innerHTML = count + "s";
	}
}

function startCount() {
	// isTimeOverStop = false;
	count = recording_time;
	//30seconds.
	token = setInterval(timer, 1000);
}

function stopCount() {
	clearCount();
	// isTimeOverStop = true;
	stopButton.click();
	// stop recording.

}

function clearCount() {
	clearInterval(token);
	time_count.innerHTML = 30 + "s";
}

function startRecording(value) {
  
  // 11.11 : disable select button, ethan
  currentRadioValue = value;

	console.log("recordButton clicked");

	if (hasGetUserMedia()) {
		// Good to go!
	} else {
		alert('getUserMedia() is not supported in your browser');
		return;
	}

	/*
	 Simple constraints object, for more advanced audio features see
	 https://addpipe.com/blog/audio-constraints-getusermedia/
	 */

	var constraints = {
		audio : true,
		video : false
	};

	/*
	Disable the record button until we get a success or fail from getUserMedia()
	*/

	// recordButton.disabled = true;
	// stopButton.disabled = false;
	//pauseButton.disabled = false;
	var record = control_array[currentRadioValue].getRecordBtn();
	var stop = control_array[currentRadioValue].getStopBtn();
	record.disabled = true;
	stop.disabled = false;

	/*
	 We're using the standard promise based getUserMedia()
	 https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	 */

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
		 create an audio context after getUserMedia is called
		 sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
		 the sampleRate defaults to the one set in your OS for your playback device

		 */
      
		audioContext = new AudioContext({
			sampleRate : 16000
		});
		console.log("audioContext created...");
   
		//update the format
    //var format = document.getElementById("formats");
    //alert(format);
		//document.getElementById("formats").innerHTML = "Format: 1 channel pcm @ " + audioContext.sampleRate / 1000 + "kHz";
		console.log("format updated");
   
		/*  assign to gumStream for later use  */
		gumStream = stream;
    console.log("assign completed...");
    
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);
    console.log("stream used...");
    
		/*
		 Create the Recorder object and configure to record mono sound (1 channel)
		 Recording 2 channels  will double the file size
		 */
		rec = new Recorder(input, {
			numChannels : 1
		});
    console.log("recorder created...");
    
		//start the recording process
		rec.record();
		isRecording = true;
		startCount();
		console.log("Recording started...");

	}).catch(function(err) {
		//enable the record button if getUserMedia() fails
		recordButton.disabled = false;
		stopButton.disabled = true;
		//pauseButton.disabled = true;
	});
}

/*function pauseRecording() {
 console.log("pauseButton clicked rec.recording=", rec.recording);

 if (rec.recording) {
 //pause
 rec.stop();
 pauseButton.innerHTML = "Resume";
 } else {
 //resume
 rec.record();
 pauseButton.innerHTML = "Pause";

 }
 }*/

function stopRecording(value) {

  // 11.11 : disable select button, ethan
  currentRadioValue = value;
  
	console.log("stopButton clicked");

	//disable the stop button, enable the record too allow for new recordings
	// stopButton.disabled = true;
	// recordButton.disabled = false;
	// pauseButton.disabled = true;

	//reset button just in case the recording is stopped while paused
	//pauseButton.innerHTML = "Pause";

	//tell the recorder to stop the recording
	rec.stop();
	isRecording = false;
	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);

	clearCount();

	var record = control_array[currentRadioValue].getRecordBtn();
	var stop = control_array[currentRadioValue].getStopBtn();
	record.disabled = false;
	stop.disabled = true;

}

function uploadfunction() {
	console.log("uploadfunction");
}

function createDownloadLink(blob) {

	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	var link = document.createElement('a');

	//name of .wav file to use during upload and download (without extendion)

	var table = document.getElementById("recordtable");
	var tbody = table.children[2];

	var filename="";
  
  //11.11 : add survey code to identify easily, ethan
  filename += workerId;
	filename += "_";
	filename += num[currentRadioValue];
	filename += "_"; 
	filename += str_dom_ID;
	filename += "_";
  filename += workerName;
	filename += "_";
  filename += workerSex;
	filename += "_";
  filename += workerAge;
	filename += "_";
  filename += workerHome;
 
  console.log("final name : " + filename);
	// text number
	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//save to disk link
	link.href = url;
	link.download = filename + ".wav";
	//download forces the browser to donwload the file using the  filename
	link.innerHTML = "Save to disk";
	//add the new audio element to li
	li.appendChild(au);
	li.appendChild(document.createElement('br'));
	//add the filename to the li
	li.appendChild(document.createTextNode(filename + ".wav "));

	//add the save to disk link to li
	//li.appendChild(link);

	//upload link

	var upload = document.createElement('a');
	upload.href = "#";
	upload.innerHTML = "Upload";
  upload.id = currentRadioValue;
	upload.addEventListener("click", function(event) {
    currentRadioValue = parseInt(upload.id); 
		console.log("filename" + filename);
		//alert("upload"+ filename);

		var xhr = new XMLHttpRequest();
		xhr.onload = function(e) {
			if (this.readyState === 4) {
				console.log("Server returned: ", e.target.responseText);
				alert(e.target.responseText);
			}
		};
		var fd = new FormData();
		fd.append("upfile", blob, filename);
		var rows = this.parentNode.parentNode.parentNode;
		fd.append("num", num[currentRadioValue]);
    fd.append("idx", idx[currentRadioValue]);
		fd.append("survey_code", survey_code);

		xhr.open("POST", "up/upload_process.php", true);
		xhr.setRequestHeader("enctype", "multipart/form-data");
		xhr.send(fd);
    
    if( upload.innerHTML == "Upload"){
  	  upload_file_count++;
  	  set_uploadfilecount();
    }
		upload.innerHTML = "Upload finished";

	});
	li.appendChild(document.createTextNode(" "));
	//add a space in between
	li.appendChild(upload);
	//add the upload link to li

	var deleteData = document.createElement('a');
	deleteData.href = "#";
	deleteData.innerHTML = "Delete";
	deleteData.addEventListener("click", function(event) {
   currentRadioValue = parseInt(upload.id);
   if(upload.innerHTML == "Upload"){
     alert('please push UPLOAD first and then push DELETE');
   }else{
		var xhr = new XMLHttpRequest();
		xhr.onload = function(e) {
			if (this.readyState === 4) {
				console.log("Server returned: ", e.target.responseText);
			}
		};
		var fd = new FormData();
		fd.append("file", filename);
    fd.append("comm_idx", idx[currentRadioValue]);
		xhr.open("POST", "up/delete.php", true);
		xhr.setRequestHeader("enctype", "multipart/form-data");
		xhr.send(fd);
		var table = document.getElementById("recordtable");
		var tbody = table.children[2];
    
		tbody.rows[currentRadioValue].cells[3].innerHTML = " ";
		// text number

		var cell = this.parentNode;
		while (cell.hasChildNodes()) {
			cell.removeChild(cell.firstChild);
		}
		if (upload.innerHTML == "Upload finished")
			upload_file_count--;
		set_uploadfilecount();
    }
	});

	//li.appendChild(document.createTextNode(" "));
	//add a space in between
	li.appendChild(deleteData);

	//var li_copy = li.cloneNode(true);
  //console.log(li);
  //console.log(currentRadioValue);
	inputCell(currentRadioValue, li);
}

function hasGetUserMedia() {
	return !!(navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
}
