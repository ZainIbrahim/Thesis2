<?php 
include_once('header.php');
include('Database.class.php');
$db	=	new Database;
$db->dbConnect();

if(isset($_POST['submit']) && $_POST['submit']=='Update'){
	
	//print_r($_POST);exit;
	
	$tot = $_POST['tot'];
	
	for($i=0;$i<$tot;$i++){
		
		$status		=	(isset($_POST['status'][$i]) && $_POST['status'][$i]=='on')?1:0;
		$lecId	=	$_POST['lecturer'][$i];
		$sql =	"update lecturer_registration set status=$status where id=$lecId";
		//echo $sql;
		$db->setQuery($sql);
	}
	
	echo '<script>alert("Status updated successfully.");</script>';
	
	
}


$sql="SELECT * FROM lecturer_registration";

$res=$db->readValues($sql);

$db->dbClose();
?>
  	<div class="columnsContainer">

	  	<div class="leftColumn">
	  		<form method="post" action="" name="registerform">
			<table align="center">
	
	  		<h2>Lecturers</h2>

			<form action="" method="post">
			
			<input type="hidden" name="tot" value="<?php echo count($res); ?>">
			
			<table cellpadding="8">
				
				<tr>
					<td>Lecturer Name</td><td>Email</td><td>Password</td><td>Status</td><td>Select Status</td>
				</tr>
				<?php 
				
				for($i=0;$i<count($res);$i++){ 
				?>	
				
				<tr>
					<td><?php echo $res[$i]['fname']; ?></td>
					<td><?php echo $res[$i]['email']; ?></td>
					<td><?php echo $res[$i]['pass']; ?></td>
					<td><?php if($res[$i]['status']==1)echo 'Approved'; else echo 'Pending'; ?></td>
					<td><input type="checkbox" name="status[]" id="status[]" <?php if($res[$i]['status']==1) echo "checked"; ?>> <input type="hidden" name="lecturer[]" id="lecturer[]" value="<?php echo $res[$i]['id']; ?>"></td>
				</tr>
				<?php 
					}
				?>
				<tr >
					<td colspan="5" align="right"><input type="submit" name="submit" value="Update"> </td>
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