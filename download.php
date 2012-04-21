<?php
$mycontents = $_POST['downloadContents'];
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"mycloze.html\"");
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	<style>
		#cloze p {
			margin-right: 20px;
			margin-left: 20px;
			line-height: 200%;
		}

		#clozeList p {
			border: 2px solid gray;
			word-spacing: 10px;
			padding: 15px;
			margin: 30px 20px 60px 10px;
		}
		h1 {
			text-align: center;
			font: bold 24pt/60pt "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
		}
		body {
			padding: 30px;
		}	
	</style>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		</head>
		<body>
		<?php echo $mycontents; ?>
		</body>
		</html>