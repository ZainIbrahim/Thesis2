<?php 
include_once('header.php');

include('Database.class.php');
$db	=	new Database;
$db->dbConnect();
	$sql = "select tr.id as updateId, t.*,s.uname,s.fname,tr.status,tr.created_date,tr.fine from thesis t, thesis_request tr, lecturer_registration r, student_registration s where tr.student_id=s.id and tr.thesis_id=t.id and t.supervisor_id=r.id and r.id=".$_SESSION['id'];
	//echo $sql;
	$books = $db->readValues($sql);
	
	
?>

<div class="columnsContainer">

	  	<div class="leftColumn">
	  		
			<table align="center">
				<tr>
					<td colspan="2" align="center"><h2>View Book Return And Fine</h2></td>
				</tr>
				
				<tr>
					<td colspan="2" align="center"><h5 style="color:red">Stated return duration is 10 days</h5></td>
				</tr>
				
			</table>
			<br></br>
			
			<?php if(count($books)>0){ ?>
			<form method="post" action="" name="loginform">
			
			<table align="center" cellpadding="5">
				<tr>
					<td>Student Metric. No</td><td>Student Name</td><td>Thesis ID</td><td>Thesis Title</td><td>Borrowed Date</td><td>Return Date</td><td>Fine Amount</td><td>Available</td>
				</tr>
				
				<?php 
				
				$rowIds	=	array();
				for($k=0;$k<count($books);$k++){ 
				
				$rowIds[]	=	$books[$k]['updateId']; 
				
				?>
				
				<tr>
					<td><?php echo $books[$k]['uname']; ?></td><td><?php echo $books[$k]['fname']; ?></td><td><?php echo $books[$k]['thesis_id']; ?></td><td><?php echo $books[$k]['title']; ?></td><td><?php echo $books[$k]['created_date']; ?></td><td><input type="text" name="return<?php echo $books[$k]['updateId']?>" id="return<?php echo $books[$k]['updateId']?>" onBlur="calFine(this.value,'<?php echo $books[$k]['created_date']; ?>',<?php echo $books[$k]['updateId']?>)"   <?php if($books[$k]['status']==0){ echo 'readonly'; } ?> ></td><td><div id="fine<?php echo $books[$k]['updateId']?>"><?php echo $books[$k]['fine']; ?></div></td><td><?php if($books[$k]['status']==0) echo 'Pending'; else echo 'Approved';?></td>
					
				</tr>
				<?php } ?>
				
				
			</table>
			
			</form>
			
		<?php 	} ?>
 			
		<div class="rightColum">
			<?php
				require_once('rightNav.php');

			?>
		</div>
	
	<script type="text/javascript">
	function calFine(returnDt, borrowDt, rowId){
		if (returnDt.length == 0) { 
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var tmp = this.responseText;
				var res = tmp.split(",");
				if(res[0]==-1){
					alert(res[1]);
				}
				else{
					document.getElementById('fine'+rowId).innerHTML	=	res[0];
					alert(res[1]);
				}
				
            }
        };
        xmlhttp.open("GET", "updateReturnFine.php?r=" + returnDt+'&b='+borrowDt+'&id='+rowId, true);
        xmlhttp.send();
    }
	}
	</script>
		
</div>
<?php 

require_once('footer.php');
?>
	