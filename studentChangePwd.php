<?php 
include_once('header.php');

include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();


if(isset($_POST['submit']) && $_POST['submit']=='Update')
{
	
	$npass	=	$_POST['npass'];
	$sql="update `student_registration` set pass='$npass' where id=".$_SESSION['id'];
	$res=$db->setQuery($sql);
	//print_r($res);exit;
	if($res)
	{
		
		
	?>
			<script language="test/javaScript">
				alert('Password changed successfully.');
				window.location. href='index.php';
			</script>
	<?php
	}
	else
	{
	?>		
		<script language="text/javaScript">
			alert('Please enter valid details.');
			window.location. href='changepassword.php';
		</script>
	<?php
	}
	
	
}

$pinfo = $db->readValue("select * from student_registration where id=".$_SESSION['id']);
	
$db->dbClose();
//print_r($pinfo);exit;	
	



?>
  	<div class="columnsContainer">

	  	
	  	<div class="leftColumn">

			<form method="post" action="" name="loginform">
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Change Password</h2></td>
				</tr>
				<tr>
					<td>Old Password:</td><td><input type="password" name="opass" id="opass"></td>
				</tr>
				<tr>
					<td>New Password:</td><td><input type="password" name="npass" id="npass"></td>
				</tr>
				<tr>
					<td>Confirm Password:</td><td><input type="password" name="cpass" id="cpass"></td>
				</tr>
				
				<tr>
					<td><input type="submit" name="submit" value="Update"></td><td><input type="reset" name="reset" value="Reset"></td>
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
<SCRIPT language="JavaScript">

		var frmvalidator = new Validator("loginform");
		frmvalidator.addValidation("opass","req","Old password Field Should not be empty");
		frmvalidator.addValidation("npass","req","New Password Field Should not be empty");
		frmvalidator.addValidation("cpass","req","Confirm Password Field Should not be empty");
		frmvalidator.setAddnlValidationFunction("DoCustomValidation");
		function DoCustomValidation()
		{
			var frmvalidator = document.forms["loginform"];
			var npass=frmvalidator.npass.value;
			var cpass=frmvalidator.cpass.value;
			var opass=frmvalidator.opass.value;
			var oldpass	=	"<?php echo $pinfo['pass']; ?>";
			
			if(opass!=oldpass){
				alert("Old password does not find in system.");
				return false;
			}
			
			if(npass==cpass)
			{
				return true;
			}
			else{
				alert("New password and confirm does not match.");
				return false;
			}
		}
		</SCRIPT>
<?php 

require_once('footer.php');
?>