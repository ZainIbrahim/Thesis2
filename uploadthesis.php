<?php 
include_once('header.php');

include('Database.class.php');
$db	=	new Database;
$db->dbConnect();
$sql = "select * from lecturer_registration";
$lect = $db->readValues($sql); 
//print_r($lect); exit;
if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	$thesisid	=	$_POST['thesisid'];
	$department	=	$_POST['department'];
	$type_application	=	$_POST['type'];
	$title	=	$_POST['title'];
	$author	=	$_POST['author'];
	$semester	=	$_POST['semester'];
	$year	=	$_POST['year'];
	$supervisor_id = $_POST['lecturer'];
	
	$sql = "insert into thesis(thesis_id,department,type_application,title,author,semester,year,supervisor_id)values ('$thesisid', '$department', '$type_application', '$title', '$author', $semester, $year, $supervisor_id)";
	
	//echo $sql;exit;
	
	$res=$db->setQuery($sql);

	if($res){
		echo '<script>alert("Uploaded thesis");</script>';
	}
	else{
		echo '<script>alert("Uploaded thesis failed");</script>';
	}
	
}

$db->dbClose();
	
?>

	
	



	<div class="columnsContainer">

		<div class="leftColumn">	  		
			
			<form method="post" action="" name="uploadthesis">
			<table align="center">
			
				<tr>
					<td colspan="2" align="center"><h2>Upload Thesis</h2></td>
				</tr>
				<tr>
					<td>thesis Id </td><td><input type="text" name="thesisid" id="thesisid" value=""></td>
				</tr>
				<tr>
					<td>Department </td><td><input type="text" name="department" id="department" value=""></td>
				</tr>
				<tr>
					<td>Type Of Applcetion </td><td><input type="text" name="type" id="type" value=""></td>
				</tr>
				<tr>
					<td>Thesis title </td><td><input type="text" name="title" id="title" value=""></td>
				</tr>
				<tr>
					<td>Author Name </td><td><input type="text" name="author" id="author" value=""></td>
				</tr>
				<tr>
					<td>Year </td><td><input type="text" name="year" id="year" value=""></td>
				</tr>
				<tr>
					<td>Semester </td><td><input type="text" name="semester" id="semester" value=""></td>
				</tr>
				<tr>
					<td>Supevisor/Lecturer </td>
					
					<td >
				<select id="lecturer" name="lecturer" onChange="populateLecturer()">
					<option value="">Select Lecturer</option>
					<?php for($i=0;$i<count($lect);$i++){ ?>
					<option value="<?php echo $lect[$i]['id']; ?>"><?php echo $lect[$i]['fname']; ?></option>
					<?php } ?>
				</select>
				</td>

				</tr>
				<!--<tr>
					<td>Contact </td><td><input type="text" name="contact" id="contact" value=""></td>
				</tr>-->
				<tr>
					<td>Email </td><td><input type="text" name="email" id="email" value=""></td>
				</tr>
				<tr>
					<td align="right"><input type="submit" name="submit" value="Submit"></td><td align="center"><input type="reset" name="reset" value="Reset"></td>
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
<script type="text/javascript" language="javascript">
    var pausecontent = new Array();
    <?php foreach($lect as $key => $val){ ?>
        pausecontent.push({'id':'<?php echo $val['id']; ?>','email':'<?php echo $val['email']; ?>'});
    <?php } ?>
	
	function populateLecturer(){
		
		var lecId = document.getElementById("lecturer").value;
		var lect = pausecontent.length;
		//alert(pausecontent);
		
		for(var i=0;i<lect;i++){
			
			if(pausecontent[i].id==lecId){
				
				document.getElementById('email').value = pausecontent[i].email;
			}
			
		}
		
		
	}
	
</script>

<script type="text/javascript">
			var loginfrmvalidator = new Validator("uploadthesis");
			loginfrmvalidator.addValidation("thesisid","req","Thesis ID Field Should not be empty");
			loginfrmvalidator.addValidation("department","req","Department Field Should not be empty");
			loginfrmvalidator.addValidation("type","req","Application Type Field Should not be empty");
			loginfrmvalidator.addValidation("title","req","Thesis title Field Should not be empty");
			loginfrmvalidator.addValidation("author","req","Author Field Should not be empty");
			loginfrmvalidator.addValidation("year","req","Year Field Should not be empty");
			loginfrmvalidator.addValidation("semester","req","Semester Field Should not be empty");
			loginfrmvalidator.addValidation("lecturer","req","Lecturer Field Should not be empty");
</script>



<?php
	require_once('footer.php');

?>