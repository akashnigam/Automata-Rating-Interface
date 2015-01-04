<?php
session_start();
?>
        
<?php
	 echo "Data recieved is ".$_POST['username']." and ".$_POST['password']."<br/>";
	 $con=mysql_connect("localhost","akash","akash@123");
	 if (!$con) {
				die('Could not connect: ' . mysql_error());
	 }
	 echo 'Connected successfully';
	 $selectdb=mysql_select_db("automata_ratings");
	 if (!$con) {
				die('Could not select database: ' . mysql_error());
	 }
	 echo 'database selected successfully';
	 $username=$_POST['username'];
	 $password=$_POST['password'];
	 $query="select * from rater where user_name='$username' and password='$password' ";
	 $res=mysql_query($query);
	 $count= mysql_num_rows($res);
	 if($count>=1)
	 {
		 $row = mysql_fetch_array($res, MYSQL_ASSOC);
		 session_start();
		 $_SESSION['username']=$row["user_name"];
		 $_SESSION['rater_id']=$row["rater_id"];
		 echo "Session is set";
		 //sleep(5);
		 unset($_SESSION['errors']);
		 header("Location: give_code_call.php");	
		 
	 }
	 else{
		 $message='Either username or password is incorrect';
		 echo "Session not set";
		 //sleep(5);
		 $_SESSION['errors']=1;
	     header("Location: index.php"); 		 
	 } 
	 mysql_close($con);
?>