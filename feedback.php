<?php

if(isset($_POST['fsubmit'])){
	if(isset($_POST['fname'])){ $fname=$_POST['fname']; $femail=$_POST['femail']; echo $fname;
echo $femail;}
$fmessage=$_POST['fmessage'];


echo $fmessage;
}

?>