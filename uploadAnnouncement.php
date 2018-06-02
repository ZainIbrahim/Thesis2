<?php
require_once('header.php');

	include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();
	
	if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	{
		$d	=	$_POST['date'];
		$s	=	$_POST['subject'];
		$a	=	$_POST['announcement'];
		$sql = "insert into announcement(a_date,subject,message) values(NOW(),'$s','$a')";
		$res=$db->setQuery($sql);

		if($res){
			echo '<script>alert("Announcement uploaded");</script>';
		}
		else{
			echo '<script>alert("Announcement upload failed");</script>';
		}
	}
	
	
	
	if(isset($_GET['id'])){
		$sql = "delete from announcement where id=".$_GET['id'];
		$res1 = $db->setQuery($sql);
			if($res1){
				echo '<script>alert("Announcement deleted");</script>'; 
			}
			else{
				echo '<script>alert("Announcement delete failed");</script>';
			}
			
			
	}
	
	$sql = "select* from announcement";
	$res = $db->readValues($sql);
	
	//print_r($res);exit;
	$db->dbClose();	

?>

  	<div class="columnsContainer">

	  	<div class="leftColumn">
	  		<form method="post" action="" name="uploadannouncements">
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Upload Announcements</h2></td>
				</tr>
				<tr>
					<td>Announcement date:</td><td><input type="text" name="date" id="date" readonly value="<?php echo date('Y-m-d'); ?>"></td>
				</tr>
				<tr>
					<td>Subject :</td><td><input type="text" name="subject" id="subject"></td>
				</tr>
				<tr>
					<td>Announcement Details:</td><td><textarea rows="6" cols="30" name="announcement" id="announcement"></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="submit" value="Submit">     <input type="reset" name="reset" value="Reset"></td>
				</tr>
				
			</table>
			<?php if(count($res)>0){?>
			<table align="center" cellpadding="5" >
				<tr >
					<td>Announcement Date</td>  <td>Subject</td>  <td>Message</td>  <td>Delete</td>
				</tr>
				<?php for($i=0;$i<count($res);$i++){?>
				<tr>
					
					<td><?php echo $res[$i]['a_date'];?></td>
					<td><?php echo $res[$i]['subject'];?></td>
					<td><?php echo $res[$i]['message'];?></td>
					<td><a href="uploadAnnouncement.php?id=<?php echo $res[$i]['id'];?>">delete</a></td>
					
				</tr>
				<?php } ?>
			
			</table>
			<?php } ?>
			</form>

	  	</div>

		<?php
			require_once('rightNav.php');

		?>
  	</div>

<script type="text/javascript">
			var loginfrmvalidator = new Validator("uploadannouncements");
			loginfrmvalidator.addValidation("subject","req","subject Field Should not be empty");
			loginfrmvalidator.addValidation("announcement","req","announcement  Field Should not be empty");
			</script>
	
<?php
	require_once('footer.php');

?>