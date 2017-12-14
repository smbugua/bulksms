<?php
include('header.php');
$name=$_POST['name'];
$tel=$_POST['no'];
$id=$_POST['db'];
mysql_query("INSERT INTO contacts (name,tel,groupid)VALUES('$name','$tel','$id')");
echo "<script>location.replace('contacts.php')</script>";

?>