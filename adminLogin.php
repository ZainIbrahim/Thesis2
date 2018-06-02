<?php
require_once('header.php');
if(isset($_POST['submit']) && $_POST['submit']=='Login')
{
	include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();
	
	$uname	=	$_POST['uname'];
	$pass	=	$_POST['pass'];
	$sql="select * from `admin` where uname='$uname' and pass='$pass'";
	$res=$db->readValue($sql);
	//print_r($res);exit;
	if(isset($res['id'])){
		$_SESSION['id']		=	$res['id'];
		$_SESSION['type']	=	1;
		
	?>
			<script language="JavaScript">
				window.location. href='index.php';
			</script>
	<?php
	}
	else
	{
	?>		
		<script language="JavaScript">
			alert('Login failed. Please enter valid details.');
		</script>
	<?php
	}
	
	$db->dbClose();	
}
?>

  	<div class="columnsContainer">

	  	<div class="leftColumn">
	  		<form method="post" action="" name="loginform">
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Login</h2></td>
				</tr>
				<tr>
					<td>Username:</td><td><input type="text" name="uname" id="uname"></td>
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

		<?php
			require_once('rightNav.php');

		?>
	  	

		<script type="javascript">var loginfrmvalidator = new Validator("loginform");
loginfrmvalidator.addValidation("uname","req","Username Field Should not be empty");
loginfrmvalidator.addValidation("pass","req","Password Field Should not be empty");
</script>
  	</div>
    
<?php
	require_once('footer.php');

?>