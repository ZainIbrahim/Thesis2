<?php 
include_once('header.php');

include('Database.class.php');
$db	=	new Database;
$db->dbConnect();

$sql = "select * from thesis";

$res = $db->readValues($sql);

if($_GET['tid']){
	
	$det = $db->readValue("select t.*,l.fname,l.email from thesis t, lecturer_registration l where l.id=t.supervisor_id and t.id=".$_GET['tid']);
}


?>

<div class="columnsContainer">

	  	<div class="leftColumn">
	  		<form method="post" action="" name="loginform">
			
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Search Thesis By Category</h2></td>
				</tr>
				<tr>
					<td>Select one</td>
					<td>
					<select name="thesis" id="thesis" style="width:auto" onChange="displayThesis()">
						<option value="">Select one</option>
						<?php for($i=0;$i<count($res);$i++){ ?>
						<option value="<?php echo $res[$i]['id']; ?>"><?php echo 'Category: '.$res[$i]['department'].', Application Type: '.$res[$i]['type_application'].', Thesis: '.$res[$i]['title']; ?></option>
						<?php } ?>
					</select>
					</td>
				</tr>
			</table>
			<br></br>
			
			<?php if(isset($det['id'])){ ?>
			
			<table align="center">
				<tr>
					<td>Thesis title :</td><td><?php echo $det['title']; ?></td>
				</tr>
				<tr>
					<td>Author :</td><td><?php echo $det['author']; ?></td>
				</tr>
				<tr>
					<td>Supervisor :</td><td><?php echo $det['fname']; ?></td>
				</tr>
				<tr>
					<td>Semester :</td><td><?php echo $det['semester']; ?></td>
				</tr>
				<tr>
					<td>year :</td><td><?php echo $det['year']; ?></td>
				</tr>
				<tr>
					<td>Lecturer Email:</td><td><?php echo $det['email']; ?></td>
				</tr>
				<tr>
					<td><input type="button" value="Print" onClick="window.print();"></td>
				</tr>
			</table>
			
		<?php 	} ?>
 			
		<div class="rightColum">
			<?php
				require_once('rightNav.php');

			?>
		</div>

	<script type="text/javascript">
	function displayThesis(){
		var id = document.getElementById('thesis').value;
		if(id=='')
		{
			alert('select thesis');
		}
		else{
			window.location.href='searchByCategory.php?tid='+id;
		}
	}
	</script>	
		
</div>
<?php 

require_once('footer.php');
?>
	