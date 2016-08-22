<?

session_start();

include 'dbcon.php';

include 'classes.php';

$time = date(F." ".d.", ".Y." ".g.":".i.":".sa,time());

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>

<title>The Generic RPG</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" href="style.css" type="text/css" />

</head>



<body>

<center>

<table bgcolor="#1E1E1E" border="0" cellspacing="0" cellpadding="0" width="100%">

<tr><td>

	<table class="topbar">

	<tr>

		<td>



			> Server Time: <?= $time; ?>



		</td>

	</tr>

	</table>

</td>

</tr>

<tr>

    <td colspan="3" class="pos1" height="55" valign="middle">

      <div class="topbox">



      	<table width='800'>

	  		<tr>

	  			<td width="50%">

	  				<img src="images/logo.png">

	  			</td>

	  			<td width="50%">





	  		<font color="#FFCC00"><p>Welcome to Generic RPG, the mafia-style browser based RPG where the fun never ends...</p></font>

	  			</td>

	  		</tr>

	</table>



      </div>

    </td>

  </tr>

  <tr>

    <td>

      <table width="100%" border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td valign="top" width="150"> <br />

		  	<div>

          	  <div class="headbox">Menu</div>

			  <a class="leftmenu" href="index.php">Home</a>

			  <a class="leftmenu" href="login.php">Login</a>

              <a class="leftmenu" href="register.php">Register</a>

			  <a class="leftmenu" href="http://forum.thegrpg.com/">Forums</a>

			  <a class="leftmenu" href="http://bourbanlegends.com/wiki">Manual/Wiki</a>
			  <a class="leftmenu" href="forgot.php">Account Recovery</a>





		 </ul>



			  <br />

            </div>

          </td>

          <td valign="top"> <br />

            <table border="0" cellspacing="0" cellpadding="0" width="100%">

              <tr>

                <td width="10"></td>

                <td valign="top" class="mainbox">

<table class="content">