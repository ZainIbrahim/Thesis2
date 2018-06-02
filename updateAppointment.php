<?php
require_once('header.php');

	include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();
	
	$sql = "select a.*,r.fname from lecturer_registration r, appointment a where a.supervisor_id=r.id and a.supervisor_id=".$_SESSION['id'];
	
	$res = $db->readValues($sql);
	//print_r($res);
	if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	{
		$list = isset($_POST['appointment'])?$_POST['appointment']:array();
		
		for($i=0;$i<count($res);$i++){
		
			$status = 0;
			$id = $res[$i]['id'];
			for($k=0;$k<count($list);$k++){
			
				if($res[$i]['id']==$list[$k]){
					
					$status	=	1;
					break;
					
				}
				
			}
			
			$sql ="update appointment set status=$status where id=$id";
			$db->setQuery($sql);
		}
		
		echo '<script>alert("Status updated");window.location.href="updateAppointment.php";</script>';

	
	}
	
	//	
	
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
					<td>Date</td><td>Time</td><td>Supervisor</td><td>Subject</td><td>Status</td><td>Approve</td>
				</tr>
				
				<?php for($k=0;$k<count($res);$k++){ ?>
				
				<tr>
					<td><?php echo $res[$k]['a_date']; ?></td>
					<td><?php echo $res[$k]['a_hour'].' : '.$res[$k]['a_minute']; ?></td>
					<td><?php echo $res[$k]['fname']; ?></td>
					<td><?php echo $res[$k]['subject']; ?></td>
					<td><?php if($res[$k]['status']==0) echo 'Pending'; else echo 'Approved';?></td>
					<td><input type="checkbox" name="appointment[]" value="<?php echo $res[$k]['id']; ?>" <?php if($res[$k]['status']) echo 'checked'; ?>></td>
				</tr>
				
				<?php } ?>
				
				<tr><td><input type="submit" name="submit" value="Submit"></td></tr>
			
				
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