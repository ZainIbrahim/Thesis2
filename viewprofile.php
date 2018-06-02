<?php 
include_once('header.php');
	
include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();
	$sql="select *from student_registration where id=".$_SESSION['id'];
	$res=$db->readValue($sql);	
	//print_r($res);exit;
	if(isset($_POST['submit']) && $_POST['submit']=='Update'){
		$fname = $_POST['fname'];
		$uname = $_POST['mno'];
		$email = $_POST['email'];
		$cno = $_POST['cno'];
		$pass = $_POST['pass'];
		$sql =	"update student_registration set fname='$fname',uname='$mno',email='$email',cno='$cno',pass='$pass' where id=".$_SESSION['id'];
		$res = $db->setQuery($sql);
	
	//print_r($_POST);exit;
	if(isset($res)){
?>	

	 <script language="JavaScript">
				alert('Status updated successfully.');
				window.location.href='index.php';
	 </script>
	
<?php
	}
	} 
	
	$db->dbClose();
?>

	
	



	<div class="columnsContainer">

		<div class="leftColumn">	  		
			
			<form method="post" action="" name="viewprofile">
			<table align="center">
			
				<tr>
					<td colspan="2" align="center"><h2>View Profile</h2></td>
				</tr>
				<tr>
					<td>Name:</td><td><input type="text" name="fname" id="fname" value="<?php echo $res['fname'];?>"></td>
				</tr>
				<tr>
					<td>Matric No:</td><td><input type="text" name="cno" id="mno" value="<?php echo $res['uname'];?>"></td>
				</tr>
				<tr>
					<td>Email :</td><td><input type="text" name="email" id="email" value="<?php echo $res['email'];?>"></td>
				</tr>
				<tr>
					<td>Contact:</td><td><input type="text" name="uname" id="cno" value="<?php echo $res['cno'];?>"></td>
				</tr>
				<tr>
					<td>Password:</td><td><input type="text" name="pass" id="pass" value="<?php echo $res['pass'];?>"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="submit" value="Update"></td>
				</tr>
				
			</table>
			</form>
	  		
	  	</div>
		<div>
			<?php
			require_once('rightNav.php');

			?>

		</div>

  	</div>
<?php
	require_once('footer.php');

?>