<?php
require_once('header.php');

	include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();
	
	if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	{
		$d	=	$_POST['date'];
		$sub	=	$_POST['subject'];
		$sup	=	$_POST['supervisor'];
		$h	=	$_POST['hour'];
		$t	=	$_POST['time'];
		$sid = $_SESSION['id'];
		$sql = "insert into appointment(a_date,subject,a_hour,a_minute,student_id,supervisor_id) values('$d','$sub','$h','$t','$sid',$sup)";
		$res=$db->setQuery($sql);

		if($res){
			echo '<script>alert("Appointment sent");</script>';
		}
		else{
			echo '<script>alert("Appointment failed");</script>';
		}
	}
	
	
	$sql = "select * from lecturer_registration";
	$res = $db->readValues($sql);
	
	$sql = "select * from student_registration where id=".$_SESSION['id'];
	$std = $db->readValue($sql);
	
	//print_r($res);
	$db->dbClose();	

?>

  	<div class="columnsContainer">

	  	<div class="leftColumn">
	  		<form method="post" action="" name="loginform">
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Request Appointment</h2></td>
				</tr>
				<tr>
					<td>Appointment Date:</td><td><input type="text" name="date" id="date" value="<?php echo date('Y-m-d'); ?>"></td>
				</tr>
				
				<tr>
					<td>Time:</td>
					<td>
					Hours: <select name="hour" id="hour">
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					</select>
					Time:
					<select name="time">
					<option value="00">00</option>
					<option value="15">15</option>
					<option value="30">30</option>
					<option value="45">45</option>
					</select>
					</td>
				</tr>
				
				<tr>
					<td>Supervisor :</td>
					<td>
					<select name="supervisor">
					<?php for($k=0;$k<count($res);$k++){ ?>
					<option value="<?php echo $res[$k]['id']; ?>"><?php echo $res[$k]['fname']; ?></option>
					<?php } ?>
					</select>
					</td>
				</tr>
				<tr>
					<td>Student Metric. NO:</td><td><?php echo $std['uname']; ?></td>
				</tr>
				
				<tr>
					<td>Student Name:</td><td><?php echo $std['fname']; ?></td>
				</tr>
				
				<tr>
					<td>Subject :</td><td><input type="text" name="subject" id="subject"></td>
				</tr>
				
				<tr>
					<td colspan="2" align="center"><input type="submit" name="submit" value="Submit">    <input type="reset" name="reset" value="Reset"></td>
				</tr>
				
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