<?php 
include_once('header.php');

include('Database.class.php');
$db	=	new Database;
$db->dbConnect();
	$sql = "select t.*,r.fname,tr.status from thesis t, thesis_request tr, lecturer_registration r where tr.thesis_id=t.id and t.supervisor_id=r.id and tr.student_id=".$_SESSION['id'];
	$books = $db->readValues($sql);




?>

<div class="columnsContainer">

	  	<div class="leftColumn">
	  		
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Check Request Thesis Book Status</h2></td>
				</tr>
				
			</table>
			<br></br>
			
			<?php if(count($books)>0){ ?>
			<form method="post" action="" name="loginform">
			
			<table align="center" cellpadding="5">
				<tr>
					<td>Thesis ID</td><td>Thesis Title</td><td>Author</td><td>Year</td><td>Semester</td><td>Supervisor</td><td>Status</td>
				</tr>
				
				<?php for($k=0;$k<count($books);$k++){ ?>
				
				<tr>
					<td><?php echo $books[$k]['thesis_id']; ?></td><td><?php echo $books[$k]['title']; ?></td><td><?php echo $books[$k]['author']; ?></td><td><?php echo $books[$k]['year']; ?></td><td><?php echo $books[$k]['semester']; ?></td><td><?php echo $books[$k]['fname']; ?></td><td><?php if($books[$k]['status']==0) echo 'Pending'; else echo 'Approved';?></td>
				</tr>
				<?php } ?>
				
				<tr><td><input type="button" name="submit" value="Print" onClick="window.print();"></td></tr>
				
			</table>
			
			</form>
			
		<?php 	} ?>
 			
		<div class="rightColum">
			<?php
				require_once('rightNav.php');

			?>
		</div>

		
</div>
<?php 

require_once('footer.php');
?>
	