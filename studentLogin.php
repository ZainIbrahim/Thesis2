<?php
require_once('header.php');
if(isset($_POST['submit']) && $_POST['submit']=='Login')
{
	include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();
	
	$uname	=	$_POST['uname'];
	$pass	=	$_POST['pass'];
	$sql="select * from `student_registration` where uname='$uname' and pass='$pass'";
	$res=$db->readValue($sql);
	//print_r($res);exit;
	if(isset($res['id']) && $res['status']==1)
	{
		
		$_SESSION['id']		=	$res['id'];
		$_SESSION['type']	=	3;
		
	?>
			<script language="JavaScript">
				window.location. href='index.php';
			</script>
	<?php
	}
	else if(isset($res['id']) && $res['status']==0)
	{
	?>		
	<script language="JavaScript">
			alert('Your registration is not approved yet by admin');
		</script>
	
	<?php }else{ ?>
		<script language="JavaScript">
			alert('Login failed. Please enter valid details.');
		</script>
	<?php
	}
	
	$db->dbClose();	
}
?>

  	<div class="columnsContainer">

	  	<div class="leftColumn"  style="width:100%">
	  		<form method="post" action="" name="loginform">
			
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Login</h2></td>
				</tr>
				<tr>
					<td>Metric. No(Username):</td><td><input type="text" name="uname" id="uname"></td>
				</tr>
				<tr>
					<td>Password:</td><td><input type="password" name="pass" id="pass"></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="Login"></td><td><input type="reset" name="reset" value="Reset"></td>
				</tr>
				
			</table>
			</form>

	  	</div>
	  	

		<script type="text/javascript">var loginfrmvalidator = new Validator("loginform");
loginfrmvalidator.addValidation("uname","req","Username Field Should not be empty");
loginfrmvalidator.addValidation("pass","req","Password Field Should not be empty");
</script>
  	</div>
    
<?php
	require_once('footer.php');

?>