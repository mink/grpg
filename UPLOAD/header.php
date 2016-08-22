<?

/*
$color[0] = "#333";
$color[1] = "#ddd";
$color[2] = "#444";
$color[3] = "#ffffff";
$color[4] = "#111";
$color[5] = "#000000";
$color[6] = "#666666";
$color[7] = "#FFFF00";
$color[8] = "#1E1E1E";
$color[9] = "#ffcc00";
$color[10] = "#4d75a0";
$color[11] = "#7d9fc4";
$color[12] = "#FFFF33";
*/
session_start();

if (!isset($_SESSION['id'])){

	include('home.php');

	die();

}

include 'dbcon.php';

include 'classes.php';

include 'updates.php';

if ($_GET['action'] == "logout"){

	session_destroy();

	die('You have been logged out.<meta http-equiv="refresh" content="0;url=index.php">');

}



function microtime_float()

{

 $time = microtime();

 return (double)substr( $time, 11 ) + (double)substr( $time, 0, 8 );

}



microtime_float();

$starttime = microtime_float();



if (Is_User_Banned($_SESSION['id']) == 1){

	echo "<h1>" . Why_Is_User_Banned($_SESSION['id']) . "</h1>";

	die();

}

$user_class = new User($_SESSION['id']);

// get style info
$cresult = mysql_query("SELECT `value` FROM `styles` WHERE `style`='".$user_class->style."'");
$i = 0;
while($line = mysql_fetch_array($cresult, MYSQL_ASSOC)) {
	$color[$i] = $line['value'];
	$i++;
}
//get style info

$result = mysql_query("SELECT * FROM `serverconfig`");
$worked = mysql_fetch_array($result);
if($worked['serverdown'] != "" && $user_class->admin != 1){
	die("<h1><font color='red'>SERVER DOWN<br><br>".$worked['serverdown']."</font></h1>");
}

$time = date(F." ".d.", ".Y." ".g.":".i.":".sa,time());

$result = mysql_query("UPDATE `grpgusers` SET `lastactive` = '".time()."', `ip` = '".$_SERVER['REMOTE_ADDR']."' WHERE `id`='".$_SESSION['id']."'");


function callback($buffer){ 
  $user_class = new User($_SESSION['id']);

  $checkhosp = mysql_query("SELECT * FROM `grpgusers` WHERE `hospital`!='0'");
  $nummsgs = mysql_num_rows($checkhosp);
  $hospital = "[".$nummsgs."]";
  
  $checkjail = mysql_query("SELECT * FROM `grpgusers` WHERE `jail`!='0'");
  $nummsgs = mysql_num_rows($checkjail);
  $jail = "[".$nummsgs."]";
  
  $checkmail = mysql_query("SELECT * FROM `pms` WHERE `to`='$user_class->username' and `viewed`='1'");
  $nummsgs = mysql_num_rows($checkmail);
  $mail = "[".$nummsgs."]";
  
  $checkmail = mysql_query("SELECT * FROM `events` WHERE `to`='$user_class->id' and `viewed` = '1'");
  $numevents = mysql_num_rows($checkmail);
  $events = "[".$numevents."]";
  
	$result = mysql_query("SELECT * from `effects` WHERE `userid`='".$user_class->id."'");
	if (mysql_num_rows($result) != 0){
		$effects = '<div class="headbox">Current Effects</div>';
		while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	         $effects .= '<a class="leftmenu" href="effects.php?view='.$line['effect'].'">'.$line['effect']." (".floor($line['timeleft']).")".'</a></ul><br />';
		}
	}

  $out = $buffer;
  $out = str_replace("<!_-money-_!>", $user_class->money, $out);
  $out = str_replace("<!_-formhp-_!>", $user_class->formattedhp, $out);
  $out = str_replace("<!_-hpperc-_!>", $user_class->hppercent, $out);
  $out = str_replace("<!_-formenergy-_!>", $user_class->formattedenergy, $out);
  $out = str_replace("<!_-energyperc-_!>", $user_class->energypercent, $out);
  $out = str_replace("<!_-formawake-_!>", $user_class->formattedawake, $out);
  $out = str_replace("<!_-awakeperc-_!>", $user_class->awakepercent, $out);
  $out = str_replace("<!_-formnerve-_!>", $user_class->formattednerve, $out);
  $out = str_replace("<!_-nerveperc-_!>", $user_class->nervepercent, $out);
  $out = str_replace("<!_-points-_!>", $user_class->points, $out);
  $out = str_replace("<!_-level-_!>", $user_class->level, $out);
  $out = str_replace("<!_-hospital-_!>", $hospital, $out);
  $out = str_replace("<!_-jail-_!>", $jail, $out);
  $out = str_replace("<!_-mail-_!>", $mail, $out);
  $out = str_replace("<!_-events-_!>", $events, $out);
  $out = str_replace("<!_-effects-_!>", $effects, $out);
  $out = str_replace("<!_-cityname-_!>", $user_class->cityname, $out);
  
  return $out;
}

ob_start("callback");


?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>

<title>The Generic RPG</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
.leftmenu {
margin-left: 8px;

background-color : <?= $color[0] ?>;

border : 1px solid <?= $color[2] ?>;

color : <?= $color[3] ?>; 

display : block; 

padding-top : 2px; 

padding-right : 2px; 

padding-bottom : 2px; 

padding-left : 2px; 

border-style : solid; 

border-top-width : 0; 

border-right-width : 1px; 

border-bottom-width : 1px; 

border-left-width : 1px; 

width : 145px; 

font-weight : normal; 

text-align : left; 

} 

.gap { line-height: 3px; }



.topbar { width: 100%;

	margin-left: 8px;

	margin-right: 8px;

	margin-top: 8px;

	background-color: <?= $color[0] ?>;

	border: 1px solid <?= $color[2] ?>;

	padding: 3px;

	color: <?= $color[1] ?>;

	font-weight: bold;

	font-size: 11px; }

	

	

	

.content { width: 100%;

	padding: 0px; }



.contenthead { background-color: <?= $color[4] ?>;

	border: 1px solid <?= $color[2] ?>;

	padding: 5px;

	color: <?= $color[1] ?>;

	font-weight: bold;

	font-size: 12px; }



.contentcontent { background-color: <?= $color[0] ?>;

	border: 1px solid <?= $color[2] ?>;

	padding: 3px;

	color: <?= $color[1] ?>;

	font-size: 11px; }





.bar_a{

	width: 100px;

	border: 1px solid <?= $color[5] ?>;

	background-color:<?= $color[6] ?>;

}

.bar_b{

	font-size: 10px;

	background-color:<?= $color[7] ?>;

}





body {

margin: auto;

border: 1px solid <?= $color[10] ?>;

width: 828px;

background-color: <?= $color[5] ?>;

font-family : Arial, Helvetica, sans-serif; 

font-weight : normal; 

} 





h1 , h2 , h3 , h4 , h5 , h6 {

font-family : "Trebuchet MS", Verdana, "Lucida Sans", Arial, Geneva, Helvetica, Helv, "Myriad Web", Syntax, sans-serif; 

font-weight : normal; 

} 



.head, .headbox , .dynabox , a.leftmenu , a.topmenu {

margin-left: 8px;

font-weight : bold; 

text-decoration : none; 

font-size : 80%; 

font-family : Verdana, "Lucida Sans", Arial, Geneva, Helvetica, Helv, "Myriad Web", Syntax, sans-serif; 

} 



a 																	{color : <?= $color[5] ?>; } 

.body a:hover, .dynabox .headbox a:hover							{color : <?= $color[3] ?>; }



.pos0														{background-color : <?= $color[3] ?>; color : <?= $color[5] ?>; } 

.pos1 {background-color : <?= $color[8] ?>;}

.mainbox , .dynabox , a.leftmenu:link , a.leftmenu:visited 	{background-color : <?= $color[0] ?>; border : 1px solid <?= $color[2] ?>; color : <?= $color[3] ?>; } 

.pos2 , .topnav , a.leftmenu:hover 									{background-color : <?= $color[0] ?>; color : <?= $color[9] ?>; border : 1px solid <?= $color[2] ?>; }





.neg0 																{background-color : <?= $color[5] ?>; } 

.neg1 , a.topmenu:hover												{background-color : <?= $color[10] ?>; color : <?= $color[3] ?>; border : <?= $color[5] ?>; } 

.neg2 , .headbox , a.topmenu:link , a.topmenu:visited 				{background-color : <?= $color[11] ?>; color : <?= $color[3] ?>; border : <?= $color[5] ?>; } 



a.leftmenu:link {

display : block; 

padding-top : 2px; 

padding-right : 2px; 

padding-bottom : 2px; 

padding-left : 2px; 

border-style : solid; 

border-top-width : 0; 

border-right-width : 1px; 

border-bottom-width : 1px; 

border-left-width : 1px; 

width : 145px; 

font-weight : normal; 

text-align : left; 

} 



a.leftmenu:hover {

display : block; 

padding-top : 2px; 

padding-right : 2px; 

padding-bottom : 2px; 

padding-left : 2px; 

border-style : solid; 

border-top-width : 0; 

border-right-width : 1px; 

border-bottom-width : 1px; 

border-left-width : 1px; 

width : 145px; 

font-weight : normal; 

text-align : left; 

} 



a.leftmenu:visited {

display : block; 

padding-top : 2px; 

padding-right : 2px; 

padding-bottom : 2px; 

padding-left : 2px; 

border-style : solid; 

border-top-width : 0; 

border-right-width : 1px; 

border-bottom-width : 1px; 

border-left-width : 1px; 

width : 145px; 

font-weight : normal; 

text-align : left; 

} 



a.topmenu:link {

display : inline; 

padding-top : 5px; 

padding-right : 0; 

padding-bottom : 5px; 

padding-left : 0; 

border-style : solid; 

border-top-width : 0; 

border-right-width : 0; 

border-bottom-width : 0; 

border-left-width : 1px; 

text-align : center;  

} 



a.topmenu:hover {

background-color : <?= $color[10] ?>; 

display : inline; 

padding-top : 5px; 

padding-right : 0; 

padding-bottom : 5px; 

padding-left : 0; 

border-style : solid; 

border-top-width : 0; 

border-right-width : 0; 

border-bottom-width : 0; 

border-left-width : 1px; 

text-align : center; 

} 



a.topmenu:visited {

display : inline; 

padding-top : 5px; 

padding-right : 0; 

padding-bottom : 5px; 

padding-left : 0; 

border-style : solid; 

border-top-width : 0; 

border-right-width : 0; 

border-bottom-width : 0; 

border-left-width : 1px; 

text-align : center; 

} 



.headbox {



background-color: <?= $color[4] ?>;

border: 1px solid <?= $color[2] ?>;

padding: 5px;

color: <?= $color[1] ?>;



display : block; 

padding: 5;

width : 139px; 

text-align : left; 

} 



.topbox {

margin-left: 8px;

margin-right: 8px;

margin-top: 8px;

color: <?= $color[3] ?>;

border: 1px solid <?= $color[2] ?>;

background-color: <?= $color[11] ?>; 

height : 158px; 



padding-right : 5px; 

padding-bottom : 0; 

} 



.topnav {

border : solid ; 

border-width : 0 1px 1px; 

padding-top : 3px;

padding-bottom : 0; 

} 



.mainbox {

border: none;
background-color: <?= $color[8] ?>;

border-width : 1px 0 1px 1px; 

padding-top : 5px; 

padding-left : 5px; 

padding-right : 5px; 

padding-bottom : 5px; 

} 



.mainbox p a {

font-weight : bold; 

font-size : 90%; 

} 



.dynabox {

border: 1px solid <?= $color[0] ?>;

text-align : center; 

} 



.dynabox .headbox {

border-style : dashed; 

border-top-style : solid; 

border-right-width : 0; 

border-left-width : 0; 

padding-top : 3px; 

padding-left : 0; 

padding-right : 0; 

padding-bottom : 3px; 

} 



.dynacontent {

padding-top : 3px; 

padding-left : 5px; 

padding-right : 5px; 

padding-bottom : 3px; 

text-align : left; 

font-size : 70%; 

font-weight : normal; 

} 



a{

	color: <?= $color[9] ?>;

}

a:hover{

	color: <?= $color[12] ?>;

}


.style1 {color: #BDBDBD}
</style>
</head>
<body>
<table bgcolor="<?= $color[8] ?>" border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
  <td>
	<!--<img src="images/forconor[1]-1.png" />-->

	  <table class="topbar">
	<tr>
		<td>
			> Server Time: <? echo $time; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="refer.php">Refer For Points</a> | <a href="rmstore.php">Upgrade Account</a> | <a href="vote.php">Vote To Recieve Points</a>		</td>
	</tr>
	</table>
</td>
</tr>
<tr>
    <td colspan="3" class="pos1" height="55" valign="middle">
      <div class="topbox">
	  	  <table width='800'>
        <tr>
          <td width="50%"><img src="images/logo.png" /> </td>
          <td width="30%"> [<? echo $user_class->id; ?>] <a href='profiles.php?id=<? echo $_SESSION['id'] ?>'><? echo $user_class->formattedname; ?></a><br />
            Level:
            <!_-level-_!>
            <br />
            Money: $
            <!_-money-_!>
            <a href = "sendmoney.php">[Send]</a> <br />
            Points:
            <!_-points-_!>
            <a href = "spendpoints.php">[Spend]</a> <a href = "sendpoints.php">[Send]</a> </td>
          <td width="20%"> HP:
            <div class="bar_a" title="<!_-formhp-_!>">
              <div class="bar_b" style="width: <!_-hpperc-_!>%;" title="<!_-formhp-_!>">&nbsp;</div>
            </div>
            <a title = 'Refill this bar' href='spendpoints.php?spend=energy'>Energy</a>:
            <div class="bar_a" title="<!_-formenergy-_!>">
              <div class="bar_b" style="width: <!_-energyperc-_!>%;" title="<!_-formenergy-_!>">&nbsp;</div>
            </div>
            Awake:
            <div class="bar_a" title="<!_-formawake-_!>">
              <div class="bar_b" style="width: <!_-awakeperc-_!>%;" title="<!_-formawake-_!>">&nbsp;</div>
            </div>
            <a title = 'Refill this bar' href='spendpoints.php?spend=nerve'>Nerve</a>:
            <div class="bar_a" title="<!_-formnerve-_!>">
              <div class="bar_b" style="width: <!_-nerveperc-_!>%;" title="<!_-formnerve-_!>">&nbsp;</div>
            </div></td>
        </tr>
      </table>
	  </div>
    </td>
  </tr>
 
<tr><td>
	<table class="topbar">
	<tr>
		<td>
		<?
		$result = mysql_query("SELECT * from `serverconfig`");
        $worked = mysql_fetch_array($result);
		$messagetext = str_replace("^","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$worked['messagefromadmin']);
		echo "<marquee scrollamount='3'>".$messagetext."</marquee>";
		?>
		</td>
	</tr>
	</table>
</td>
</tr>
  

  <tr>
    <td>	
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top" width="150">
		  <div style="height:7px;"></div>
		  	<div>
			
		 <?= ($user_class->admin == 1) ? '
		 <div class="headbox">Control Panel</div>
			  <a class="leftmenu" href="control.php">Marquee/Maintenance</a>
			  <a class="leftmenu" href="control.php?page=rmoptions">RM Options</a>
			  <a class="leftmenu" href="control.php?page=setplayerstatus">Player Options</a>
			  <a class="leftmenu" href="massmail.php">Mass Mail</a>
			  <a class="leftmenu" href="control.php?page=referrals">Manage Referrals</a>
		</div><br>
		 <div class="headbox">Game Modification</div>
			  <a class="leftmenu" href="control.php?page=crimes">Manage Crimes</a>
			  <a class="leftmenu" href="control.php?page=cities">Manage Cities</a>
			  <a class="leftmenu" href="control.php?page=jobs">Manage Jobs</a>
			  <a class="leftmenu" href="control.php?page=playeritems">Manage Items</a>
		  </div>
		  <br />
		 ' : "" ?>	

			
          	  <div class="headbox">Menu</div>
			 <a href="index.php" class="leftmenu style1">Home</a>
			  <a class="leftmenu" href="city.php"><!_-cityname-_!></a>
			  <a href="todo.php" class="leftmenu">Publius's To-Do List</a>
			  <a class="leftmenu" href="offers.php" target="_blank">Get Free Points</a>
			  <a class="leftmenu" href="classifieds.php">Classified Ads</a>
			  <a class="leftmenu" href="inventory.php">Inventory</a>
			  <a class="leftmenu" href="bank.php">Bank</a>
			  <a class="leftmenu" href="<? echo ($user_class->gang == 0) ? "creategang.php" : "gang.php"; ?>">Your Gang</a>
			  <a class="leftmenu" href="gym.php">Gym</a>
			  <a class="leftmenu" href="hospital.php">Hospital <!_-hospital-_!></a>

			  <a class="leftmenu" href="jail.php">Jail <!_-jail-_!></a>
			  <a class="leftmenu" href="pms.php">Mailbox <!_-mail-_!></a>
			  <a class="leftmenu" href="events.php">Events <!_-events-_!></a>
			  <a class="leftmenu" href="crime.php">Crime</a>
			  <a class="leftmenu" href="http://www.thegrpg.com/forum/index.php?topic=78.0" target="_blank">IRC Chatroom (connection tutorial)</a>
            <a class="leftmenu" href="http://forum.thegrpg.com/" target="_blank">Forums</a>
			<a class="leftmenu" href="http://bourbanlegends.com/wiki" target="_blank">Manual/Wiki</a>
			<a class="leftmenu" href="rmstore.php">RM Store</a>
		 </ul>
		 
		 <br />
			 <div class="headbox">Account</div>
			  <a class="leftmenu" href="index.php?action=logout">Logout</a>
			  <a class="leftmenu" href="preferences.php">Change Preferences</a>
			  <a class="leftmenu" href="cpassword.php">Change Password</a>
			  <a class="leftmenu" href="changestyle.php">Change Color Scheme</a>			  
		  </div>
		  <br />
		
		
<!_-effects-_!>
		 <!--<div class="headbox">Advertisement</div>
		 <?
		 $randnum = rand(1,3);
		 $advert = ($randnum == 1) ? "images/rmgunad.png" : $advert;
		 $link = ($randnum == 1) ? "rmstore.php" : $link;
		 $advert = ($randnum == 2) ? "images/rmad.PNG" : $advert;
		 $link = ($randnum == 2) ? "rmstore.php" : $link;
		 $advert = ($randnum == 3) ? "images/bobscarlot.png" : $advert;
		 $link = ($randnum == 3) ? "carlot.php" : $link;
		 ?>
		 <a class="leftmenu" href="<?= $link ?>"><img style="border:none;" src='<?= $advert ?>' /></a>
		 </div> -->
		 <div class="headbox">Support GRPG</div>
		 	<div align="center" class="leftmenu">
			<center>
			<script type="text/javascript"><!--
google_ad_client = "pub-0905156377500300";
google_ad_width = 125;
google_ad_height = 125;
google_ad_format = "125x125_as";
google_ad_type = "text";
//2007-08-28: grpg
google_ad_channel = "8497905351";
google_color_border = "000000";
google_color_bg = "333333";
google_color_link = "FFCC00";
google_color_text = "FFFFFF";
google_color_url = "FFCC00";
google_ui_features = "rc:10";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
			</center>
			</div>
          </td>
          <td valign="top">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td width="10"></td>
                <td valign="top" class="mainbox">

<table class="content">
<?
if ($user_class->admin == 1 || $user_class->rmdays > 0){
} else {
?>
		<tr><td class="contentcontent">
		<center>
<script type="text/javascript"><!--
google_ad_client = "pub-0905156377500300";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text_image";
//2007-07-25: grpg
google_ad_channel = "8497905351";
google_color_border = "000000";
google_color_bg = "333333";
google_color_link = "ffcc00";
google_color_text = "FFFFFF";
google_color_url = "ffcc00";
google_ui_features = "rc:10";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
		</center>

		</td></tr>

    <?php
}

    //echo ($user_class->admin == 1) ? "Admin Toolbar<br>"."<a href='" . "http://bourbanlegends.com/grpg" . $_SERVER['PHP_SELF']."?hackthegibson=iamgayandwantfullhealth'>Full Health</a>"." | <a href='" . "http://bourbanlegends.com/grpg" . $_SERVER['PHP_SELF']."?hackthegibson=iamgayandwantfullnerve'>Full Nerve</a>" . " | <a href='" . "http://bourbanlegends.com/grpg" . $_SERVER['PHP_SELF']."?hackthegibson=iamgayandwantoutofthehospital'>Get Out Of Hospital</a>" . " | <a href='" . "http://bourbanlegends.com/grpg" . $_SERVER['PHP_SELF']."?hackthegibson=iamgayandwantfullenergy'>Full Energy</a>" : "";


	//echo ($user_class->admin > 0) ? "<tr><td class='contenthead'>DJ Toolbar</td></tr><tr><td class='contentcontent' align='center'><a href='staff.php?radio=on'>Turn Radio On</a> | <a href='staff.php?radio=off'>Turn Radio Off</a> | <a href='staff.php?random=person'>Pick A Random Player</a></td></tr>" : "";

		$result = mysql_query("SELECT * FROM `ganginvites` WHERE `username` = '$user_class->username'");
		//$invites_exist = mysql_num_rows($result);

		if (mysql_num_rows($result) > 0){
			$invite_class = New Gang($line['gangid']);
		echo "<tr><td class='contentcontent'>You have new gang invitatations <a href='ganginvites.php'>View Gang Invites</a></td></tr>";
		}
		if ($user_class->level == 1){
			echo Message("It looks like you are a new player. Please check out the <a href='http://bourbanlegends.com/wiki/index.php?title=Newb_Tutorial'>New Player Tutorial</a>");
		}
		
	 	if ($user_class->jail > 0){
			echo "<tr><td class='contenthead'>Jail</td></tr><tr><td class='contentcontent' align='center'>You are currenty in jail for " . floor($user_class->jail / 60) . " more minutes.</td></tr>";
			include 'footer.php';
			die();
		}
		if ($user_class->hospital > 0){
			echo "<tr><td class='contenthead'>Hospital</td></tr><tr><td class='contentcontent' align='center'>You are in the hospital for " . floor($user_class->hospital / 60) . " more minutes.</td></tr>";
			include 'footer.php';
			die();
		}
?>
