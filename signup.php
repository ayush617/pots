<?php

if(isset($_POST['s_submit'])){
$s_fname=$_POST['s_fname'];
$s_lname=$_POST['s_lname'];	
$s_uname=$_POST['s_uname'];
$s_sex=$_POST['s_sex'];
$s_email=$_POST['s_email'];
$s_pass=$_POST['s_pass'];

echo $s_uname;
echo $s_pass;
echo $s_fname;
echo $s_lname;
echo $s_sex;
echo $s_email;

}

?>