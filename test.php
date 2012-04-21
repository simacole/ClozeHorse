<?php
//takes out curly quotes and apostrophes
function nocurlies ($text) {
$text = str_replace("“",'"',$text);
$text = str_replace("”",'"',$text);
$text = str_replace("’", "'",$text);
return $text;
}

//database connection details
include('/Library/WebServer/dbconnect.inc');

include('textstatistics.inc');

//collect form text
$myText = $_POST['text'];
$myText = nocurlies($myText);

//flesch-kincaid
$statistics = new TextStatistics;
$kincaid = $statistics->flesch_kincaid_reading_ease($myText);

$textarray = preg_split(
		'/([\s,\!\?\;\:.\"\(\)\n\r]|(?<!\b[Ss]he|\b[Hh]e|\b[Tt]hat|\b[Ii]t)\'(?=s)|\'(?=\s)|\'(?=[.,\!\?\;\:])|(?<=\s)\')/',
		$myText,
		-1,
		PREG_SPLIT_DELIM_CAPTURE);
//Connect to the database
mysql_connect($hostname, $username, $password) or die("Could not connect to database.");
mysql_select_db($mydb) or die("Could not select database.");

//iterate the array processing words and other characters differently
$i = 0;
$printout = "";
foreach ($textarray as $item) {
$item = stripslashes($item);
	if (preg_match('/\w+/', $item) == 1 && preg_match('/\d+/', $item) == 0) {
		//sanitize to avoid SQL insertion attacks and make the query
		$query = sprintf("select base from gsl1 where token='%s'", mysql_real_escape_string($item));
		$result = mysql_query($query);
		if (mysql_num_rows($result)) {
			$item = "<wordgsl1>" . $item . "</wordgsl1>";
		} else {
			$query = sprintf("select base from awl where token='%s'", mysql_real_escape_string($item));
			$result = mysql_query($query);
			if (mysql_num_rows($result)) {
				$item = "<wordawl>" . $item . "</wordawl>";
			} else {
				$query = sprintf("select base from gsl2 where token='%s'", mysql_real_escape_string($item));
				$result = mysql_query($query);
				if (mysql_num_rows($result)) {
					$item = "<wordgsl2>" . $item . "</wordgsl2>";
				} else {
					$item = "<wordlow>" . $item . "</wordlow>";
				}
				
			}
		}
	}
	elseif (preg_match('/\n/', $item) == 1){
		$item = "</paragraph><paragraph>";
	}
	else {
		$item = "<other>" . $item . "</other>";
	}
	
	$printout = $printout . $item;
}
$printout = "<text><kincaid>" . $kincaid . "</kincaid><paragraph>" . $printout . "</paragraph></text>"; 
$printout = str_replace("<other></other>",'',$printout);
$printout = str_replace("</paragraph><paragraph></paragraph>",'</paragraph>',$printout);
$printout = str_replace("&", "&#x26;", $printout);
$printout = str_replace("<other> </other>",'<other>&#x20;</other>',$printout);
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";?><?php echo $printout;?>
