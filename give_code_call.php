<?php
session_start();
if(!isset($_SESSION['username']))
header("Location: index.php");
?>
<?php
	//$rater_id=$_SESSION['id'];
	function give_code($rater_id) {
    $out[0] = "1";
    $out[1] = "9999";
    $out[2] = '1212';
	$out[3] = "bubble_sort";
    $out[4] = "SolutionInJava";
    $out[5] = "Normal";
	$out[6] = "Java";
	$str = 
'#include <iostream> //For cout
#include <cstring>  //For the string functions
using namespace std;
int main()
{
  char name [20]
  cout<<"Please enter your name:";
  cin.getline ( name, 50 );
  if ( strcmp ( name, "George" } == 0 )
    cout<<"Thats my name. Keep?\n";
  else                                    // Not equal
    cout<<"You entered your name.\n";
  cout<<" Your name is " << strcat ( name ) << " and it is  " << strlen ( name ) << " letters long\n";
  cin.get();
}';
    //$encoded_str = base64_encode($str);
	$encoded_str=$str;
	echo $encoded_str.'<br/>';
    $out[7] = $encoded_str;
    $out[8] = "7890";
	$out[9] = "58";
    $out[10] = "someuidlcp";
    $out[11] = "O(n^3)";	
    return $out;
	}
    print_r($_SESSION);
	echo '<br/>';
	echo "username is ".$_SESSION['username']."<br/>";
	$data = give_code(0);
	echo $data[0];
	echo $data[1];
	echo $data[2];
	echo $data[3];
	echo $data[4];
	echo $data[5];
	echo $data[6];
	//$decoded_str = base64_decode($data[7]);
	$decoded_str = $data[7];
	echo '<br/>'.$decoded_str;
	echo $data[8];
	echo $data[9];
	echo $data[10];
	echo $data[11];
	$_SESSION['amcat_id']=$data[0];
	$_SESSION['tiosource']=$data[1];
	$_SESSION['ssid']=$data[2];
	$_SESSION['function_name']=$data[3];
	$_SESSION['class_name']=$data[4];
	$_SESSION['fk_type_id_aqt]]']=$data[5];
	$_SESSION['language']=$data[6];
	$_SESSION['source_code']=$decoded_str;;
	$_SESSION['uid_lcs']=$data[8];
	$_SESSION['total_pass_percent']=$data[9];
	$_SESSION['uid_lpc']=$data[10];
	$_SESSION['complexity']=$data[11];
	header("Location: assignment.php");	
?>
    

