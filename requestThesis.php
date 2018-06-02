<?php 
include_once('header.php');

include('Database.class.php');
$db	=	new Database;
$db->dbConnect();

if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	
	//print_r($_POST);exit;
	$list = isset($_POST['thesis'])?$_POST['thesis']:array();
	for($k=0;$k<count($list);$k++){
		$tid = $list[$k];
		$sid = $_SESSION['id'];
		$sql ="insert into thesis_request(thesis_id,student_id,created_date) values($tid,$sid,NOW())";
		$db->setQuery($sql);
	}
	
	echo '<script>alert("Request submitted");window.location.href="requestStatus.php";</script>';
	
	
}


$sql = "select * from thesis group by department";

$cats = $db->readValues($sql);




if(isset($_GET['category'])){
	
	$category = $_GET['category'];
	$sql = "select * from thesis where department='$category'";
	$types = $db->readValues($sql);
}

if(isset($_GET['application'])){
	
	$application	=	$_GET['application'];
	$category = $_GET['category'];
	$sql = "select t.*,r.fname from thesis t, lecturer_registration r where t.supervisor_id=r.id and t.department='$category' and t.type_application='$application'";
	$books = $db->readValues($sql);
}




?>

<div class="columnsContainer">

	  	<div class="leftColumn">
	  		
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Request Thesis Book</h2></td>
				</tr>
				<tr>
					<td>
					<select name="category" id="category" style="width:auto" onChange="displayType()">
						<option value="">Select Category</option>
						<?php for($i=0;$i<count($cats);$i++){ ?>
						<option value="<?php echo $cats[$i]['department']; ?>" <?php if($_GET['category']==$cats[$i]['department']) echo "selected"; ?>><?php echo $cats[$i]['department']; ?></option>
						<?php } ?>
					</select>
					</td>
					<td>
					<select name="application" id="application" style="width:auto" onChange="displayThesis()">
						<option value="">Select Application</option>
						<?php for($j=0;$j<count($types);$j++){ ?>
						<option value="<?php echo $types[$j]['type_application']; ?>" <?php if($_GET['application']==$types[$j]['type_application']) echo "selected"; ?>><?php echo $types[$j]['type_application']; ?></option>
						<?php } ?>
					</select>
					</td>
				</tr>
			</table>
			<br></br>
			
			<?php if(count($books)>0){ ?>
			<form method="post" action="" name="loginform">
			
			<table align="center" cellpadding="5">
				<tr>
					<td>Thesis ID</td><td>Thesis Title</td><td>Author</td><td>Year</td><td>Semester</td><td>Supervisor</td><td>Request</td>
				</tr>
				
				<?php for($k=0;$k<count($books);$k++){ ?>
				
				<tr>
					<td><?php echo $books[$k]['thesis_id']; ?></td><td><?php echo $books[$k]['title']; ?></td><td><?php echo $books[$k]['author']; ?></td><td><?php echo $books[$k]['year']; ?></td><td><?php echo $books[$k]['semester']; ?></td><td><?php echo $books[$k]['fname']; ?></td><td><input type="checkbox" name="thesis[]" value="<?php echo $books[$k]['id']; ?>"></td>
				</tr>
				<?php } ?>
				
				<tr><td><input type="submit" name="submit" value="Submit">&nbsp; <input type="button" value="Reset" onClick="window.location.href='requestThesis.php'"></td></tr>
				
			</table>
			
			</form>
			
		<?php 	} ?>
 			
		<div class="rightColum">
			<?php
				require_once('rightNav.php');

			?>
		</div>

	<script type="text/javascript">
	function displayType(){
		var id = document.getElementById('category').value;
		if(id=='')
		{
			alert('select category');
		}
		else{
			window.location.href='requestThesis.php?category='+id;
		}
	}
	function displayThesis(){
		var id = document.getElementById('application').value;
		var id1 = document.getElementById('category').value;
		if(id=='')
		{
			alert('select type of application');
		}
		else{
			window.location.href='requestThesis.php?application='+id+'&category='+id1;
		}
	}
	</script>	
		
</div>
<?php 

require_once('footer.php');
?>
	