<div class="rightColumn">
	<ul>
	  <?php if(!isset($_SESSION['id'])){ ?>
	  <li><a href="studentLogin.php">Student Login</a></li>
	  <li><a href="studentReg.php">Student Registration</a></li>
	  <li><a href="lecturerLogin.php">Lecturer Login</a></li>
	  <li><a href="lecturerReg.php">Lecturer Registration</a></li>
	  <li><a href="adminLogin.php">Admin Login</a></li>
	  <?php }else if($_SESSION['type']==1){ // admin menu here ?>
	  <li><a href="adminChangePwd.php">Change Password</a></li>
	  <li><a href="approveStudentReg.php">Approve Student Registration</a></li>
	  <li><a href="approveLecturerReg.php">Approve Lecturer Registration</a></li>
	  <li><a href="uploadAnnouncement.php">Upload Announcement</a></li>
	  <li><a href="logout.php">Logout</a></li>
	  <?php }else if($_SESSION['type']==3){  ?>
	  <li><a href="studentChangePwd.php">Change Password</a></li>
	  <li><a href="viewprofile.php">View Profile</a></li>
	  <li><a href="searchByCategory.php">Search By Category</a></li>
	  <li><a href="searchByTitle.php">Search By Title</a></li>
	  <li><a href="requestThesis.php">Request Thesis Book</a></li>
	  <li><a href="requestStatus.php">Request Status</a></li>
	  <li><a href="requestAppointment.php">Request Appointment</a></li>
	  <li><a href="appointmentStatus.php">Appointment Status</a></li>
	  <li><a href="logout.php">Logout</a></li>
	  <?php }else if($_SESSION['type']==2){ ?>
	  <li><a href="lecturerChangePwd.php">Change Password</a></li>
	  <li><a href="uploadthesis.php">Upload Thesis</a></li>
	  <li><a href="updateAppointment.php">View/Update Appointment</a></li>
	  <li><a href="updateRequest.php">View/Update Request</a></li>
	  <li><a href="viewBookReturn.php">View Book Return</a></li>
	  <li><a href="logout.php">Logout</a></li>
	  <?php } ?>	  
	  
	
	</ul>
</div>