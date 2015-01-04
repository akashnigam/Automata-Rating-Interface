<?php
session_start();
if(!isset($_SESSION['username']))
header("Location: index.php");
?>

<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
/*//echo "Data recieved is ".
$_POST['human_grades']." and ".
$_POST['algorithm']." and ".
$_POST['complexity']." and ".
$_POST['viewed_hint']." and ".
$_POST['time_spent']." and ".
$_POST['comment']."<br/><br/><br/>";

$str="Data recieved is ".
$_POST['human_grades']." and ".
$_POST['algorithm']." and ".
$_POST['complexity']." and ".
$_POST['viewed_hint']." and ".
$_POST['time_spent']." and ".
$_POST['comment']."at ".date('Y-m-d H:i:s')."\n";
$_SESSION['username']=$_SESSION['username'];*/

function write_log($msg,$type,$severity,$rater_user_name)
{
	////echo "<br/><br/>Inside write_log function <br/><br/>";
	$file="";
	if($type == 1)//info
	{
		$file="log/$rater_user_name/processing.log";	
		$str="<log>
<time>".date('Y-m-d H:i:s')."</time>
<msg>".$msg."</msg>
<severity>".$severity."</severity>
</log>\n\n";
	}
	else if($type == 2)//info
	{
		$file="log/$rater_user_name/request.log";		
		$str="<log>
<time>".date('Y-m-d H:i:s')."</time>
<msg>".$msg."</msg>
</log>\n\n";
	}
	if (!is_dir("log/".$rater_user_name)) // dir doesn't exist, make it
	{  
		mkdir("log/".$rater_user_name);
		chmod("log/".$rater_user_name, 511);
		////echo "<br/><br/>Directory does not exist creating directory<br/><br/>";
	}
	else
	{
		chmod("log/".$rater_user_name, 511);
		//echo "<br/><br/>Directory exists.<br/><br/>";
	}
	//echo "<br/><br/>file is ".$file."<br/><br/>";
	file_put_contents($file, $str , FILE_APPEND);
	chmod($file, 511);
}

function connect_database() 
{	
	$file = 'errors.log';
	$con=mysql_connect("localhost","akash","akash@123");
	if (!$con) 
	{		
		$msg='Could not connect: '. mysql_error();
		write_log($msg,1,2,$_SESSION['username']);
		die('Could not connect: ' . mysql_error());
	}
	$str='Localhost connected successfully at '.date('Y-m-d H:i:s')."\n";	
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
	$selectdb=mysql_select_db("automata_ratings");
	if (!$con) 
	{
		$msg='Could not select database: '. mysql_error();
		write_log($msg,1,2,$_SESSION['username']);
		die('Could not select database: ' . mysql_error());
	}
	$str='Database selected successfully at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
}

function update_Rater_table() 
{	
	$file = 'errors.log';
	$file_query = 'query.log';
	$query='UPDATE `rater` SET `no_of_graded_codes` = no_of_graded_codes +1 WHERE `user_name` = "'.$_SESSION['username'].'";';
	////echo '<br/>'.$query.'<br/>';
	$res=mysql_query($query);
	if (!$res) 
	{
		    $msg='No of graded codes not updated: '. mysql_error();
			write_log($msg,1,2,$_SESSION['username']);
			die('No of graded codes not updated: ' . mysql_error());
	}
	$str=$query.' executed at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
	//file_put_contents($file_query,$str, FILE_APPEND);	
	$str='rater table updated successfully at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
}
function get_reimbursement_id()
{
	$file = 'errors.log';
	$file_query = 'query.log';
	//return 0;
	$query="select reimbursement_id from rater where rater_id=".$_SESSION['rater_id'].";";
	//echo "<br/><br/> $query <br/><br/>";
	$res=mysql_query($query);
	if (!$res) 
	{
			$msg='No reimbursement_id found  '. mysql_error();
			write_log($msg,1,2,$_SESSION['username']);
			die('No reimbursement_id found : ' . mysql_error());
	}
	$count= mysql_num_rows($res);
	$reimbursement_id=0;
	if($count==1)
	{
		$row = mysql_fetch_array($res, MYSQL_ASSOC);
		$reimbursement_id=$row["reimbursement_id"];
		////echo $row["user_name"];
	}
	else
	{
		$msg='Database inconsistent  '. mysql_error();
		write_log($msg,1,2,$_SESSION['username']);
		die('Database inconsistent ' . mysql_error());
	}
	$str='Reimbursement ID is calculated '.$reimbursement_id.' at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
	////echo "<br/>Reimbursement ID calculated is ".$reimbursement_id."<br/>";
	return $reimbursement_id;
}

function update_graded_codes_table() 
{	
	$file = 'errors.log';
	$file_query = 'query.log';
	$rater_id=$_SESSION['rater_id'];
	$ssid=$_SESSION['ssid'];
	$uid_lcs=$_SESSION['uid_lcs'];
	$uid_lpc=$_SESSION['uid_lpc'];
	$source_code=$_SESSION['source_code'];
	$human_grades=$_POST['human_grades'];
	$algorithm=$_POST['algorithm'];
	$complexity=$_POST['complexity'];
	$comment=$_POST['comment'];
	$time_spent=$_POST['time_spent'];
	$date_time="CURRENT_TIMESTAMP";
	$reimbursement_id=get_reimbursement_id();
	$viewed_hint=$_POST['viewed_hint'];
	/*//echo "<br/><br/> rater_id=$rater_id <br/>";
	//echo "$ssid <br/>";
	//echo "$uid_lcs <br/>";
	//echo "$uid_lpc <br/>";
	//echo "$source_code <br/>";
	//echo "$human_grades <br/>";
	//echo "$algorithm <br/>";
	//echo "$complexity <br/>";
	//echo "$comment <br/>";
	//echo "$time_spent <br/>";
	//echo "$date_time <br/>";
	//echo "$reimbursement_id <br/>";
	//echo "$viewed_hint <br/>";*/
	$query="INSERT INTO `graded_codes` ( `rater_id_fk`, `ssid`, `uid_lcs`, `uid_lpc`, `code`, `grade`, `algo`,	`complexity`, `comment`,
	`time_spent`, `date_time`, `reimbursement_id`, `viewed_hint`) VALUES ('".$id."','".$ssid."', '".$uid_lcs."',
	'".$uid_lpc."' ,'".$source_code."', '".$human_grades."', '".$algorithm."', '".$complexity."', '".$comment."','".$time_spent."',
	".$date_time.",'".$reimbursement_id."','".$viewed_hint."');";
	////echo '<br/>'.$query.'<br/>';
	
	$res=mysql_query($query);
	if (!$res) 
	{
			$msg='grades_codes table not updated:  '. mysql_error();
			write_log($msg,1,2,$_SESSION['username']);
			die('grades_codes table not updated: ' . mysql_error());
	}
	$str=$query.' executed at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
	//file_put_contents($file_query,$str, FILE_APPEND);
	$str='graded_codes table updated successfully at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
	////echo 'graded_codes table updated successfully <br/>';
}

function update_rater_uid_lcs_table() 
{	
	$file = 'errors.log';
	$file_query = 'query.log';
	$query="UPDATE `rater_uid_lcs` SET  `status` = '1' WHERE  `rater_id` ='".$_SESSION['rater_id']."' AND `uid_lcs` ='".$_SESSION['uid_lcs']."';";
	////echo '<br/>'.$query.'<br/>';
	$res=mysql_query($query);
	if (!$res) 
	{
			$msg='rater_uid_lcs table not updated:  '. mysql_error();
			write_log($msg,1,2,$_SESSION['username']);
			die('rater_uid_lcs table not updated: ' . mysql_error());
	}
	$str=$query.' executed at '.date('Y-m-d H:i:s')."\n";
	//file_put_contents($file,$str, FILE_APPEND);
	//file_put_contents($file_query,$str, FILE_APPEND);
	write_log($str,1,0,$_SESSION['username']);
	$str='rater_uid_lcs table updated successfully at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
	////echo 'rater_uid_lcs table updated successfully<br/>';
}

function update_rater_ssid_table() 
{	
	$file = 'errors.log';
	$file_query = 'query.log';
	$query="UPDATE `rater_ssid` SET  `status` = '1' WHERE  `rater_id` ='".$_SESSION['rater_id']."' AND `ssid` ='".$_SESSION['ssid']."';";
	write_log($str,1,0,$_SESSION['username']);
	////echo '<br/>'.$query.'<br/>';
	$res=mysql_query($query);
	if (!$res) 
	{
			$msg='rater_ssid table not updated:  '. mysql_error();
			write_log($msg,1,2,$_SESSION['username']);
			die('rater_ssid table not updated: ' . mysql_error());
	}
	$str=$query.' executed at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
	//file_put_contents($file_query,$str, FILE_APPEND);
	$str='rater_ssid table updated successfully at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
	////echo 'rater_ssid table updated successfully<br/>';
}

function update_graded_ssid_table() 
{		
	$file = 'errors.log';
	$file_query = 'query.log';
	if($_SESSION['total_pass_percent']==0)
	$temp_str='`tc_0`=`tc_0`+1';
	else if($_SESSION['total_pass_percent']>=1 && $_SESSION['total_pass_percent']<=30)
	$temp_str='`tc_1_30`=`tc_1_30`+1';
	else if($_SESSION['total_pass_percent']>=31 && $_SESSION['total_pass_percent']<=60)
	$temp_str='`tc_31_60`=`tc_31_60`+1';
	else if($_SESSION['total_pass_percent']>=61 && $_SESSION['total_pass_percent']<=100)
	$temp_str='`tc_61_100`=`tc_1_100`+1';
	$query="UPDATE `graded_ssid` SET `no_of_graded_codes`=`no_of_graded_codes`+1 ,".$temp_str."  WHERE `ssid`= '".$_SESSION['ssid']."';";	
	////echo '<br/>'.$query.'<br/>';
	$res=mysql_query($query);
	if (!$res) 
	{
			$msg='graded_ssid table not updated:  '. mysql_error();
			write_log($msg,1,2,$_SESSION['username']);
			die('graded_ssid table not updated: ' . mysql_error());
	}
	$str=$query.' executed at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
	//file_put_contents($file_query,$str, FILE_APPEND);
	$str='graded_ssid table updated successfully at '.date('Y-m-d H:i:s')."\n";
	write_log($str,1,0,$_SESSION['username']);
	//file_put_contents($file,$str, FILE_APPEND);
	////echo 'graded_ssid table updated successfully<br/>';
}



//echo "<br/><br/>Calling function write log <br/><br/>";
//$_SESSION['username']=$_SESSION['username'];
$msg="array(";
foreach($_POST as $key => $value) 
{
	$msg=$msg."\"$key\"=>\"$value\",";
}
$msg=$msg.")";
//$msg=print_r ($_POST);

write_log($msg,2,0,$_SESSION['username']);

//$file = 'errors.log';
////echo "Going to write in a file ".$file.".<br/>";
//file_put_contents($file, $str , FILE_APPEND);
//file_put_contents("new.txt", "My first file write ");
////echo "Now check written or not <br/>";
//error_log("You messed up!", 3, "errors.log");



connect_database();
update_Rater_table();
update_graded_codes_table();
update_rater_uid_lcs_table(); 
update_rater_ssid_table();
update_graded_ssid_table();
header("Location: give_code_call.php");
die();
//session_destroy();
////echo "Session destroyed<br/>";
?>