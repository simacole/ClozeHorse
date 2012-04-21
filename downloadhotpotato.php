<?php
$mytitle = $_POST['hptitle'];
$mycloze = $_POST['hpcloze'];
$mypattern = "/<.*?>/";
preg_match_all($mypattern, $mycloze, $matches);
foreach ($matches[0] as $value) {
	$replacement = strtolower($value);
	$mycloze = str_replace($value, $replacement, $mycloze);
}
$mypattern = "/'/";
preg_match_all($mypattern, $mycloze, $matches);
foreach ($matches[0] as $value) {
	$replacement = "&apos;";
	$mycloze = str_replace($value, $replacement, $mycloze);
}
$myfile = preg_replace("/\s+/","_",$mytitle);
$myfile = preg_replace("/\W+/" , "", $myfile);
$info = '<?xml version="1.0" encoding="ISO-8859-1"?>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"" . $myfile . ".jcl\"");
?>
<?php echo $info; ?>
<hotpot-jcloze-file>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
<rdf:Description rdf:about="">
</rdf:Description>
</rdf:RDF>
<version>6</version>
<data>
<title><?php echo $mytitle; ?></title>
<timer>
<include-timer>0</include-timer>
<seconds>59</seconds>
</timer>
<reading>
<reading-text></reading-text>
<include-reading>0</include-reading>
<reading-title></reading-title>
</reading>
<gap-fill><?php echo $mycloze; ?></gap-fill>
</data>
<hotpot-config-file>
<global>
<separate-js-file>0</separate-js-file>
<clue-caption>Clue</clue-caption>
<next-q-caption>=&amp;#x003E;</next-q-caption>
<last-q-caption>&amp;#x003C;=</last-q-caption>
<incorrect-indicator>X</incorrect-indicator>
<font-size>small</font-size>
<include-next-ex>1</include-next-ex>
<restart-caption>Restart</restart-caption>
<contents-url>contents.htm</contents-url>
<include-timer>0</include-timer>
<font-face>Geneva,Arial,sans-serif</font-face>
<include-scorm-12>0</include-scorm-12>
<user-string-3>three</user-string-3>
<show-correct-first-time>0</show-correct-first-time>
<user-string-2>two</user-string-2>
<user-string-1>one</user-string-1>
<vlink-color>#0000CC</vlink-color>
<title-color>#000033</title-color>
<correct-indicator>:-)</correct-indicator>
<contents-caption>Index</contents-caption>
<show-all-questions-caption>Show all questions</show-all-questions-caption>
<undo-caption>Undo</undo-caption>
<header-code></header-code>
<hint-caption>Hint</hint-caption>
<check-button-caption>Check</check-button-caption>
<email>you@yourserver.com</email>
<show-one-by-one-caption>Show questions one by one</show-one-by-one-caption>
<name-please>Please enter your name:</name-please>
<formmail-url>http://yourserver.com/cgi-bin/FormMail.pl</formmail-url>
<next-ex-caption>=&amp;#x003E;</next-ex-caption>
<back-caption>&amp;#x003C;=</back-caption>
<text-color>#000000</text-color>
<page-bg-color>#ffffff</page-bg-color>
<times-up>Your time is over!</times-up>
<nav-bar-color>#000066</nav-bar-color>
<include-contents>1</include-contents>
<your-score-is>Your score is </your-score-is>
<graphic-url></graphic-url>
<link-color>#0000FF</link-color>
<keypad-characters></keypad-characters>
<show-also-correct>1</show-also-correct>
<correct-first-time>Questions answered correctly first time: </correct-first-time>
<include-cgi>0</include-cgi>
<ex-bg-color>#bbbbee</ex-bg-color>
<ok-caption>OK</ok-caption>
<process-for-rtl>0</process-for-rtl>
<check-caption>Check</check-caption>
<include-back>1</include-back>
<next-correct-letter>Next correct letter is: </next-correct-letter>
</global>
<jcloze>
<instructions>Fill the blanks with one of the following words. You may use words more than once.</instructions>
<guesses-correct>Correct!</guesses-correct>
<guesses-incorrect>Some of your answers are incorrect. They have been left in place.</guesses-incorrect>
<header-code></header-code>
<include-hint>0</include-hint>
<include-keypad>0</include-keypad>
<include-word-list>1</include-word-list>
<case-sensitive>0</case-sensitive>
<next-ex-url>nextpage.htm</next-ex-url>
<send-email>0</send-email>
<show-also-correct>1</show-also-correct>
<exercise-subtitle></exercise-subtitle>
<next-correct-letter>Next correct letter is: </next-correct-letter>
<include-clue>0</include-clue>
<include-show-answer>0</include-show-answer>
<minimum-gap-size>6</minimum-gap-size>
<separate-javascript-file>0</separate-javascript-file>
<use-drop-down-list>0</use-drop-down-list>
</jcloze>
</hotpot-config-file>

</hotpot-jcloze-file>
