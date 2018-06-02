<?php
require_once('header.php');
if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	include('Database.class.php');
	$db	=	new Database;
	$db->dbConnect();
	
	extract($_POST);
	$sql="INSERT INTO `lecturer_registration`(fname,email,pass,faculty,department)VALUES ('$fname', '$email','$pass', '$faculty', '$department')";

	$res=$db->setQuery($sql);
	if($res)
	{
	?>
			<script language="JavaScript">
			window.location. href='lecturerLogin.php';
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
					<td>Email ID:</td><td><input type="text" name="email" id="email"></td>
				</tr>
				<tr>
					<td>Password:</td><td><input type="text" name="pass" id="pass"></td>
				</tr>
				<tr>
					<td>Faculty:</td>
					<td><select name="faculty" id="faculty" onChange="updateDepartment()">
						<option value="">Select Faculty</option>
						<option value="Information Technology">Information Technology</option>
						<option value="Business Administration">Business Administration</option>
						<option value="Engineering">Engineering</option>
					</select></td>
				</tr>
				<tr>
					<td>Department:</td>
					<td>
					<select id="department" name="department">
					</select>
					</td>
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
			regfrmvalidator.addValidation("faculty","req","Faculty Field Should not be empty");
			regfrmvalidator.addValidation("email","req","Contact No Field Should not be empty");
			regfrmvalidator.addValidation("email","email","Please enter valid Emailid");
			regfrmvalidator.addValidation("department","req","Department Field Should not be empty");
			regfrmvalidator.addValidation("pass","req","Password Field Should not be empty");
			
			function updateDepartment(){
				
				var faculty	=	document.getElementById("faculty").value;
				if(faculty==''){
					alert("Select faculty");
				}else{
					
					document.registerform.department.options.length=0;
					if(faculty=="Information Technology"){
						document.registerform.department.options[0]=new Option("Computer Science", "Computer Science", true, false);
						document.registerform.department.options[1]=new Option("Software Engineering", "Software Engineering", false, false);
						document.registerform.department.options[2]=new Option("Networking", "Networking", false, false);
						document.registerform.department.options[3]=new Option("Mobile Technology", "Computer Science", false, false)
					}else if(faculty=="Business Administration"){
						document.registerform.department.options[0]=new Option("Marketing", "Marketing", true, false);
						document.registerform.department.options[1]=new Option("Accounting", "Accounting", false, false);
						document.registerform.department.options[2]=new Option("Finance", "Finance", false, false);
						
					}else{
						document.registerform.department.options[0]=new Option("Electrical&Electronics", "Electrical&Electronics", true, false);
						document.registerform.department.options[1]=new Option("Mechanical", "Mechanical", false, false);
						document.registerform.department.options[2]=new Option("Civil Engineering", "Civil Engineering", false, false);
					}
					
					
				}
				
				
			}
			
			
			
		</script>
		
  	</div>
    
<?php
	require_once('footer.php');

?>