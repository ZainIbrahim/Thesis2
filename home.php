<?php
require_once('header.php');

$res 	=	array();

if(isset($_POST['submit'])){

include('Database.class.php');
$db	=	new Database;
$db->dbConnect();

$txt = $_POST['search'];

$sql = "select t.*,l.fname,l.email from thesis t, lecturer_registration l where l.id=t.supervisor_id and t.title like '%$txt%' and (t.id IN (select thesis_id from thesis_request where return_date!='0000-00-00') or t.id NOT IN(select thesis_id from thesis_request))";
$res = $db->readValues($sql);


}

?>

  	<div class="columnsContainer">

	  	<div class="leftColumn">
	  		
			<table width="100%">
			<tr>
			<td>
			<?php if($_SESSION['type']==3 && isset($_POST['search'])){ ?>
			<h2>Search Results</h2>
			<?php }else{  ?>
			
			<h2>Welcome <?php if($_SESSION['type']==1){ echo 'Admin'; }else if($_SESSION['type']==2){ echo 'Lecturer'; }else if($_SESSION['type']==3){ echo 'Student';}else{ echo '...';}?></h2>
			
			<?php } ?>
			
			</td>
			<td align="right">
				<?php if($_SESSION['type']==3){ ?>
				<form action="" method="post" name="loginform"> 
				<input type="text" name="search" placeholder="Search thesis">&nbsp;<input type="submit" name="submit" value="Search">
				</form>
				<?php } ?>
			</td>
			
			</table>

			<?php 
			
			if($_SESSION['type']==3 && isset($_POST['search'])){ 
			
				?>
				
				<table width="80%" align="center" cellpadding="8" cellspacing="8">
				<tr>
					<td><b>Thesis title</b></td><td><b>Author</b></td>
				<td><b>Supervisor</b></td><td><b>Semester</b></td><td><b>Year</b></td><td><b>Lecturer Email</b></td></tr>
				
				<?php 
				
				if(count($res)){
				
				for($i=0;$i<count($res);$i++){	
			
				?>
				
				<tr>
					<td><?php echo $res[$i]['title']; ?></td><td><?php echo $res[$i]['author']; ?></td>
					<td><?php echo $res[$i]['fname']; ?></td>
					<td><?php echo $res[$i]['semester']; ?></td><td><?php echo $res[$i]['year']; ?></td><td><?php echo $res[$i]['email']; ?></td></tr>
				
				
				<?php } }else{ ?>
				
				<tr><td colspan="2">Book not available</td></tr>
				
				<?php } ?>
				
				</table>
				
				<?php }else{	?>		
	  		<p></p>

			<?php } ?>
	  	</div>

		<?php
			require_once('rightNav.php');

		?>
	  	

  	</div>
	
	<?php if($_SESSION['type']==3){ ?>
	<script type="text/javascript">
			var loginfrmvalidator = new Validator("loginform");
			loginfrmvalidator.addValidation("search","req","Enter thesis title to search");
			</script>
			
	<?php } ?>		
    
<?php
	require_once('footer.php');

?>
