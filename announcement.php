<?php
require_once('header.php');
include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();
	
		$sql = "select * from announcement";
		$res = $db->readValues($sql);
	
	if(isset($_GET['id'])){
		$sql = "select * from announcement where id=".$_GET['id'];
		$res1 = $db->readValue($sql);
	}
		$db->dbClose();	
?>

  	<div class="columnsContainer">

	  	<div class="leftColumn">
		<form method="post" action="" name="announcements">
	  		<table align="center" >
				<tr >
					<td><h2>Announcements</h2></td>
				</tr>
			
			<table id="table" align="center" cellpadding="5" >
				
				<tr >
					<td>Announcement Date</td>  <td>Subject</td>  <td>Message</td>  <td>Details</td>
				</tr>
				<?php for($i=0;$i<count($res);$i++){?>
				<tr>
					
					<td><?php echo $res[$i]['a_date'];?></td>
					<td><?php echo $res[$i]['subject'];?></td>
					<td><?php echo $res[$i]['message'];?></td>
					<td><a href="announcement.php?id=<?php echo $res[$i]['id'];?>">Details</a></td>
					
				</tr>
				<?php } ?>
				</table>
				
				<br><br><br>
				<table align="center">
					<tr>
						<td><input type="text" name="subjet" id="subject" value="<?php echo $res1['subject'];?>"></td>
					</tr>
					<tr>
			<td><textarea rows="6" cols="30" name="announcement" id="announcement"><?php echo $res1['message'];?></textarea></td>
					</tr>
				</table>
				
				
	
			
			
	  	</div>

		<?php
			require_once('rightNav.php');

		?>
	  	

  	</div>
    
<?php
	require_once('footer.php');

?>

 <SCRIPT>
    document.getElementById('table').style.display='NONE';    
</SCRIPT>
