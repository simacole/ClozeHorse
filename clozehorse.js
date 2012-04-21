var  xmlhttp = null;
var selection = {};
function createObject(){
//function to process an XMLHTTP request
if (window.XMLHttpRequest) {
  // If IE7, Mozilla, Safari, and so on: Use native object.
  xmlhttp = new XMLHttpRequest();
}
else
{
  if (window.ActiveXObject) {
     // ...otherwise, use the ActiveX control for IE5.x and IE6.
     xmlhttp = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }
}
}
function makerequest (serverPage, objID, str){
	createObject();
	xmlhttp.open("POST", serverPage, true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var xmlDoc = xmlhttp.responseXML;
			var paragraphs = xmlDoc.getElementsByTagName("paragraph");
			var kincaid = xmlDoc.getElementsByTagName("kincaid");
			var kincaidtext = kincaid[0].firstChild.nodeValue;
			var insert_kincaid = document.getElementById("kincaid");
			insert_kincaid.innerHTML = "The Flesch Reading Ease score for your text is: " + kincaidtext;
			var i = 0;
			var x = 0;
			for (var i=0; i < paragraphs.length; i++) {
				var para = paragraphs[i];
				var item = document.createElement("p");
				item.id = "para" + i;
				objID.appendChild(item);
				var paraId = item.id;
				thisPara = document.getElementById(paraId);
				var words = para.childNodes;
				
				for (var x=0; x < words.length; x++){
					if (words[x].firstChild !== null){
					var word = words[x].firstChild.nodeValue;
					if (words[x].nodeName == "wordgsl1"){
					var wordLink = document.createElement("a");
					wordLink.href="javascript://";
					wordLink.id="para" + i + "word" + x;
					thisPara.appendChild(wordLink);
					myTextNode = document.createTextNode(word);
					thisPara.lastChild.appendChild(myTextNode);
					thisPara.lastChild.onclick=selectWord;
					thisPara.lastChild.className="gsl1";
					}
					else if (words[x].nodeName == "wordawl") {
						var wordLink = document.createElement("a");
						wordLink.href="javascript://";
						wordLink.id="para" + i + "word" + x;
						thisPara.appendChild(wordLink);
						myTextNode = document.createTextNode(word);
						thisPara.lastChild.appendChild(myTextNode);
						thisPara.lastChild.onclick=selectWord;
						thisPara.lastChild.className="awl";
					}
					else if (words[x].nodeName == "wordgsl2") {
						var wordLink = document.createElement("a");
						wordLink.href="javascript://";
						wordLink.id="para" + i + "word" + x;
						thisPara.appendChild(wordLink);
						myTextNode = document.createTextNode(word);
						thisPara.lastChild.appendChild(myTextNode);
						thisPara.lastChild.onclick=selectWord;
						thisPara.lastChild.className="gsl2";
					}
					else if (words[x].nodeName == "wordlow") {
						var wordLink = document.createElement("a");
						wordLink.href="javascript://";
						wordLink.id="para" + i + "word" + x;
						thisPara.appendChild(wordLink);
						myTextNode = document.createTextNode(word);
						thisPara.lastChild.appendChild(myTextNode);
						thisPara.lastChild.onclick=selectWord;
						thisPara.lastChild.className="low";
					}
					else {
					var myTextNode = document.createTextNode(word);
					thisPara.appendChild(myTextNode);  
					}
				}
				}
			}
		}
	}
	xmlhttp.send(str);
}
function processText (form) {
	var myText = encodeURIComponent(document.getElementById("textin").value);
	var str = "text=" + myText + "&";
	var objID = document.getElementById("editabletext");
	clearText(objID);
	clearText(document.getElementById("clozeList"));
	clearText(document.getElementById("cloze"));
	var serverPage = "test.php";
	makerequest(serverPage, objID, str);
	displayEl("editabletext","editplusminus");
	var legend = document.getElementById("legend").style.display ="block";
}
function clearText (myDiv){
	while (myDiv.hasChildNodes()){
		myDiv.removeChild(myDiv.firstChild);
	}	
}
function myCallback () {
	
}
function selectWord(){
	var thisid = this.id
	if(selection[thisid] != 1) {
	selection[thisid] = 1;	
	this.style.color = "red";
	this.onmouseover = orange;
	this.onmouseout = red;
	}else {
	selection[thisid] = 0;
	this.style.color = "black";
	this.onmouseover = orange;
	this.onmouseout = black;
	}
	makeCloze(); 
}
var test_items = {};
var list_array;
function makeCloze () {
	var myListArray = new Array;
	var clozeText = document.getElementById("editabletext").innerHTML;
	var target = document.getElementById("cloze");
	var testItems = {};
	target.innerHTML = "<p>" + clozeText + "<p>";
	var clozeItems = target.getElementsByTagName("A");
	for (var i=0; i < clozeItems.length; i++) {
			if (clozeItems[i].style.color == "red") {
			clozeItems[i].style.color = "black";
			clozeItems[i].id = "item" + i;
			var item = clozeItems[i].innerHTML;
			var itemid =  clozeItems[i].id;
			testItems[itemid]= item;
			clozeItems[i].innerHTML = "......................";
			myListArray.push(item);
		}
	}
	test_items = testItems;
	myListArray.sort();
	list_array = myListArray;
	var myList = myListArray.join(" ");
	document.getElementById("clozeList").innerHTML = "<p>" + myList + "</p>";
	displayEl("clozes","clozesplusminus");
}
function toggleDisplay (myID,mySRC) {		
	var toToggle = document.getElementById(myID);
	if (toToggle.style.display == "none") {
		toToggle.style.display = "block";
		document.getElementById(mySRC).src = "images/minus.png";
	}else {
		toToggle.style.display = "none";
		document.getElementById(mySRC).src = "images/plus.png";
		
	}
}
function toggle2 (myID2) {
	var toToggle = document.getElementById(myID2);
	if (toToggle.style.display == "none") {
		toToggle.style.display = "block";
		} else {
		toToggle.style.display = "none";	
		}	
}
function displayEl (myID,mySRC) {
	var toDisplay = document.getElementById(myID);
	toDisplay.style.display = "block";
	document.getElementById(mySRC).src = "images/minus.png";
}
function hideEl (myID,mySRC) {
	var toHide = document.getElementById(myID);
	toHide.style.display = "none";
	document.getElementById(mySRC).src = "images/plus.png";
}
function writeTitle () {
	var myTitle = document.getElementById("theTitle").value;
	var forTitle = document.getElementById("clozeTitle");
	forTitle.innerHTML = myTitle;
}
function mySelector () {
	var myFormat = document.getElementById("selectformat").value;
	if (myFormat === "rtf") {
		downloadrtf();
	}else if (myFormat === "hp") {
		downloadAsHP();
	} else {
		downloadAsGift();
	}
	
}
var details = 'Name ..................... Date.............';
function fileDownload (){
	var myTitle = document.getElementById("clozeTitle").innerHTML;
	var myTitle = "<h1>" + myTitle + "</h1>";
	var myDetails = "<p>" + details + "</p>";
	var myClozelist = document.getElementById("clozeList").innerHTML;
	var myClozelist = "<div id='clozeList'>" + myClozelist + "</div>";
	var myCloze = document.getElementById("cloze").innerHTML;
	var myCloze = myCloze.replace(/<[Aa].*?>/g,"");
	var myCloze = myCloze.replace(/<\/[Aa].*?>/g,"");
	var myCloze = "<div id='cloze'>" + myCloze + "</div>";
	var clozeContent = myDetails + myTitle + myClozelist + myCloze;
	document.download.downloadContents.value = clozeContent;
	document.download.submit();
}
function downloadrtf (){
	var myTitle = document.getElementById("clozeTitle").innerHTML;
	var myClozelist = document.getElementById("clozeList").innerHTML;
	myClozelist = myClozelist.replace(/<\/[Pp].*?>/g,"");
	myClozelist = myClozelist.replace(/<[Pp].*?>/g,"");
	myClozelist = myClozelist.replace(/ /g,"   ");
	var myCloze = document.getElementById("cloze").innerHTML;
	var myCloze = myCloze.replace(/<[Aa].*?>/g,"");
	var myCloze = myCloze.replace(/<\/[Aa].*?>/g,"");
	document.downloadRTF.rtftitle.value = myTitle;
	document.downloadRTF.rtfdetails.value = details;
	document.downloadRTF.rtfclozelist.value = myClozelist;
	myCloze = myCloze.replace(/<\/[Pp].*?>/g,"\\par \\line ");
	myCloze = myCloze.replace(/<[Pp].*?>/g,"");
	document.downloadRTF.rtfcloze.value = myCloze;
	document.downloadRTF.submit();
}
function downloadAsGift (){
	var name;
	var giftCode ="";
	for (var i=0; i < list_array.length; i++) {
		giftCode = giftCode + "~" + list_array[i] +" ";
	};
	for (name in test_items) {
		var mycode = giftCode;
		myString = "~" + test_items[name] + " ";
		var myRexp = new RegExp(myString, 'g')
		var replacement = "~=" + test_items[name] + " ";
		mycode = mycode.replace(myRexp, replacement);
		mycode = "{:MULTICHOICE:" + mycode + "}";
		document.getElementById(name).innerHTML = mycode;
	};
	var myGift = document.getElementById("cloze").innerHTML;
	for (name in test_items) {
		document.getElementById(name).innerHTML = "......................";
	}
	myGift = myGift.replace(/<[Aa].*?>/g,"");
	myGift = myGift.replace(/<\/[Aa].*?>/g,"");
	myGift = myGift.replace(/<[Pp]><\/[Pp]>/g,"");
	myGift = myGift.replace(/<\/[Pp].*?>/g,"\r\r");
	myGift = myGift.replace(/<[Pp].*?>/g,"");
	document.downloadGift.downloadGiftContents.value = myGift;
	document.downloadGift.submit();
}
function downloadAsHP (){
	var myTitle = document.getElementById("clozeTitle").innerHTML;
	for (name in test_items) {
		var before = "rlmpzyx<QUESTION-RECORD><QUESTION></QUESTION><ANSWER><TEXT>";
		var after = "</TEXT><FEEDBACK></FEEDBACK><CORRECT>1</CORRECT></ANSWER><CLUE></CLUE></QUESTION-RECORD>";
		var mycode = before + test_items[name] + after;
		document.getElementById(name).innerHTML = mycode;
		var test = document.getElementById(name).innerHTML;	
	};
	var myHP = document.getElementById("cloze").innerHTML;
	
	for (name in test_items) {
		document.getElementById(name).innerHTML = "......................";
	}
	myHP = myHP.replace(/<[Aa][^Nn].*?>/g,"");
	myHP = myHP.replace(/<\/[Aa]>/g,"");
	myHP = myHP.replace(/<[Pp]><\/[Pp]>/g,"");
	myHP = myHP.replace(/<\/[Pp].*?>/g,"\r\r");
	myHP = myHP.replace(/<[Pp].*?>/g,"");
	myHP = myHP.replace(/<[Pp].*?>/g,"");
	myHP = myHP.replace(/rlmpzyx/g,"");
	document.downloadHP.hpcloze.value = myHP;
	document.downloadHP.hptitle.value = myTitle;
	document.downloadHP.submit();
	
}
function orange() {
	this.style.color = "orange";
}
function black(){
	this.style.color = "black";
}
function red()  {
	this.style.color = "red";
}
var win=null;
  function printIt(printThis)
  {
    win = window.open();
    win.self.focus();
    win.document.open();
    win.document.write('<'+'html'+'><'+'head'+'><link rel='+ '\"stylesheet"' +  'href=' + '\"css/clozehorseprint.css\"' + 'type=' + '\"text/css\" media=\"all\" title=\"Cloze\" charset=\"utf-8\">');
    win.document.write('<'+'/'+'head'+'><'+'body'+'>');
	win.document.write('<p id=\"details\">Name ..................... Date.............</p>');
    win.document.write(printThis);
    win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
    win.document.close();
    win.print();
	win.close();
  }