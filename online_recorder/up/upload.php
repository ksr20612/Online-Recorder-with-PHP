<!DOCTYPE html>
<html lang="ko">
	<head>
		<title>File Upload</title>
		<script type="text/javascript">
			function formSubmit(f) {
				var extArray = new Array('hwp', 'xls', 'doc', 'xlsx', 'docx', 'pdf', 'jpg', 'gif', 'png', 'txt', 'ppt', 'pptx');
				var path = document.getElementById("upfile").value;
				if (path == "") {
					alert("Please select the file");
					return false;
				}

				var pos = path.indexOf(".");
				if (pos < 0) {
					alert("File without any extension");
					return false;
				}

				var ext = path.slice(path.indexOf(".") + 1).toLowerCase();
				var checkExt = false;
				for (var i = 0; i < extArray.length; i++) {
					if (ext == extArray[i]) {
						checkExt = true;
						break;
					}
				}

				if (checkExt == false) {
					alert("this type of extension cannot be used");
					return false;
				}

				return true;
			}
		</script>
	</head>
	<body>
		<form name="uploadForm" id="uploadForm" method="post" action="upload_process.php" enctype="multipart/form-data" onsubmit="return formSubmit(this);">
			<div>
				<label for="upfile">file attached</label>
				<input type="file" name="upfile" id="upfile" />
			</div>
			<input type="submit" value="upload" />
		</form>
		<a href="javascript:history.go(-1);">prev</a>
	</body>
</html>