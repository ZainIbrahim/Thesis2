<?php 
include_once('header.php');

include('Database.class.php');
$db	=	new Database;
$db->dbConnect();
	$sql = "select t.*,r.fname,tr.status from thesis t, thesis_request tr, lecturer_registration r where tr.thesis_id=t.id and t.supervisor_id=r.id";
	//echo $sql;
	$books = $db->readValues($sql);
	
	
	if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	{
		$list = isset($_POST['request'])?$_POST['request']:array();
		
		for($i=0;$i<count($books);$i++){
		
			$status = 0;
			$id = $books[$i]['id'];
			for($k=0;$k<count($list);$k++){
			
				if($books[$i]['id']==$list[$k]){
					
					$status	=	1;
					break;
					
				}
				
			}
			
			$sql ="update thesis_request set status=$status where id=$id";
			$db->setQuery($sql);
		}
		
		echo '<script>alert("Status updated");window.location.href="updateRequest.php";</script>';

	
	}




?>

<div class="columnsContainer">

	  	<div class="leftColumn">
	  		
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>Update Request Thesis Book Status</h2></td>
				</tr>
				
			</table>
			<br></br>
			
			<?php if(count($books)>0){ ?>
			<form method="post" action="" name="loginform">
			
			<table align="center" cellpadding="5">
				<tr>
					<td>Thesis ID</td><td>Thesis Title</td><td>Author</td><td>Year</td><td>Semester</td><td>Supervisor</td><td>Status</td><td>Approve</td>
				</tr>
				
				<?php for($k=0;$k<count($books);$k++){ ?>
				
				<tr>
					<td><?php echo $books[$k]['thesis_id']; ?></td><td><?php echo $books[$k]['title']; ?></td><td><?php echo $books[$k]['author']; ?></td><td><?php echo $books[$k]['year']; ?></td><td><?php echo $books[$k]['semester']; ?></td><td><?php echo $books[$k]['fname']; ?></td><td><?php if($books[$k]['status']==0) echo 'Pending'; else echo 'Approved';?></td>
					<td><input type="checkbox" name="request[]" value="<?php echo $books[$k]['id']; ?>" <?php if($books[$k]['status']) echo 'checked'; ?>></td>
				</tr>
				<?php } ?>
				
				<tr><td><input type="submit" name="submit" value="Submit"></td></tr>
			
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
	