<?php
//converts new lines to html paragraphs
function nl2p ($text){
	$text='<p> ' . $text . ' </p>';
	$text = str_replace("\n",' </p><p> ',$text);
	$text = str_replace("\r",'',$text);
	$text = str_replace(' <p> </p> ','',$text);
	$text = str_replace(' </p> <p> ', " </p>\n <p> ", $text);
	return $text;
}
//database connection details
include('/Library/WebServer/dbconnect.inc');
$myText = $_POST['text'];

$textarray = preg_split('/([\s,\!\?\;\:.\"\'\(\)])/', $myText, -1, PREG_SPLIT_DELIM_CAPTURE);
$i = 0;
print_r($textarray);
foreach ($textarray as $item) {
	if (preg_match('/\w+/', $item) == 1) {
		$item = "<a href='javascript://' id='word" . $i . "'> " . $item . "</a>";
		
	}
	$printout = $printout . $item;
	$i = $i + 1;
}

//	for (var i = myTextArray.length - 1; i >= 0; i--){
//		if (myTextArray[i].match(/\w+/)) {
//		myTextArray[i] = "<a href='javascript://'  id='word" + i + "'>" + myTextArray[i] + "</a>";
//		}
//	}
//	var test = myTextArray.join("");

$printout = nl2p ($printout);
$count = 0;
while (strpos($printout,'<p>') !== FALSE){
//echo "true";
$printout = preg_replace('/<p>/','<p id="para' . $count . '">',$printout,1);
$count = $count + 1;
}
echo $printout;
?>
