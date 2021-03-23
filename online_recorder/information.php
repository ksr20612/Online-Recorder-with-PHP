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
    <style>
        button {
        	flex-grow: 1;
        	height: 30px;
        	width: 100px;
        	border: none;
        	border-radius: 0.15 rem;
        	background: #ed341d;
        	
        	//margin-right: 2px;
        	box-shadow: inset 0 -0.15 rem 0 rgba(0, 0, 0, 0.2);
        	cursor: pointer;
        	//display: flex;
        	//justify-content: center;
        	//align-items: center;
          text-align: center;
        	color: #ffffff;
        	font-weight: bold;
        	font-size: 15px;
          //margin-left: auto;
          //margin-right: auto;
        }
        button:hover, button:focus {
        	outline: none;
        	background: #c72d1c;
        }
        button::-moz-focus-inner {
        	border: 0;
        }
    </style>
	</head>

	<body>

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
		<div>
			<h3 id="title1"> This is MZ record site </h3>
		</div>
		<div>
			<p id="direction2">
				1. If you were already given your ID and were doing your work, please login with it and finish your work.
			</p>
      <label for="name"> ID : </label>
      <input type="text" id="loginId" name="loginId" placeholder="Login ID">
      <button id="loginButton" type="button">Login</button>
    </div>
		<script src="js/app_renewal.js?10"></script>

		<div>
			<p id="direction3">
				2. If you are new and were not given any IDs, please fill out the personal information form below.
			</p>
      <label> Name : </label>
      <input type="text" id="name" name="name" placeholder="Donald Trump"> <br>
      
      <label> Gender : </label>
      <input type="radio" name="gender" value="M" checked><label>Male</label>
      <input type="radio" name="gender" value="F"><label>Female</label> <br>
      
      <label> Age : </label>
      <input type="radio" name="age" value="01" checked><label>00 ~ 20</label>
      <input type="radio" name="age" value="02"><label>21 ~ 40</label>
      <input type="radio" name="age" value="03"><label>41 ~ 60</label>
      <input type="radio" name="age" value="03"><label>61 ~</label> <br> <br>
      
      <label> residence : </label> <br>
      <input type="radio" name="home" value="H" checked><label>New England (Connecticut, Maine, Massachusetts, New Hampshire, Rhode Island, and Vermont)</label> <br>
      <input type="radio" name="home" value="I"><label>Mid-Atlantic (New Jersey, New York, and Pennsylvania)</label> <br>
      <input type="radio" name="home" value="J"><label>East North Central (Illinois, Indiana, Michigan, Ohio, and Wisconsin)</label> <br>
      <input type="radio" name="home" value="K"><label>West North Central (Iowa, Kansas, Minnesota, Missouri, Nebraska, North Dakota, and South Dakota)</label> <br>  
      <input type="radio" name="home" value="L"><label>South Atlantic (Connecticut, Maine, Massachusetts, New Hampshire, Rhode Island, and Vermont)</label> <br>
      <input type="radio" name="home" value="M"><label>East South Central (Alabama, Kentucky, Mississippi, and Tennessee)</label> <br>
      <input type="radio" name="home" value="N"><label>West South Central (Arkansas, Louisiana, Oklahoma, and Texas)</label> <br>
      <input type="radio" name="home" value="O"><label>Mountain (Arizona, Colorado, Idaho, Montana, Nevada, New Mexico, Utah, and Wyoming)</label> <br>            
      <input type="radio" name="home" value="P"><label>Pacific (Alaska, California, Hawaii, Oregon, and Washington)</label> <br>   
      <input type="radio" name="home" value="Q"><label>Other</label> <br> <br>           

      <label> dialect : </label> <br>
      <input type="radio" name="dialect" value="H" checked><label>New England (Connecticut, Maine, Massachusetts, New Hampshire, Rhode Island, and Vermont)</label> <br>
      <input type="radio" name="dialect" value="I"><label>Mid-Atlantic (New Jersey, New York, and Pennsylvania)</label> <br>
      <input type="radio" name="dialect" value="J"><label>East North Central (Illinois, Indiana, Michigan, Ohio, and Wisconsin)</label> <br>
      <input type="radio" name="dialect" value="K"><label>West North Central (Iowa, Kansas, Minnesota, Missouri, Nebraska, North Dakota, and South Dakota)</label> <br>  
      <input type="radio" name="dialect" value="L"><label>South Atlantic (Connecticut, Maine, Massachusetts, New Hampshire, Rhode Island, and Vermont)</label> <br>
      <input type="radio" name="dialect" value="M"><label>East South Central (Alabama, Kentucky, Mississippi, and Tennessee)</label> <br>
      <input type="radio" name="dialect" value="N"><label>West South Central (Arkansas, Louisiana, Oklahoma, and Texas)</label> <br>
      <input type="radio" name="dialect" value="O"><label>Mountain (Arizona, Colorado, Idaho, Montana, Nevada, New Mexico, Utah, and Wyoming)</label> <br>            
      <input type="radio" name="dialect" value="P"><label>Pacific (Alaska, California, Hawaii, Oregon, and Washington)</label> <br>   
      <input type="radio" name="dialect" value="Q"><label>Other</label> <br> <br>        

      <label> recording environment : </label> <br>
      <input type="radio" name="location" value="01" checked><label>In a house</label> <br>
      <input type="radio" name="location" value="02"><label>In your workplace</label> <br>
      <input type="radio" name="location" value="03"><label>In a recording studio</label> <br>
      <input type="radio" name="location" value="04"><label>In a vehicle</label> <br>
      <input type="radio" name="location" value="05"><label>Outside</label> <br>    
      <input type="radio" name="location" value="06"><label>Other</label> <br> <br>     

      <label> recording equipment you are using : </label> <br>
      <input type="radio" name="tool" value="01" checked><label>Laptop(computer)</label> <br>
      <input type="radio" name="tool" value="02"><label>Phone</label> <br>
      <input type="radio" name="tool" value="03"><label>Tablet</label> <br>
      <input type="radio" name="tool" value="04"><label>Other</label> <br> <br>
      
      Your ID is... :
      <input type="text" id="IdCreated" placeholder="push the button below!"> <br>
      <h3>Note : We totally recommend you to finish the work at once. <br>
      It will take approximately 5 minutes. <br>
      Please remember this ID if you cannot finish the work now. <br>
      This new id will also be your mTurk code you submit back. please Do NOT submit your mTurk worker ID. </h3> <br>

      <button id="createButton" type="button">Create Id</button>
      <button id="startButton" type="button">Start</button>
		  </div>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>        
        <script src="js/record.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
            
                var isCreated = false;
                var array = new Uint32Array(1);
                window.crypto.getRandomValues(array);
                var workerId = array[0].toString(36);
            
                $('#createButton').click(function(){
                    var name = document.getElementById('name').value;
                    var gender = $('input[name="gender"]:checked').val();
                    var age = $('input[name="age"]:checked').val();
                    var home = $('input[name="home"]:checked').val();
                    var dialect = $('input[name="dialect"]:checked').val();
                    var location = $('input[name="location"]:checked').val();
                    var tool = $('input[name="tool"]:checked').val();
                    
                    if(name == ""){
                        alert('please insert your name!');
                        return true;
                    }
                    
                    document.getElementById("IdCreated").value = workerId;
                    isCreated = true;
                    
                    // 대본 할당
                    var xhr = new XMLHttpRequest;
                    xhr.onload = function(e) {
  			              if (this.readyState === 4) {
  				              console.log("Server returned: ", e.target.responseText);
                      }
  			            }
                    
                    var fd = new FormData();
                    fd.append("workerId", workerId);
                    fd.append("name", name);
                    fd.append("gender", gender);
                    fd.append("age", age);
                    fd.append("home", home);
                    fd.append("dialect", dialect);
                    fd.append("location", location);
                    fd.append("tool", tool);
                    xhr.open("POST","info_save_process.php",true);
                    xhr.setRequestHeader("enctype","multipart/form-data");
                    xhr.send(fd);
                    
                });
                
                $('#loginButton').click(function(){
                    var loginId = document.getElementById('loginId').value;
                    
                    // 할당된 대본 있는지 검사
                    var xhr = new XMLHttpRequest;
                    var isExisted;
                    xhr.onload = function(e) {
			                if (this.readyState === 4) {
				              console.log("Server returned: ", e.target.responseText);
                            isExisted = e.target.responseText;

                            if(isExisted == "1"){
                                window.location.href = "recording.php?id=" + loginId;
                                return true;
                            }else if(isExisted == "0"){
                                alert("check your ID again!");
                                return true;
                            }
			                  }
		                };

                    var fd = new FormData();
                    fd.append("loginId", loginId);
                    xhr.open("POST","login_process.php",true);
                    xhr.setRequestHeader("enctype","multipart/form-data");
                    xhr.send(fd);

                }); 
                
                $('#startButton').click(function(){

                    if(!isCreated){
                      alert('Create your ID first!');
                    }else{
                      window.location.href = "recording.php?id=" + workerId;
                    }
                });               
                
            });

        
        </script>

	</body>
</html>

