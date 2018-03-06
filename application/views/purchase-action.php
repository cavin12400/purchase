<?php 
	 include_once('Mix.php');
	 $object = new Mix();
	 if($_GET['option'] == "fetch"){
	 	$object->fetch("SELECT * FROM tbltask");
	 }
?>