<?php
require_once('header.php');
if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();
	
	extract($_POST);
	$sql="INSERT INTO `student_registration`(fname,cno,email,uname,pass)VALUES ('$fname', '$cno', '$email', '$uname', '$pass')";
	$res=$db->setQuery($sql);
	if($res)
	{
	?>
			<script language="JavaScript">
			window.location. href='studentLogin.php';
			</script>
	<?php
	}
	else
	{
	?>		
		<script language="JavaScript">
			alert('Registration failed. Please try again.');
		</script>
	<?php
	}
	
	$db->dbClose();
		
}
?>

  	<div class="columnsContainer">

	  	<div class="leftColumn"  style="width:100%">
	  		<form method="post" action="" name="registerform">
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Registration</h2></td>
				</tr>
				<tr>
					<td>Name:</td><td><input type="text" name="fname" id="fname"></td>
				</tr>
				<tr>
					<td>Contact No:</td><td><input type="text" name="cno" id="cno"></td>
				</tr>
				<tr>
					<td>Email ID:</td><td><input type="text" name="email" id="email"></td>
				</tr>
				<tr>
					<td>Metric. No:</td><td><input type="text" name="uname" id="uname"></td>
				</tr>
				<tr>
					<td>Password:</td><td><input type="text" name="pass" id="pass"></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="Submit"></td><td><input type="reset" name="reset" value="Reset"></td>
				</tr>
				
			</table>
			</form>
			

	  	</div>

		

		<script  type="text/javascript">
			var regfrmvalidator = new Validator("registerform");
			regfrmvalidator.addValidation("fname","req","Name Field Should not be empty");
			regfrmvalidator.addValidation("cno","req","Contact No Field Should not be empty");
			regfrmvalidator.addValidation("email","req","Contact No Field Should not be empty");
			regfrmvalidator.addValidation("email","email","Please enter valid Emailid");
			regfrmvalidator.addValidation("uname","req","Username Field Should not be empty");
			regfrmvalidator.addValidation("pass","req","Password Field Should not be empty");
		</script>
		
  	</div>
    
<?php
	require_once('footer.php');

?>