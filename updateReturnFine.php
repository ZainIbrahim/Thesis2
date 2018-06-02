<?php 
include('Database.class.php');
$db	=	new Database;
$db->dbConnect();

$date = $_GET['r'];
$b = $_GET['b'];
$id = $_GET['id'];

$d = DateTime::createFromFormat('Y-m-d', $date);
if($d && $d->format('Y-m-d') == $date){
	$sql1 = 'SELECT DATEDIFF("'.$date.'","'.$b.'") as date_difference';
	$res = $db->readValue($sql1);
	$days	=	(int)$res['date_difference'];
	if($days>=0){
		$fine = ($days<=10)?0:($days-10)*10;
		$sql = "update thesis_request set return_date='$date', fine='$fine' where id=".$id;
		//echo $sql;
		$st = $db->setQuery("update thesis_request set return_date='$date', fine='$fine' where id=".$id);
		
		if($st)
			echo $fine.','.'Return date updated success in system';
		else
			echo '-1,Update failed. Try again';
	}
	else{
		echo '-1,Return date should not be before borrowed date';
	}
}
else{
	echo '-1,Enter validate return date(Y-m-d)';
}



?>