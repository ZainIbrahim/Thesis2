<?php
require_once('header.php');

	include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();
	
	$sql = "select a.*,r.fname from lecturer_registration r, appointment a where a.supervisor_id=r.id and a.student_id=".$_SESSION['id'];
	$res = $db->readValues($sql);
	//print_r($res);
	$db->dbClose();	

?>

  	<div class="columnsContainer">

	  	<div class="leftColumn">
	  		<form method="post" action="" name="loginform">
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Appointment Status</h2></td>
				</tr>
				
			</table>
			<table align="center" cellpadding="5">
				<tr>
					<td>Date</td><td>Time</td><td>Supervisor</td><td>Subject</td><td>Status</td>
				</tr>
				
				<?php for($k=0;$k<count($res);$k++){ ?>
				
				<tr>
					<td><?php echo $res[$k]['a_date']; ?></td>
					<td><?php echo $res[$k]['a_hour'].' : '.$res[$k]['a_minute']; ?></td>
					<td><?php echo $res[$k]['fname']; ?></td>
					<td><?php echo $res[$k]['subject']; ?></td>
					<td><?php if($res[$k]['status']==0) echo 'Pending'; else echo 'Approved';?></td>
				</tr>
				
				<?php } ?>
				
				<tr><td><input type="button" name="submit" value="Print" onClick="window.print();"></td></tr>
			
				
			</table>
			
			</form>

	  	</div>

		<?php
			require_once('rightNav.php');

		?>
  	</div>

	
<?php
	require_once('footer.php');

?>