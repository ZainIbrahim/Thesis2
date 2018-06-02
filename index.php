<?php
require_once('header.php');
if(isset($_SESSION['id'])){
	header('Location:home.php');exit;
}

?>

  	<div class="columnsContainer">

	  	<div class="leftColumn" style="width:100%">
	  		<h2>Welcome <?php if($_SESSION['type']==1){ echo 'Admin'; }else if($_SESSION['type']==2){ echo 'Lecturer'; }else if($_SESSION['type']==3){ echo 'Student';}else{ echo '...';}?></h2>

	  		<p></p>

	  	</div>

  	</div>
    
<?php
	require_once('footer.php');

?>