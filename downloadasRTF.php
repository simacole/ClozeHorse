<?php
$mytitle = $_POST['rtftitle'];
$mydetails = $_POST['rtfdetails'];
$myclozelist = $_POST['rtfclozelist'];
$mycloze = $_POST['rtfcloze'];
//echo $mycloze;
//echo $mytitle;
$myfile = preg_replace("/\s+/","_",$mytitle);
$myfile = preg_replace("/\W+/" , "", $myfile);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"". $myfile . ".rtf\"");
?>
{\rtf1\ansi\ansicpg1252\cocoartf949\cocoasubrtf420
{\fonttbl\f0\fswiss\fcharset0 ArialMT;\f1\fswiss\fcharset0 Helvetica;\f2\fswiss\fcharset0 Arial-Black;
}
{\colortbl;\red255\green255\blue255;\red191\green191\blue191;}
\paperw11905\paperh16837\margl1440\margr1440\vieww9000\viewh10800\viewkind0
\pard\tx560\tx1120\tx1680\tx2240\tx2800\tx3360\tx3920\tx4480\tx5040\tx5600\tx6160\tx6720\ql\qnatural\pardirnatural
\f0\fs24 \cf0 <?php echo $mydetails; ?>\
\f1 \
\pard\tx560\tx1120\tx1680\tx2240\tx2800\tx3360\tx3920\tx4480\tx5040\tx5600\tx6160\tx6720\qc\pardirnatural
\f2\b\fs48 \cf0 <?php echo $mytitle; ?>\
\f1\b0\fs24 \
\pard\tx560\tx1120\tx1680\tx2240\tx2800\tx3360\tx3920\tx4480\tx5040\tx5600\tx6160\tx6720\ql\qnatural\pardirnatural
\cf0 \
\itap1\trowd \taflags1 \trgaph108\trleft-108 \trbrdrt\brdrnil \trbrdrl\brdrnil \trbrdrt\brdrnil \trbrdrr\brdrnil 
\clvertalc \clshdrawnil \clbrdrt\brdrs\brdrw60\brdrcf2 \clbrdrl\brdrs\brdrw60\brdrcf2 \clbrdrb\brdrs\brdrw60\brdrcf2 \clbrdrr\brdrs\brdrw60\brdrcf2 \clpadl100 \clpadr100 \gaph\cellx8640
\pard\intbl\itap1\tx560\tx1120\tx1680\tx2240\tx2800\tx3360\tx3920\tx4480\tx5040\tx5600\tx6160\tx6720\sl-280\slleading280\sb280\ql\qnatural\pardirnatural
\f0 \cf0<?php echo $myclozelist; ?>\cell \lastrow\row
\pard\tx560\tx1120\tx1680\tx2240\tx2800\tx3360\tx3920\tx4480\tx5040\tx5600\tx6160\tx6720\ql\qnatural\pardirnatural
\f1 \cf0 \
\
<?php echo $mycloze; ?>
}