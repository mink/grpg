<?PHP
//////////////YOUR CONFIGURATION VARIABLES/////////////////////

//This password allows this script to be processed and matches your password set at http://cpalead.com/iln.php
$YOURILNPASSWORD = "r00tb33r";

//This is your mysql settings to access your database
$mysql_where 		= "localhost";
$mysql_username 	= "titan5_myneocorp";
$mysql_password 	= "r00tb33r";

//This is your game database that will connect
$mysql_database 	= "titan5_myneocorp";

//**Also be sure to change the mysql command on line 79 to match your database!**


//////////////EXTRA VARIABLES//////////////////////////////////////////
//There are also a few extra variables that are passed if you need them for your tracking purposes.
//*campaign:	The name of the campaign the lead was generated for.
//						Example: [Email] [LookDog] $500 KMART Gift Card
//*sub:			Your subid you've added to the link in order to track your leads better.
//						Example: playerid5968
//*earn:			The amount you've made from generating the lead, in USD without the dollar sign.
//						Example: 1.15


//////////////////////////////////////////
/////// PASSWORD CONNECTION
//////////////////////////////////////////
// To prevent fraud, it is strongly recommended you use the password option when registering
// your ILN url at http://cpalead.com/iln.php
// Here is where you would check to make sure the password you entered is the one you registered
// at the site.

$password = $_POST['password'];
if ($password != $YOURILNPASSWORD)
{
	exit;
}

// First, we need to connect to the MySql database,
// Enter the code below to connect to
// the database that your game uses.

///////////////////////////////////////////
////////// MYSQL LOGIN   ////////////
//////////////////////////////////////////
mysql_connect($mysql_where,$mysql_username,$mysql_password);
mysql_select_db($mysql_database);

////////////////////////////////
///// Now that we are connected, we need to update the table
///// where your players are located, to give them whatever they
//// just earned. Using the $sub variable that is fed with the ID
//// username or anything you use to identify your players by.
////
//// If you got register_globals on, ignore the next step.
////////////////////////////////


////////////////////////////////
///                            Without register_globals
/// If you don't have your register_globals on for security or any other reason,
/// you will need to first enter the value into the $sub variable, our server sends
/// you the information using a simple html post, so you will need do something
/// like this. Additional variables tracked are campaign and earn.
////////////////////////////////
$sub = $_POST['sub'];

$campaign = $_POST['campaign'];
$earn = $_POST['earn'];
$earn = $earn * 200;


////////////////////////////////
/// Now we are all ready, we do a simple MySQL query to add the points or
/// whatever to the player, just edit it to fit your game
////////////////////////////////
mysql_query("UPDATE `grpgusers` SET points=points+'".$earn."' WHERE `id`='".$sub."'");

mysql_close();
?>
