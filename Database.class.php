<?php 
class Database
{
	private 	$mysqli; 
	private 	$HostName;
	private		$UserName;
	private		$Password;
	private		$DatabaseName;
	public		$ErrorInfo;
		 		
	public function __construct()
	{
	
		$this->HostName   = 'localhost';
	    
		$this->UserName   = 'root';
	    $this->Password   = '';
	    $this->DatabaseName  = 'thesis2';
		
	}
		
		
	#	The following method establish a connection with the database server and on success return TRUE, on failure return FALSE
	#	On failure ErrorInfo property contains the error information.
	public function dbConnect(){
		$this->mysqli 	= 	mysql_connect($this->HostName, $this->UserName, $this->Password);
		if(!$this->mysqli) { 
			$this->ErrorInfo	=	mysql_error();
			return FALSE;
		} else {
		
			mysql_select_db($this->DatabaseName);

			return TRUE;
	
		}
	} # Close method dbConnect
	
	public function dbClose()
	{
		mysql_close($this->mysqli);
		
		
	} # Close method dbClose
	
	# On insert, update it returns TRUE,  and on select it returns result set object
	public function setQuery($Query)
	{
		$ExecStatus		=	mysql_query($Query);
		if($ExecStatus	===	FALSE) {
			$this->ErrorInfo	=	mysql_error();
			return FALSE;
		} else {
			return $ExecStatus;
		} 
	} # Close method setQuery			
		
		
	
	
	# On Success returns number of records corresponding to the query, else return 0	
	public function numberOfRecords($Query)
	{

	
		$RowCount	=	0;
		$ResultSet	=	mysql_query($Query);
		if($ResultSet) {
			$RowCount	=	 mysql_num_rows($ResultSet);
			//$ResultSet	->	free();
			return $RowCount;
		} else {
			$this->ErrorInfo	=	mysql_error();
			return $RowCount;
		}
	} # Close numberOfRecords method
	
	
	# Returns an array of rows in the result set
	public function readValues($Query)
	{
	      //echo $Query;exit;
		
		$ResultData		=	array();
		$ResultSet		=	mysql_query($Query);
		
		if($ResultSet) {
			
			$RowCount		=	mysql_num_rows($ResultSet);

			for($i=0; $i<$RowCount; $i++)
				$ResultData[$i]	=	mysql_fetch_array($ResultSet); 	
			//$ResultSet	->	free();
			
			return $ResultData;
			
			
		} else {
				
			$this->ErrorInfo	=	mysql_error();
			return $this->ErrorInfo;
		}	
	} # Close method readValues
	
	public function  fetchAssoc($Query)
	{
		
		$ResultData		=	array();
		$ResultSet		=	mysql_query($Query);
		
		if($ResultSet) {
			
			$RowCount		=	mysql_num_rows($ResultSet);

			for($i=0; $i<$RowCount; $i++)
				$ResultData[$i]	=	mysql_fetch_assoc($ResultSet); 	
			//$ResultSet	->	free();
			return $ResultData;
		} else {
				
			$this->ErrorInfo	=	mysql_error();
			return $this->ErrorInfo;
		}	
	} # Close method readValues

	# Return a single row 
	public function readValue($Query)
	{
		$ResultData		=	array();
		$ResultSet		=	mysql_query($Query);
		
		if($ResultSet) {
			$ResultData[0]	=	mysql_fetch_array($ResultSet); 	
			//$ResultSet	->	free();
			
			return $ResultData[0];
		} else {
			$this->ErrorInfo	=	mysql_error();

			echo $this->ErrorInfo;
			return $this->ErrorInfo;
		}		
	} # Close method readValue

	# Method to execute Stored Procedures with return value
	public function execProc($qry)
	{
		$result = mysql_query($qry) or die("Error" . mysql_error());
		if($result) {
			$row = mysql_fetch_array($result);
			return $row;
			//$result->free();
		} else { 
			$this->ErrorInfo	=	mysql_error();
			return $result;
		}
	}
	# Method returns the last insert Id of this connection	
	public function getInsertId()
	{
		return mysql_insert_id();
	}
	
	function generatePassword ($length = 8){

			  // start with a blank password
			  $password = "";
			  // define possible characters
			  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
			  // set up a counter
			  $i = 0; 
			  // add random characters to $password until $length is reached
			  while ($i < $length) { 
						// pick a random character from the possible ones
						$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
						// we don't want this character if it's already in the password
						if (!strstr($password, $char)) { 
						  $password .= $char;
						  $i++;
						}
			  }
			  // done!
			  return $password;

    }
	
	public function smtpConnection() {
		
		ini_set("SMTP", SMTP_SERVER);
		ini_set("smtp_port", SMTP_SERVER_PORT);
		ini_set("sendmail_from",SITE_EMAIL);
		
		/*$tval=30;
		$errno='';
		$errstr='';
	
		$smtp_conn=@fsockopen(SMTP_SERVER,    # the host of the server
		SMTP_SERVER_PORT,    # the port to use
		$errno,   # error number if any
		$errstr,  # error message if any
		$tval);   # give up after ? secs
		# verify we connected properly*/
	}
} # Close class definition
?>