<?php
$mycontents = $_POST['downloadGiftContents'];
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"mycloze.txt\"");
echo $mycontents;
?>
	